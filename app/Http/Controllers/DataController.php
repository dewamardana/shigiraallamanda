<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Checks;
use App\Models\Building;
use App\Models\Cleaning;
use App\Models\DailyPoint;
use App\Models\OfficeRecord;
use Illuminate\Http\Request;
use App\Models\OfficeTaskDetail;
use App\Models\DailyCleaningPoint;
use Illuminate\Support\Facades\DB;
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

        $query = Cleaning::with(['building', 'members', 'poinRecord'])->orderBy('date');


        $startDate = null;
        $endDate = null;

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

        // filter by building
        if (request('building')) {
            $query->whereHas('building', function ($q) {
                $q->where('slug', request('building'));
            });
        }

        // filter user
        if (request('user')) {
            $query->whereHas('members', function ($q) {
                $q->where('user_id', request('user'));
            });
        }

        $cleanings = $query->get();

        // format created_at
        $cleanings->each(function ($item) {
            $item->date_formatted = Carbon::parse($item->date)->format('Y-m-d');
        });

        $grouped = [];

        foreach ($cleanings as $cleaning) {
            $buildingSlug = $cleaning->building->slug ?? 'unknown';
            $memberCount = ($buildingSlug === 'royal') ? 'random' : $cleaning->members->count();
            $groupKey = "{$buildingSlug}|{$memberCount}";

            $poinRecord = $cleaning->poinRecord;

            if (!$poinRecord) continue;

            $oa = $cleaning->oa * $poinRecord->oa;
            $ov = $cleaning->ov * $poinRecord->ov;
            $stay = $cleaning->stay * $poinRecord->stay;
            $vec = $cleaning->vec * $poinRecord->vec;
            $premier = $buildingSlug === 'royal' ? ($cleaning->premier * $poinRecord->premier) : 0;

            $total = $oa + $ov + $stay + $vec + $premier;
            $memberCountNow = $cleaning->members->count();
            $poinPerMember = $memberCountNow > 0 ? $total / $memberCountNow : 0;

            $grouped[$groupKey][] = [
                'id' => $cleaning->id,
                'date' => $cleaning->date_formatted,
                'building_name' => $cleaning->building->building_name ?? 'Unknown',
                'oa' => $cleaning->oa,
                'ov' => $cleaning->ov,
                'stay' => $cleaning->stay,
                'vec' => $cleaning->vec,
                'premier' => $cleaning->premier,
                'oa_value' => $poinRecord->oa,
                'ov_value' => $poinRecord->ov,
                'stay_value' => $poinRecord->stay,
                'vec_value' => $poinRecord->vec,
                'premier_value' => $poinRecord->premier,
                'oa_total' => $oa,
                'ov_total' => $ov,
                'stay_total' => $stay,
                'vec_total' => $vec,
                'premier_total' => $premier,
                'total' => $total,
                'poin_per_member' => $poinPerMember,
                'members' => $cleaning->members,
                'member_count' => $memberCountNow,
            ];
        }

        $buildings = Building::orderBy('building_name')->get();
        $users = User::orderBy('nama')->get();

        return view('Dashboard.cleaning.cleaningdata', compact('title', 'grouped', 'buildings', 'users'));
    }

    public function destroycleaningData(Cleaning $cleaning)
    {
        $cleaning->delete();

        return redirect()->route('cleaningdata')
            ->with('success', 'Data cleaning berhasil dihapus beserta relasinya.');
    }

    public function exportCleaningData(Request $request)
    {
        $startDate    = $request->get('start_date');
        $endDate      = $request->get('end_date');
        $buildingSlug = $request->get('building');

        $cleanings = Cleaning::with('building', 'members', 'poinRecord')
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
            ->when($buildingSlug, fn($q) => $q->whereHas('building', fn($b) => $b->where('slug', $buildingSlug)))
            ->orderBy('date')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $startCols = [
            '2'     => 'A',
            '3'     => 'J',
            'royal' => 'S',
        ];

        $colLetters = [
            '2'     => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'],
            '3'     => ['J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q'],
            'royal' => ['S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA'],
        ];

        $currentRows = [
            '2'     => 1,
            '3'     => 1,
            'royal' => 1,
        ];

        $buildings = $cleanings->groupBy(fn($c) => strtolower($c->building->slug));

        foreach ($buildings as $slug => $buildingGroup) {
            $buildingName = optional($buildingGroup->first()->building)->building_name ?? 'Unknown';
            $categories = $slug === 'royal' ? ['royal'] : ['2', '3'];

            foreach ($categories as $category) {
                $groupData = $buildingGroup->filter(function ($c) use ($slug, $category) {
                    $memberCount = $c->members->count();
                    return $slug === 'royal' ? true : $memberCount == $category;
                });

                if ($groupData->isEmpty()) continue;

                $colStart = $startCols[$category];
                $row = $currentRows[$category];
                $maxColIndex = count($colLetters[$category]) - 1;
                $endCol = $colLetters[$category][$maxColIndex];
                $sheet->setCellValue("{$colStart}{$row}", strtoupper($buildingName));
                $sheet->mergeCells("{$colStart}{$row}:{$endCol}{$row}");
                $sheet->getStyle("{$colStart}{$row}")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
                $sheet->getStyle("{$colStart}{$row}")->getFill()->setFillType('solid')->getStartColor()->setRGB('0070C0');
                $row++;

                $headers = [
                    __('dashboardCleaning.controller.header_name_member'),
                    __('dashboardCleaning.controller.header_oa'),
                    __('dashboardCleaning.controller.header_ov'),
                    __('dashboardCleaning.controller.header_stay'),
                    __('dashboardCleaning.controller.header_vec'),
                ];
                if ($slug === 'royal') {
                    $headers[] = __('dashboardCleaning.controller.header_premier');
                }
                $headers[] = __('dashboardCleaning.controller.header_total');
                $headers[] = __('dashboardCleaning.controller.header_name_member2');
                $headers[] = __('dashboardCleaning.controller.header_poin');

                $colIdx = 0;
                foreach ($headers as $header) {
                    $cell = $colLetters[$category][$colIdx++] . $row;
                    $sheet->setCellValue($cell, $header);
                    $sheet->getStyle($cell)->getFont()->setBold(true);
                    $sheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                }
                $row++;

                $colors = ['D9E1F2', 'FCE4D6', 'E2EFDA', 'FFF2CC'];
                $currentColorIdx = 0;

                foreach ($groupData as $cleaning) {
                    $poin = $cleaning->poinRecord;
                    if (!$poin) continue;

                    $oa      = $cleaning->oa * $poin->oa;
                    $ov      = $cleaning->ov * $poin->ov;
                    $stay    = $cleaning->stay * $poin->stay;
                    $vec     = $cleaning->vec * $poin->vec;
                    $premier = $slug === 'royal' ? ($cleaning->premier * $poin->premier) : 0;
                    $total   = $oa + $ov + $stay + $vec + ($slug === 'royal' ? $premier : 0);
                    $memberCountNow = $cleaning->members->count();
                    $poinPerMember  = $memberCountNow > 0 ? $total / $memberCountNow : 0;

                    $fillColor = $colors[$currentColorIdx % count($colors)];

                    foreach ($cleaning->members as $member) {
                        $colIdx = 0;
                        $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, $member->nama);
                        $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, $cleaning->oa);
                        $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, $cleaning->ov);
                        $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, $cleaning->stay);
                        $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, $cleaning->vec);
                        if ($slug === 'royal') {
                            $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, $cleaning->premier);
                        }
                        $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, number_format($total, 1));
                        $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, $member->nama);
                        $sheet->setCellValue($colLetters[$category][$colIdx++] . $row, number_format($poinPerMember, 2));

                        for ($i = 0; $i < count($headers); $i++) {
                            $cell = $colLetters[$category][$i] . $row;
                            $sheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setRGB($fillColor);
                        }

                        $row++;
                    }
                    $currentColorIdx++;
                }

                $currentRows[$category] = $row;
            }
        }

        foreach ($colLetters as $cols) {
            foreach ($cols as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }
        }

        $filename = __('dashboardCleaning.controller.filename_cleaning') . now()->format('Ymd_His') . '.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    public function checkerData()
    {
        $user = Auth::user();
        $title = __('dashboardCleaning.controller.checkerDataTitle');

        $query = Checks::with(['user', 'poinRecord'])
            ->orderBy('date', 'desc');

        $startDate = null;
        $endDate = null;

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

        // Filter by user (khusus admin)
        if (request('user_id')) {
            $query->where('user_id', request('user_id'));
        }

        $checkers = $query->get();

        $checkerData = $checkers->map(function ($check) {
            $poin = $check->poinRecord;

            $total = $check->jumlah_kamar * ($poin->jumlah_kamar ?? 0)
                + ($check->mengajar ? ($poin->mengajar ?? 0) : 0)
                + ($check->pembersihan_khusus ? ($poin->pembersihan_khusus ?? 0) : 0)
                + ($check->mengangkat_barang ? ($poin->mengangkat_barang ?? 0) : 0)
                + ($check->membersihkan_gudang ? ($poin->membersihkan_gudang ?? 0) : 0)
                + ($check->obat_pool ? ($poin->obat_pool ?? 0) : 0)
                + ($check->membersihkan_pool ? ($poin->membersihkan_pool ?? 0) : 0)
                + ($check->sampah ? ($poin->sampah ?? 0) : 0)
                + ($check->office ? ($poin->office ?? 0) : 0);

            return [
                'id' => $check->id,
                'date' => Carbon::parse($check->date)->format('Y-m-d'),
                'user_name' => $check->user->nama,
                'jumlah_kamar' => $check->jumlah_kamar,
                'mengajar' => $check->mengajar,
                'pembersihan_khusus' => $check->pembersihan_khusus,
                'mengangkat_barang' => $check->mengangkat_barang,
                'membersihkan_gudang' => $check->membersihkan_gudang,
                'obat_pool' => $check->obat_pool,
                'membersihkan_pool' => $check->membersihkan_pool,
                'sampah' => $check->sampah,
                'office' => $check->office,
                'poin' => $poin,
                'total_point' => $total,
            ];
        });

        // Ambil list user untuk dropdown filter (jika user punya role admin)
        $users = User::all();

        return view('Dashboard.cleaning.checkerdata', compact('checkerData', 'title', 'users'));
    }


    public function checkerDestroy(Checks $check)
    {
        $check->delete(); // otomatis hapus poin record dan daily point

        return redirect()->back()->with('success', 'Checker berhasil dihapus.');
    }

    public function exportCheckerData(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $userId = $request->get('user_id');

        $formula = \App\Models\FormulaCheck::where('active', true)->first();
        if (!$formula) {
            return back()->with('error', __('dashboardCleaning.controller.no_active_formula'));
        }

        $checks = Checks::with(['user', 'poinRecord'])
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->orderBy('date')
            ->orderBy('user_id')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $fields = [
            __('checker.teaching'),
            __('checker.special_cleaning'),
            __('checker.lifting'),
            __('checker.warehouse_cleaning'),
            __('checker.pool_chemicals'),
            __('checker.pool_cleaning'),
            __('checker.waste_disposal')
        ];

        $headers = array_merge([__('dashboardCleaning.controller.headers.no'), __('dashboardCleaning.controller.headers.date'), __('dashboardCleaning.controller.headers.name'), __('dashboardCleaning.controller.headers.room_count')], array_map(fn($f) => ucfirst(str_replace('_', ' ', $f)), $fields), [__('dashboardCleaning.controller.headers.total_points')]);

        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D6EAF8']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        ];

        foreach ($headers as $i => $header) {
            $col = Coordinate::stringFromColumnIndex($i + 1);
            $cell = "{$col}1";
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->applyFromArray($headerStyle);
        }

        $rowIndex = 2;
        $no = 1;

        foreach ($checks as $check) {
            if (!$check->poinRecord) continue;

            $sheet->setCellValue("A{$rowIndex}", $no++);
            $sheet->setCellValue("B{$rowIndex}", $check->date);
            $sheet->setCellValue("C{$rowIndex}", $check->user->nama ?? '-');
            $sheet->setCellValue("D{$rowIndex}", $check->poinRecord->jumlah_kamar ?? 0);

            $total = ($check->poinRecord->jumlah_kamar ?? 0) * $formula->jumlah_kamar;
            $colIndex = 5;

            foreach ($fields as $field) {
                $val = $check->poinRecord->$field ?? 0;
                $weight = $formula->$field ?? 0;
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($colIndex++) . $rowIndex, $val);
                $total += $val * $weight;
            }

            $sheet->setCellValue(Coordinate::stringFromColumnIndex($colIndex) . $rowIndex, round($total, 1));

            $rowIndex++;
        }

        // AutoSize dan border
        $lastCol = Coordinate::stringFromColumnIndex(count($headers));
        foreach (range('A', $lastCol) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
            for ($r = 1; $r < $rowIndex; $r++) {
                $sheet->getStyle("{$col}{$r}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            }
        }

        $filename = __('dashboardCleaning.controller.filename');
        $tempPath = tempnam(sys_get_temp_dir(), $filename);
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

        $cleanings = Cleaning::with(['poinRecord', 'building', 'members', 'user'])
            ->when(!$user->hasRole('admin'), function ($query) use ($user) {
                $query->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)
                        ->orWhereHas('members', fn($q) => $q->where('user_id', $user->id));
                });
            })
            ->orderBy('date', 'desc')
            ->get();

        $cleaningData = $cleanings->map(function ($cleaning) {
            $poin = $cleaning->poinRecord;

            $total_oa = $cleaning->oa * ($poin->oa ?? 0);
            $total_ov = $cleaning->ov * ($poin->ov ?? 0);
            $total_stay = $cleaning->stay * ($poin->stay ?? 0);
            $total_vec = $cleaning->vec * ($poin->vec ?? 0);
            $total_premier = $cleaning->building->slug === 'royal'
                ? $cleaning->premier * ($poin->premier ?? 0) : 0;

            return [
                'date' => $cleaning->date,
                'building' => $cleaning->building->building_name,
                'user_name' => $cleaning->user->nama ?? '-',
                'members' => $cleaning->members->pluck('nama'),
                'total_point' => $total_oa + $total_ov + $total_stay + $total_vec + $total_premier,
                'point_per_member' => $cleaning->members->count() > 0
                    ? round(($total_oa + $total_ov + $total_stay + $total_vec + $total_premier) / $cleaning->members->count(), 2)
                    : 0,
            ];
        });

        return view('Dashboard.cleaning.cleaninghistory', [
            'cleaningData' => $cleaningData,
            'title' => $title,
        ]);
    }

    public function CheckOfficeHistoryData()
    {
        $title = __('dashboardCleaning.controller.CheckOfficeHistoryData.title');
        $checkandoffice = [];

        // Ambil data CHECKER
        $checks = Checks::with(['user', 'poinRecord'])
            ->orderBy('date', 'desc')
            ->get();

        foreach ($checks as $check) {
            $checkandoffice[] = [
                'type'             => 'check',
                'date'             => \Carbon\Carbon::parse($check->date)->format('Y-m-d'),
                'user_name'        => $check->user->nama ?? '-',
                'total_point'      => $check->poinRecord->total ?? 0,
                'point_per_member' => $check->poinRecord->total ?? 0,
            ];
        }

        // Ambil data OFFICE
        $officeRecords = OfficeRecord::with(['details.task', 'details.user', 'group'])
            ->orderBy('date', 'desc')
            ->get();

        foreach ($officeRecords as $record) {
            $details    = $record->details ?? collect(); // pastikan jadi collection
            $totalPoint = $details->sum('point');
            $members    = $details->pluck('user.name')->unique()->values()->all();

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
}
