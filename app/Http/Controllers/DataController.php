<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Checks;
use App\Models\Building;
use App\Models\Cleaning;
use App\Models\DailyPoint;
use App\Models\CheckerTask;
use App\Models\OfficeRecord;
use Illuminate\Http\Request;
use App\Models\CheckerRecord;
use App\Models\CleaningGroup;
use App\Models\CleaningRecord;
use App\Models\OfficeTaskDetail;
use App\Models\DailyCleaningPoint;
use Illuminate\Support\Facades\DB;
use App\Models\CheckerRecordDetail;
use App\Models\CleaningRecordDetail;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class DataController extends Controller
{

    public function cleaningData()
    {
        $title = __('dashboardCleaning.controller.indextitle');

        $query = CleaningRecord::with([
            'group.tasks',        // ambil semua task di group
            'details.task',       // ambil detail + task name
            'members',
            'user'
        ])->orderBy('date', 'desc');

        // Filter tanggal
        if (request('start_date')) {
            $startDate = Carbon::createFromFormat('d/m/Y', request('start_date'))->format('Y-m-d');
            $query->whereDate('date', '>=', $startDate);
        }
        if (request('end_date')) {
            $endDate = Carbon::createFromFormat('d/m/Y', request('end_date'))->format('Y-m-d');
            $query->whereDate('date', '<=', $endDate);
        }

        // Filter group/gedung
        if (request('building')) {
            $query->whereHas('group', function ($q) {
                $q->where('slug', request('building'));
            });
        }

        // Filter user
        if (request('user')) {
            $query->whereHas('members', function ($q) {
                $q->where('user_id', request('user'));
            });
        }

        $cleanings = $query->get();

        // Format hasil untuk view
        $grouped = [];

        foreach ($cleanings as $cleaning) {
            $groupSlug = $cleaning->group->slug ?? 'unknown';
            $memberCount = $cleaning->member_count ?? $cleaning->members->count();
            $groupKey = "{$groupSlug}|{$memberCount}";

            $tasksData = [];
            $total = 0;

            foreach ($cleaning->details as $detail) {
                $taskName = $detail->task->name ?? 'Unknown';
                $formula = $detail->formula ?? 1;
                $value = (float)$detail->value;
                $calculated = $value * $formula;

                $tasksData[$taskName] = [
                    'value' => $value,
                    'formula' => $formula,
                    'calculated' => $calculated,
                ];

                $total += $calculated;
                // Simpan nama task ke daftar global untuk group ini
                $grouped[$groupKey]['all_task_names'][$taskName] = true;
            }

            $poinPerMember = count($cleaning->members) > 0 ? $total / count($cleaning->members) : 0;

            $grouped[$groupKey]['records'][] = [
                'id' => $cleaning->id,
                'date' => $cleaning->date,
                'building_name' => $cleaning->group->building_name ?? 'Unknown',
                'tasks' => $tasksData,   // semua task dinamis
                'total' => $total,
                'poin_per_member' => $poinPerMember,
                'members' => $cleaning->members,
                'member_count' => $cleaning->members->count(),
            ];
        }

        $buildings = CleaningGroup::orderBy('building_name')->get();
        $users = User::orderBy('nama')->get();

        return view('Dashboard.cleaning.cleaningdata', compact('title', 'grouped', 'buildings', 'users'));
    }

    public function destroycleaningData(CleaningRecord $cleaningRecord)
    {
        // Hapus daily point yang terkait record ini
        DailyPoint::where('activity_type', 'Cleaning')
            ->where('activity_id', $cleaningRecord->id)
            ->delete();

        // Hapus relasi pivot members (meskipun cascadeOnDelete akan handle, ini lebih aman)
        $cleaningRecord->members()->detach();

        // Hapus record utama (details & pivot ikut terhapus via cascade)
        $cleaningRecord->delete();

        return redirect()->route('cleaningdata')
            ->with('success', 'Data cleaning dan daily point terkait berhasil dihapus.');
    }

    public function exportCleaningData(Request $request)
    {
        $startDate    = $request->get('start_date');
        $endDate      = $request->get('end_date');
        $buildingSlug = $request->get('building');

        $cleanings = CleaningRecord::with(['group', 'members', 'details.task'])
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
            ->when($buildingSlug, fn($q) => $q->whereHas('group', fn($b) => $b->where('slug', $buildingSlug)))
            ->orderBy('date')
            ->get();

        if ($cleanings->isEmpty()) {
            return back()->with('error', 'Tidak ada data cleaning.');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $buildings = $cleanings->groupBy(fn($c) => strtolower($c->group->slug));

        $categoryMaxCols = [];
        foreach ($cleanings as $c) {
            $memberCount = $c->member_count;
            $taskCount   = $c->details->count();
            $totalCols = 2 + $taskCount + 3;
            if (!isset($categoryMaxCols[$memberCount]) || $totalCols > $categoryMaxCols[$memberCount]) {
                $categoryMaxCols[$memberCount] = $totalCols;
            }
        }

        $startCols = [
            '2' => 'A',
            '3' => 'L',
            '4' => 'W',
            '5' => 'AH',
        ];

        $generateColumnLetters = function ($count, $start) {
            $letters = [];
            $colIndex = Coordinate::columnIndexFromString($start);
            for ($i = 0; $i < $count; $i++) {
                $letters[] = Coordinate::stringFromColumnIndex($colIndex + $i);
            }
            return $letters;
        };

        $colLetters = [];
        foreach ($categoryMaxCols as $category => $colCount) {
            $start = $startCols[$category] ?? 'A';
            $colLetters[$category] = $generateColumnLetters($colCount, $start);
        }

        $currentRows = [];
        foreach ($colLetters as $key => $cols) {
            $currentRows[$key] = 1;
        }

        foreach ($buildings as $slug => $buildingGroup) {
            $buildingName = optional($buildingGroup->first()->group)->building_name ?? 'Unknown';
            $memberCategories = $buildingGroup->pluck('member_count')->unique();

            foreach ($memberCategories as $memberCount) {
                $groupData = $buildingGroup->where('member_count', $memberCount);
                if ($groupData->isEmpty()) continue;

                $cols = $colLetters[$memberCount];
                $colStart = $cols[0];
                $colEnd   = end($cols);
                $row      = $currentRows[$memberCount];

                // 🔹 Header Gedung
                $sheet->setCellValue("{$colStart}{$row}", strtoupper($buildingName) . " ({$memberCount} Member)");
                $sheet->mergeCells("{$colStart}{$row}:{$colEnd}{$row}");
                $sheet->getStyle("{$colStart}{$row}")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
                $sheet->getStyle("{$colStart}{$row}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('305496');
                $row++;

                // 🔹 Header Kolom
                $exampleRecord = $groupData->first();
                $taskNames = $exampleRecord->details->pluck('task.name')->toArray();

                $headers = array_merge(['Date', 'Member'], $taskNames, ['Total', 'Member (Copy)', 'Poin / Member']);

                $colIdx = 0;
                foreach ($headers as $header) {
                    if (!isset($cols[$colIdx])) break;
                    $cell = $cols[$colIdx++] . $row;
                    $sheet->setCellValue($cell, $header);
                    $sheet->getStyle($cell)->getFont()->setBold(true);
                    $sheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                }
                $row++;

                // 🔹 Isi Data + warna bergantian
                $colorToggle = true;
                foreach ($groupData as $cleaning) {
                    $fillColor = $colorToggle ? 'DCE6F1' : 'EBF1DE'; // dua warna biru muda bergantian
                    $colorToggle = !$colorToggle;

                    $taskValues = $cleaning->details->mapWithKeys(fn($d) => [$d->task->name => $d->value])->toArray();
                    $taskSum = array_sum($cleaning->details->pluck('calculated')->toArray());
                    $memberCountNow = $cleaning->members->count();
                    $poinPerMember = $memberCountNow > 0 ? $taskSum / $memberCountNow : 0;

                    $startRow = $row;

                    foreach ($cleaning->members as $member) {
                        $colIdx = 0;
                        $sheet->setCellValue($cols[$colIdx++] . $row, \Carbon\Carbon::parse($cleaning->date)->format('Y-m-d'));
                        $sheet->setCellValue($cols[$colIdx++] . $row, $member->nama);

                        foreach ($taskNames as $taskName) {
                            $sheet->setCellValue($cols[$colIdx++] . $row, $taskValues[$taskName] ?? 0);
                        }

                        $sheet->setCellValue($cols[$colIdx++] . $row, number_format($taskSum, 2));
                        $sheet->setCellValue($cols[$colIdx++] . $row, $member->nama);
                        $sheet->setCellValue($cols[$colIdx++] . $row, number_format($poinPerMember, 2));

                        for ($i = 0; $i < count($headers); $i++) {
                            if (!isset($cols[$i])) continue;
                            $cell = $cols[$i] . $row;
                            $sheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                            $sheet->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()->setRGB($fillColor);
                        }

                        $row++;
                    }
                }

                $row += 2;
                $currentRows[$memberCount] = $row;
            }
        }

        foreach (array_merge(...array_values($colLetters)) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Cleaning_Report_' . now()->format('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }


    public function checkerData()
    {
        $title = __('dashboardCleaning.controller.checkerDataTitle');

        $query = CheckerRecord::with(['user', 'details.task'])
            ->orderBy('date', 'desc');

        $startDate = null;
        $endDate   = null;

        if (request('start_date')) {
            $startDateObj = \DateTime::createFromFormat('d/m/Y', request('start_date'));
            if ($startDateObj) {
                $startDate = $startDateObj->format('Y-m-d');
            }
        }

        if (request('end_date')) {
            $endDateObj = \DateTime::createFromFormat('d/m/Y', request('end_date'));
            if ($endDateObj) {
                $endDate = $endDateObj->format('Y-m-d');
            }
        }

        // Apply filters
        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('date', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('date', '<=', $endDate);
        }

        // Filter by user
        if (request('user_id')) {
            $query->where('user_id', request('user_id'));
        }

        $records = $query->get();

        // Ambil semua task (supaya tabel tetap konsisten meskipun ada task baru)
        $tasks = CheckerTask::where('active', true)
            ->orWhereHas('details')   // tampilkan juga jika sudah pernah punya data
            ->get();


        // Map ke format tampilan lama
        $checkerData = $records->map(function ($record) use ($tasks) {
            $taskValues = [];

            foreach ($tasks as $task) {
                $detail = $record->details->firstWhere('checker_task_id', $task->id);
                $taskValues[$task->name] = $detail ? $detail->value : null;
                $taskValues[$task->name . '_poin'] = $detail ? $detail->calculated : 0;
            }

            return [
                'id'          => $record->id,
                'date'        => \Carbon\Carbon::parse($record->date)->format('Y-m-d'),
                'user_name'   => $record->user->nama,
                'tasks'       => $taskValues,
                'total_point' => $record->total_point,
            ];
        });

        $users = User::all();

        return view('Dashboard.cleaning.checkerdata', compact('checkerData', 'title', 'users', 'tasks'));
    }

    public function checkerDestroy(CheckerRecord $checkerRecord)
    {
        // Hapus daily points terkait
        DailyPoint::where('activity_type', 'Checker')
            ->where('activity_id', $checkerRecord->id)
            ->delete();

        // Hapus record (otomatis hapus details via cascade)
        $checkerRecord->delete();

        return redirect()->back()->with('success', 'Checker berhasil dihapus.');
    }

    public function exportCheckerData(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate   = $request->get('end_date');
        $userId    = $request->get('user_id');

        // Ambil semua task aktif (urutan tetap agar kolom konsisten)
        $tasks = CheckerTask::where('active', true)
            ->orderBy('id')
            ->get();

        // Ambil data checker record sesuai filter
        $records = CheckerRecord::with(['user', 'details.task'])
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->orderBy('date')
            ->orderBy('user_id')
            ->get();

        if ($records->isEmpty()) {
            return back()->with('error', __('dashboardCleaning.controller.no_data_found'));
        }

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // =====================
        // HEADER
        // =====================
        $headers = [
            __('dashboardCleaning.controller.headers.no'),
            __('dashboardCleaning.controller.headers.date'),
            __('dashboardCleaning.controller.headers.name'),
        ];

        // Tambahkan header dinamis dari task aktif
        foreach ($tasks as $task) {
            $headers[] = ucfirst($task->name);
        }

        $headers[] = __('dashboardCleaning.controller.headers.total_points');

        // Style header
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D6EAF8']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
        ];

        // Tulis header
        foreach ($headers as $i => $header) {
            $col = Coordinate::stringFromColumnIndex($i + 1);
            $sheet->setCellValue("{$col}1", $header);
            $sheet->getStyle("{$col}1")->applyFromArray($headerStyle);
        }

        // =====================
        // ISI DATA
        // =====================
        $rowIndex = 2;
        $no = 1;

        foreach ($records as $record) {
            $sheet->setCellValue("A{$rowIndex}", $no++);
            $sheet->setCellValue("B{$rowIndex}", $record->date);
            $sheet->setCellValue("C{$rowIndex}", $record->user->nama ?? '-');

            $colIndex = 4; // kolom setelah nama
            $total = 0;

            foreach ($tasks as $task) {
                $detail = $record->details->firstWhere('checker_task_id', $task->id);
                $value = $detail->value ?? 0;
                $calc  = $detail->calculated ?? (($value * $task->formula) ?? 0);

                // Jika type boolean, tampilkan 'Ya'/'Tidak'
                if ($task->type === 'boolean') {
                    $display = $value == 1 ? 'Ya' : 'Tidak';
                } else {
                    $display = $value;
                }

                $sheet->setCellValue(Coordinate::stringFromColumnIndex($colIndex++) . $rowIndex, $display);
                $total += $calc;
            }

            // total point (dari kolom terakhir)
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($colIndex) . $rowIndex, round($total, 1));
            $rowIndex++;
        }

        // =====================
        // FORMAT TABEL
        // =====================
        $lastCol = Coordinate::stringFromColumnIndex(count($headers));

        // autosize kolom & border
        foreach (range('A', $lastCol) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
            for ($r = 1; $r < $rowIndex; $r++) {
                $sheet->getStyle("{$col}{$r}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            }
        }

        // =====================
        // EXPORT FILE
        // =====================
        $filename = 'checker_data_' . now()->format('Y_m_d_His') . '.xlsx';
        $tempPath = tempnam(sys_get_temp_dir(), 'checker_');
        (new Xlsx($spreadsheet))->save($tempPath);

        return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
    }

    public function officeData(Request $request)
    {
        $title = __('dashboardCleaning.controller.officedata.title');

        $users = User::all();

        $records = OfficeRecord::with(['details.task.group', 'details.user'])
            ->when($request->start_date, function ($query) use ($request) {
                // format input dari datepicker (dd/mm/yyyy) → convert ke Y-m-d
                $startDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
                $query->whereDate('date', '>=', $startDate);
            })
            ->when($request->end_date, function ($query) use ($request) {
                $endDate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
                $query->whereDate('date', '<=', $endDate);
            })
            ->when($request->user_id, function ($query) use ($request) {
                $query->whereHas('details', function ($q) use ($request) {
                    $q->where('user_id', $request->user_id);
                });
            })
            ->orderBy('date', 'desc')
            ->get();


        return view('Dashboard.cleaning.officedata', compact('records', 'title', 'users'));
    }

    public function officeDestroy(OfficeRecord $office)
    {
        $office->delete(); // otomatis cascade hapus details + daily_points

        return redirect()
            ->route('officedata') // sesuaikan dengan route index-mu
            ->with('success', 'Checker berhasil dihapus.');
    }

    public function officeexport(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate   = $request->get('end_date');
        $userId    = $request->get('user_id');

        $query = OfficeRecord::with(['details.task.group', 'details.user']);

        if ($startDate) {
            $query->whereDate('date', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('date', '<=', $endDate);
        }
        if ($userId) {
            $query->whereHas('details', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        }

        $records = $query->orderBy('date', 'desc')->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = [__('dashboardCleaning.controller.header_date'), __('dashboardCleaning.controller.header_user'), __('dashboardCleaning.controller.header_task_group'), __('dashboardCleaning.controller.header_task'), __('dashboardCleaning.controller.header_point'), __('dashboardCleaning.controller.header_total_point')];
        foreach ($headers as $i => $header) {
            $cell = chr(65 + $i) . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getBorders()->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }

        $row = 2;
        $colorToggle = false;

        foreach ($records as $record) {
            $details = $record->details;
            if ($details->isEmpty()) continue;

            $totalPoint = $details->sum(fn($detail) => $detail->task->point);
            $rowStart = $row;
            $rowEnd   = $row + $details->count() - 1;

            // isi kolom task detail
            foreach ($details as $detail) {
                $sheet->setCellValue("C{$row}", $detail->task->group->name ?? '-');
                $sheet->setCellValue("D{$row}", $detail->task->name);
                $sheet->setCellValue("E{$row}", $detail->task->point);

                // border untuk semua kolom
                foreach (range('A', 'F') as $col) {
                    $sheet->getStyle("{$col}{$row}")->getBorders()->getAllBorders()
                        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                }

                $row++;
            }

            // merge cell utk kolom yang sama
            $sheet->mergeCells("A{$rowStart}:A{$rowEnd}")
                ->setCellValue("A{$rowStart}", $record->date);

            $sheet->mergeCells("B{$rowStart}:B{$rowEnd}")
                ->setCellValue("B{$rowStart}", $details->first()->user->nama ?? '-');

            $sheet->mergeCells("F{$rowStart}:F{$rowEnd}")
                ->setCellValue("F{$rowStart}", $totalPoint);

            // background selang-seling
            $fillColor = $colorToggle ? 'FFEFEFEF' : 'FFFFFFFF'; // abu-abu muda / putih
            $sheet->getStyle("A{$rowStart}:F{$rowEnd}")
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB($fillColor);

            $colorToggle = !$colorToggle;
        }

        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'office_records_' . now()->format('Ymd_His') . '.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    public function userPoint(Request $request)
    {
        $title = __('dashboardCleaning.controller.userPoint.title');

        $filterDate = $request->get('filter_date');

        if ($filterDate) {
            try {
                // Pastikan format filter_date adalah yyyy/mm
                [$year, $month] = explode('/', $filterDate);
                $year = intval($year);
                $month = intval($month);
            } catch (\Exception $e) {
                $year = now()->year;
                $month = now()->month;
            }
        } else {
            $year = now()->year;
            $month = now()->month;
        }

        $users = User::orderBy('nama')->get();
        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

        // Ambil data sekalian group by user_id|date
        $points = DailyPoint::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->groupBy(function ($item) {
                return $item->user_id . '|' . $item->date;
            });

        $rekap = [];

        foreach ($users as $user) {
            $rekap[$user->id] = [
                'nama'  => $user->nama,
                'poin'  => [],
                'total' => 0
            ];

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dateStr = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
                $key = $user->id . '|' . $dateStr;

                $poinHarian = $points->has($key)
                    ? $points[$key]->sum('point') // perbaikan: pakai sum agar menjumlah semua aktivitas
                    : 0;

                $rekap[$user->id]['poin'][$day] = $poinHarian;
                $rekap[$user->id]['total'] += $poinHarian;
            }
        }

        return view('Dashboard.cleaning.userpoint', [
            'rekap'       => $rekap,
            'daysInMonth' => $daysInMonth,
            'month'       => $month,
            'year'        => $year,
            'filter_date' => $filterDate,
            'title'       => $title
        ]);
    }

    public function userPointExport(Request $request)
    {
        $year  = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

        $users = User::orderBy('nama')->get();

        $points = DailyPoint::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->groupBy('user_id');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Styling
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0070C0']
            ],
            'alignment' => ['horizontal' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ];

        $borderStyle = [
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ];

        // Header
        $col = 'A';
        $sheet->setCellValue("{$col}1", __('dashboardCleaning.controller.headers.no'));
        $col++;
        $sheet->setCellValue("{$col}1", __('dashboardCleaning.controller.headers.name'));
        $col++;

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $sheet->setCellValue("{$col}1", __('dashboardCleaning.controller.header_day') . " {$i}");
            $col++;
        }

        $sheet->setCellValue("{$col}1", __('dashboardCleaning.controller.header_total_poin'));

        // Apply header style
        $lastCol = $col;
        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray($headerStyle);

        // Data
        $rowIndex = 2;
        $no = 1;
        foreach ($users as $user) {
            $col = 'A';
            $sheet->setCellValue("{$col}{$rowIndex}", $no++);
            $col++;
            $sheet->setCellValue("{$col}{$rowIndex}", $user->nama);
            $col++;

            $total = 0;
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dateStr = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
                $point = $points->has($user->id)
                    ? $points[$user->id]->firstWhere('date', $dateStr)
                    : null;

                $poinHarian = $point ? round($point->total_point, 1) : 0.0;
                $sheet->setCellValue("{$col}{$rowIndex}", $poinHarian);
                $total += $poinHarian;
                $col++;
            }

            $sheet->setCellValue("{$col}{$rowIndex}", round($total, 1));

            // Warna latar bergantian tiap baris
            $fillColor = ($rowIndex % 2 == 0) ? 'FFFFFF' : 'D9E1F2';
            $sheet->getStyle("A{$rowIndex}:{$lastCol}{$rowIndex}")->getFill()->setFillType('solid')->getStartColor()->setRGB($fillColor);

            // Border tiap baris
            $sheet->getStyle("A{$rowIndex}:{$lastCol}{$rowIndex}")->applyFromArray($borderStyle);

            $rowIndex++;
        }

        // Auto size kolom
        $columnIterator = $sheet->getColumnIterator();
        foreach ($columnIterator as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $filename = __('dashboardCleaning.controller.filename_rekap') . "_{$month}_{$year}.xlsx";
        $writer = new Xlsx($spreadsheet);
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    public function CleaningHistoryData(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $title = __('dashboardCleaning.controller.CleaningHistoryData.title');

        $cleanings = CleaningRecord::with(['group', 'user', 'members', 'details.task'])
            ->when(!$user->hasRole('admin'), function ($query) use ($user) {
                $query->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)
                        ->orWhereHas('members', fn($q) => $q->where('user_id', $user->id));
                });
            })
            ->orderBy('date', 'desc')
            ->get();

        $cleaningData = $cleanings->map(function ($cleaning) {
            // Hitung total poin dari detail
            $totalPoint = $cleaning->details->sum(function ($detail) {
                return ($detail->formula ?? 1) * (is_numeric($detail->value) ? $detail->value : 1);
            });

            return [
                'date' => $cleaning->date,
                'building' => $cleaning->group->building_name ?? '-',
                'user_name' => $cleaning->user->nama ?? '-',
                'members' => $cleaning->members->pluck('nama'),
                'total_point' => $totalPoint,
                'point_per_member' => $cleaning->members->count() > 0
                    ? round($totalPoint / $cleaning->members->count(), 2)
                    : 0,
            ];
        });

        return view('Dashboard.cleaning.cleaninghistory', [
            'cleaningData' => $cleaningData,
            'title' => $title,
        ]);
    }

    public function CheckOfficeHistoryData(Request $request)
    {
        $title = __('dashboardCleaning.controller.CheckOfficeHistoryData.title');
        $checkandoffice = [];

        // ========== Ambil data CHECKER ==========
        $checkerRecords = CheckerRecord::with(['user', 'details.task'])
            ->orderBy('date', 'desc')
            ->get();

        foreach ($checkerRecords as $record) {
            $totalPoint = $record->details->sum('calculated') ?? 0;

            $checkandoffice[] = [
                'type'             => 'check',
                'date'             => \Carbon\Carbon::parse($record->date)->format('Y-m-d'),
                'user_name'        => $record->user->nama ?? '-',
                'total_point'      => $totalPoint,
                'point_per_member' => $totalPoint, // checker biasanya per individu, tidak dibagi
            ];
        }

        // ========== Ambil data OFFICE ==========
        $officeRecords = OfficeRecord::with(['details.user', 'details.task', 'group'])
            ->orderBy('date', 'desc')
            ->get();

        foreach ($officeRecords as $record) {
            $details    = $record->details ?? collect();
            $totalPoint = $details->sum('point');
            $members    = $details->pluck('user.nama')->unique()->values()->all();

            $checkandoffice[] = [
                'type'             => 'office',
                'date'             => \Carbon\Carbon::parse($record->date)->format('Y-m-d'),
                'user_name'        => $details->first()->user->nama ?? '-',
                'total_point'      => $totalPoint,
                'point_per_member' => $members ? round($totalPoint / count($members), 1) : 0,
            ];
        }

        // Urutkan semua data berdasarkan tanggal (desc)
        usort($checkandoffice, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('Dashboard.cleaning.checkRecord', compact('title', 'checkandoffice'));
    }

    public function userPointRekap($userId, $year, $month)
    {
        $user = User::findOrFail($userId);

        // 1. Banyak Activity (misal daily_activity)
        $activitiesCount = DailyPoint::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->count();

        // Update personal_value untuk user ini sebelum pagination
        CleaningRecord::with('details')
            ->whereHas('members', fn($q) => $q->where('user_id', $userId))
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->each(function ($c) {
                $c->details->each(function ($detail) use ($c) {
                    if (is_null($detail->personal_value)) {
                        $detail->personal_value = $c->member_count > 0 ? ($detail->value / $c->member_count) : 0;
                        $detail->save();
                    }
                });
            });

        // 2. Banyak Cleaning (user ikut di cleaning_records)
        $cleanings = CleaningRecord::with(['group', 'details.task'])
            ->whereHas('members', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'desc')
            ->paginate(8, ['*'], 'cleaning_page'); // ✅ pagination (8 item per halaman)

        // Buat array baru berisi poin per member
        $cleaningsWithPoint = $cleanings->map(function ($c) {
            $poinPerMember = $c->member_count > 0 ? $c->total_point / $c->member_count : 0;
            // Ambil semua detail
            $c->details->each(function ($detail) use ($c) {
                // Jika personal_value kosong
                if (is_null($detail->personal_value)) {
                    // Hitung personal_value
                    $detail->personal_value = $c->member_count > 0 ? ($detail->value / $c->member_count) : 0;
                    // Simpan ke DB agar selanjutnya tidak kosong
                    $detail->save();
                }
            });
            return [
                'record' => $c,
                'poin_per_member' => $poinPerMember,
            ];
        });


        // 2. Banyak Cleaning (user ikut di cleaning_records)
        $cleaningsAll = CleaningRecord::with(['group', 'details.task'])
            ->whereHas('members', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'desc')
            ->get();


        $totalCleaningPoint = $cleaningsWithPoint->sum('poin_per_member');

        $cleaningsCount = $cleaningsAll->count();

        // Ambil semua cleaning_record_id yang user ini ikut di bulan tersebut
        $cleaningIds = $cleaningsAll->pluck('id');


        // Ambil detail berdasarkan cleaning_record_id yang sudah difilter
        $details = CleaningRecordDetail::with('task')
            ->whereIn('cleaning_record_id', $cleaningIds)
            ->get();

        $taskSummary = $details->groupBy('cleaning_task_id')->map(function ($items) {
            return [
                'task_name'   => $items->first()->task->name ?? 'Unknown',
                'total_times' => $items->count(),
                'total_point' => $items->sum('calculated'),
            ];
        });

        // Ambil total point dari daily_points (sudah dibagi per member)
        $totalCleaningPoint = DailyPoint::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('activity_type', 'cleaning')
            ->sum('point');

        // hitung total point dari semua task
        $totalPoint = $totalCleaningPoint;

        // ================= GROUP SUMMARY =================
        $groups = CleaningGroup::with(['records' => function ($q) use ($userId, $year, $month) {
            $q->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->whereHas('members', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                })
                ->with('details.task');
        }])->get();


        $groupSummary = $groups->map(function ($group) {
            $taskSummary = [];

            foreach ($group->records as $record) {   // 🔄 records, bukan cleanings
                foreach ($record->details as $detail) {
                    $taskSummary[$detail->task->id]['task_name'] = $detail->task->name ?? 'Unknown';

                    // TOTAL PERSONAL VALUE, bukan hanya count
                    $taskSummary[$detail->task->id]['total_times'] =
                        ($taskSummary[$detail->task->id]['total_times'] ?? 0) + ($detail->personal_value ?? 0);

                    $taskSummary[$detail->task->id]['total_point'] =
                        ($taskSummary[$detail->task->id]['total_point'] ?? 0) + ($detail->calculated ?? 0);
                }
            }

            return [
                'group_id'    => $group->id,
                'group_name'  => $group->building_name, // ✅ pakai building_name (bukan name)
                'taskSummary' => array_values($taskSummary),
            ];
        });



        // Checker Section
        $checkersAll = CheckerRecord::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'desc')
            ->get();
        $checkers = CheckerRecord::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'desc')
            ->paginate(8, ['*'], 'checker_page');

        $checkersCount = $checkersAll->count();
        $checkerIds    = $checkersAll->pluck('id');

        $checkerDetails = CheckerRecordDetail::with('task')
            ->whereIn('checker_record_id', $checkerIds)
            ->get();

        $checkerSummary = $checkerDetails->groupBy('checker_task_id')->map(function ($items) {
            return [
                'task_name'   => $items->first()->task->name ?? 'Unknown',
                'total_times' => $items->sum('value'),
                'total_point' => $items->sum('calculated'),
            ];
        });

        $totalCheckerPoint = $checkerSummary->sum('total_point');

        // ================= OFFICE =================
        $office = OfficeRecord::with(['group', 'details.task', 'details.user'])
            ->whereHas('details', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'desc')
            ->paginate(8, ['*'], 'office_page'); // ✅ pagination

        // Hitung poin user per record
        $officeWithPoint = $office->map(function ($record) use ($userId) {
            $userPoint = $record->details
                ->where('user_id', $userId)
                ->sum('point');

            return [
                'record' => $record,
                'point'  => $userPoint,
            ];
        });

        // untuk summary (ambil semua, no paginate)
        $officeAll = OfficeRecord::with('details')
            ->whereHas('details', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        // hitung total activity office
        $officeCount = $officeAll->count();

        // hitung total point office
        $totalOfficePoint = $officeAll->sum(function ($record) use ($userId) {
            return $record->details->where('user_id', $userId)->sum('point');
        });


        // Office Task Summary per user
        $officeTaskDetails = OfficeTaskDetail::with('task')
            ->whereHas('record', function ($q) use ($year, $month) {
                $q->whereYear('date', $year)
                    ->whereMonth('date', $month);
            })
            ->where('user_id', $userId)
            ->get();

        $officeTaskSummary = $officeTaskDetails->groupBy('task_id')->map(function ($items) {
            return [
                'task_name'   => $items->first()->task->name ?? 'Unknown',
                'total_times' => $items->count(),
                'total_point' => $items->sum('point'),
            ];
        });



        return view('Dashboard.cleaning.rekap', [
            'title'             => 'User Recap Activity',
            'user'              => $user,
            'year'              => $year,
            'month'             => $month,
            'activitiesCount'   => $activitiesCount,

            // Cleaning
            'cleaningsCount'    => $cleaningsCount,
            'cleaningsWithPoint' => $cleaningsWithPoint,
            'taskSummary'       => $taskSummary,
            'totalPoint'        => $totalPoint,
            'cleanings'         => $cleanings,
            'groupSummary' => $groupSummary,
            'totalCleaningPoint' => $totalCleaningPoint,


            // Checker
            'checkersCount'     => $checkersCount,
            'checkerSummary'    => $checkerSummary,
            'totalCheckerPoint' => $totalCheckerPoint,
            'checkers'          => $checkers,

            // Office
            'office'              => $office,
            'officeWithPoint'     => $officeWithPoint,
            'officeTaskSummary'   => $officeTaskSummary,
            'totalOfficePoint'    => $totalOfficePoint,
            'officeCount'         => $officeCount,

        ]);
    }
}
