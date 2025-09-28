<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Checks;
use App\Models\Report;
use App\Models\Formula;
use App\Models\Building;
use App\Models\Cleaning;
use App\Models\TaskGroup;
use App\Models\DailyPoint;
use App\Models\ReportType;
use App\Models\CheckerTask;
use App\Models\ReportMedia;
use App\Models\CheckRecords;
use App\Models\CleaningTask;
use App\Models\FormulaCheck;
use App\Models\OfficeRecord;
use App\Models\ReportMember;
use Illuminate\Http\Request;
use App\Models\CheckerRecord;
use App\Models\CleaningGroup;
use App\Models\CleaningRecord;
use Illuminate\Support\Carbon;
use App\Models\CleaningRecords;
use App\Models\OfficeTaskDetail;
use App\Models\DailyCleaningPoint;
use App\Traits\HandlesDailyPoints;
use Illuminate\Support\Facades\DB;
use App\Models\CheckerRecordDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    use HandlesDailyPoints;

    public function index()
    {
        $title = __('homepageControllerMessage.index.title');
        $user = Auth::user();
        return view('Homepage.index', [
            'title' => $title,
            'user'  => $user,
        ]);
    }

    public function cleaning()
    {
        $title = __('homepageControllerMessage.cleaning.title');
        $users = User::all();
        $groups = CleaningGroup::all();
        $user_id = Auth::user(); // user login
        return view('Homepage.cleaning', [
            'title' => $title,
            'users' => $users,
            'groups' => $groups,
            'user_id' => $user_id,
        ]);
    }

    public function getTasks($id)
    {
        $group = CleaningGroup::with('tasks')->find($id);

        if (!$group) {
            return response()->json([], 404);
        }

        $tasks = $group->tasks->map(function ($task) {
            return [
                'id' => $task->id,
                'name' => $task->name,
                'formula' => $task->pivot->formula ?? null,
            ];
        });

        return response()->json($tasks);
    }


    public function cleaningStore(Request $request)
    {
        $validated = $request->validate([
            'cleaning_group_id' => 'required|exists:cleaning_groups,id',
            'user_id'           => 'required|exists:users,id',
            'date'              => 'required|date|after:2000-01-01',
            'total_room'        => 'required|integer|min:0',
            'members'           => 'required|array|min:1',
            'members.*'         => 'exists:users,id',
            'tasks'             => 'required|array',
            'tasks.*'           => 'integer|min:0',
        ]);

        $group = CleaningGroup::with('tasks')->findOrFail($validated['cleaning_group_id']);

        // 1. simpan record utama
        $record = CleaningRecord::create([
            'cleaning_group_id' => $validated['cleaning_group_id'],
            'user_id'           => $validated['user_id'],
            'member_count'      => count($validated['members']),
            'total_room'        => $validated['total_room'],
            'total_point'       => 0,
            'date'              => $validated['date'],
        ]);

        // 2. simpan anggota (pivot)
        $record->members()->attach($validated['members']);

        // 3. simpan detail per task
        $totalPoint = 0;
        $taskSummaries = [];

        foreach ($validated['tasks'] as $taskId => $value) {
            if ($value > 0) {
                $task = $group->tasks->firstWhere('id', $taskId);

                if ($task) {
                    $formula    = $task->pivot->formula ?? 1;
                    $calculated = $value * $formula;

                    $record->details()->create([
                        'cleaning_task_id' => $taskId,
                        'value'            => $value,
                        'formula'          => $formula,
                        'calculated'       => $calculated,
                    ]);

                    $totalPoint += $calculated;
                    $taskSummaries[$task->name] = $value;
                }
            }
        }

        // Update total_point di record utama
        $record->update([
            'total_point' => $totalPoint,
        ]);

        // 5. bagi rata ke member → simpan pakai trait
        $memberCount   = count($validated['members']);
        $poinPerMember = $memberCount > 0 ? $totalPoint / $memberCount : 0;

        foreach ($validated['members'] as $memberId) {
            $this->addDailyPoint(
                $memberId,
                $validated['date'],
                $poinPerMember,
                'Cleaning',        // langsung string
                $record->id,
                $taskSummaries     // hanya task + value
            );
        }


        return redirect()->route('homepage')
            ->with('success', 'Data cleaning berhasil disimpan.');
    }

    public function checker()
    {
        $title = __('homepageControllerMessage.checker.title');
        $user = Auth::user();

        // ambil semua task aktif
        $tasks = CheckerTask::where('active', true)->get();

        return view('Homepage.checker', [
            'title' => $title,
            'user'  => $user,
            'tasks' => $tasks,
        ]);
    }

    public function checkerStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date'    => 'required|date',
        ]);

        // simpan header record
        $record = CheckerRecord::create([
            'user_id'     => $request->user_id,
            'date'        => $request->date,
            'total_point' => 0, // akan diupdate
        ]);

        $total = 0;

        // loop semua task aktif
        $tasks = CheckerTask::where('active', true)->get();

        $detail = [];
        foreach ($tasks as $task) {
            $value = $request->input("task_{$task->id}");

            // boolean => 1/0
            if ($task->type === 'boolean') {
                $value = $value ? 1 : 0;
            }

            // hitung
            $calculated = $value * $task->formula;
            $total += $calculated;

            CheckerRecordDetail::create([
                'checker_record_id' => $record->id,
                'checker_task_id'   => $task->id,
                'value'             => $value,
                'formula'           => $task->formula,
                'calculated'        => $calculated,
            ]);

            // buat detail activity untuk history
            if ($value > 0) {
                $detail[$task->name] = $value;
            }
        }

        // update total point
        $record->update([
            'total_point' => $total
        ]);

        // tambahkan ke daily point
        $this->addDailyPoint(
            $request->user_id,
            $request->date,
            $total,
            'Checker', // type activity
            $record->id,
            $detail
        );

        return redirect()->route('homepage')->with('success', __('homepageControllerMessage.checker.success_store'));
    }
    // public function checkerStore(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'date' => 'required|date',
    //         'jumlah_kamar' => 'required|integer|min:0',
    //     ], [
    //         'user_id.required' => __('homepageControllerMessage.checker.validation.user_id_required'),
    //         'user_id.exists' =>  __('homepageControllerMessage.checker.validation.user_id_exists'),
    //         'date.required' =>  __('homepageControllerMessage.checker.validation.date_required'),
    //         'date.date' =>  __('homepageControllerMessage.checker.validation.date_date'),
    //         'jumlah_kamar.required' =>  __('homepageControllerMessage.checker.validation.jumlah_kamar_required'),
    //         'jumlah_kamar.integer' =>  __('homepageControllerMessage.checker.validation.jumlah_kamar_integer'),
    //         'jumlah_kamar.min' =>  __('homepageControllerMessage.checker.validation.jumlah_kamar_min'),
    //     ]);

    //     // Ambil formula yang aktif
    //     $formulaCheck = FormulaCheck::where('active', true)->first();

    //     if (!$formulaCheck) {
    //         return redirect()->route('homepage')->with('error',  __('homepageControllerMessage.checker.error_no_formula'));
    //     }

    //     // Hitung total poin berdasarkan formula aktif dan input user
    //     $total =
    //         ($request->jumlah_kamar * $formulaCheck->jumlah_kamar) +
    //         ($request->has('mengajar') ? $formulaCheck->mengajar : 0) +
    //         ($request->has('pembersihan_khusus') ? $formulaCheck->pembersihan_khusus : 0) +
    //         ($request->has('membawa_bagasi') ? $formulaCheck->mengangkat_barang : 0) +
    //         ($request->has('membersihkan_gudang') ? $formulaCheck->membersihkan_gudang : 0) +
    //         ($request->has('obat_pool') ? $formulaCheck->obat_pool : 0) +
    //         ($request->has('membersihkan_kolam') ? $formulaCheck->membersihkan_pool : 0) +
    //         ($request->has('sampah') ? $formulaCheck->sampah : 0);

    //     // Simpan ke tabel `checks`
    //     $check = Checks::create([
    //         'user_id' => $request->user_id,
    //         'date' => $request->date,
    //         'jumlah_kamar' => $request->jumlah_kamar,
    //         'mengajar' => $request->has('mengajar'),
    //         'pembersihan_khusus' => $request->has('pembersihan_khusus'),
    //         'mengangkat_barang' => $request->has('membawa_bagasi'),
    //         'membersihkan_gudang' => $request->has('membersihkan_gudang'),
    //         'obat_pool' => $request->has('obat_pool'),
    //         'membersihkan_pool' => $request->has('membersihkan_kolam'),
    //         'sampah' => $request->has('sampah'),
    //     ]);

    //     // Simpan ke `check_records`
    //     CheckRecords::create([
    //         'check_id'             => $check->id,
    //         'user_id'              => $request->user_id,
    //         'jumlah_kamar'         => $formulaCheck->jumlah_kamar,
    //         'mengajar'             => $formulaCheck->mengajar,
    //         'pembersihan_khusus'   => $formulaCheck->pembersihan_khusus,
    //         'mengangkat_barang'    => $formulaCheck->mengangkat_barang,
    //         'membersihkan_gudang'  => $formulaCheck->membersihkan_gudang,
    //         'obat_pool'            => $formulaCheck->obat_pool,
    //         'membersihkan_pool'    => $formulaCheck->membersihkan_pool,
    //         'sampah'               => $formulaCheck->sampah,
    //         'total'                => $total,
    //     ]);


    //     // Siapkan detail aktivitas untuk history
    //     $detail = [
    //         'Kamar' => $request->jumlah_kamar
    //     ];
    //     if ($request->has('mengajar')) $detail['Mengajar'] = 1;
    //     if ($request->has('pembersihan_khusus')) $detail['Pembersihan Khusus'] = 1;
    //     if ($request->has('membawa_bagasi')) $detail['Mengangkat Barang'] = 1;
    //     if ($request->has('membersihkan_gudang')) $detail['Membersihkan Gudang'] = 1;
    //     if ($request->has('obat_pool')) $detail['Obat Pool'] = 1;
    //     if ($request->has('membersihkan_kolam')) $detail['Membersihkan Kolam'] = 1;
    //     if ($request->has('sampah')) $detail['Sampah'] = 1;


    //     $this->addDailyPoint(
    //         $request->user_id,
    //         $request->date,
    //         $total,
    //         'Checker',        // langsung string
    //         $check->id,
    //         $detail     // hanya task + value
    //     );


    //     return redirect()->route('homepage')->with('success',  __('homepageControllerMessage.checker.success_store'));
    // }


    public function office(Request $request)
    {
        $title = __('homepageControllerMessage.office.title');
        $user = Auth::user();

        // Default hari ini
        $date = now()->format('Y-m-d');

        $tasksActive = TaskGroup::where('active', true)
            ->with(['tasks.details' => function ($q) use ($date) {
                $q->whereHas('record', function ($qr) use ($date) {
                    $qr->where('date', $date);
                })->with('user');
            }])
            ->first();

        return view('Homepage.office', compact('title', 'user', 'tasksActive', 'date'));
    }


    public function officeStore(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'tasks' => 'required|array',
            'task_group_id' => 'required|exists:task_groups,id',
        ], [
            'user_id.required'       => __('homepageControllerMessage.validation.user_id_required'),
            'user_id.exists'         => __('homepageControllerMessage.validation.user_id_exists'),
            'date.required'          => __('homepageControllerMessage.validation.date_required'),
            'date.date'              => __('homepageControllerMessage.validation.date_date'),
            'tasks.required'         => __('homepageControllerMessage.validation.tasks_required'),
            'tasks.array'            => __('homepageControllerMessage.validation.tasks_array'),
            'task_group_id.required' => __('homepageControllerMessage.validation.task_group_id_required'),
            'task_group_id.exists'   => __('homepageControllerMessage.validation.task_group_id_exists'),
        ]);

        // Simpan OfficeRecord
        $record = OfficeRecord::create([
            'task_group_id' => $request->task_group_id,
            'date' => $request->date,
        ]);

        $totalPoint = 0;
        $taskNames  = [];

        // Simpan OfficeTaskDetail & hitung poin
        foreach ($request->tasks as $taskId) {
            $task = Task::findOrFail($taskId);

            $totalPoint += $task->point ?? 0;
            $taskNames[] = $task->name ?? 'Unknown';

            OfficeTaskDetail::create([
                'office_record_id' => $record->id,
                'task_id'          => $task->id,
                'user_id'          => $request->user_id,
                'point'            => $task->point ?? 0,
            ]);
        }

        $this->addDailyPoint(
            $request->user_id,
            $request->date,
            $totalPoint,
            'Office',        // langsung string
            $record->id,
            ['Tasks' => implode(', ', $taskNames)],   // hanya task + value
        );


        return redirect()->route('homepage')->with('success', __('homepageControllerMessage.office.success_store'));
    }

    public function history(Request $request)
    {
        $title = __('homepageControllerMessage.history.title');
        $userId = Auth::id();

        // Ambil start dan end date dari request (format dd/mm/yyyy -> Y-m-d)
        $startDate = $request->start_date ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d') : null;
        $endDate   = $request->end_date ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d') : null;

        // Query dasar
        $query = DailyPoint::where('user_id', $userId);

        // Filter date range jika ada input
        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('date', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('date', '<=', $endDate);
        }

        // Ambil data poin per tanggal
        $points = $query->orderBy('date', 'desc')->get()->groupBy('date');

        // Format activity_type & activity_detail biar rapi
        $points = $points->map(function ($records) {
            return $records->map(function ($record) {
                // Rapiin activity_type -> hanya ambil nama kelas terakhir
                $record->activity_type = class_basename($record->activity_type);

                // Rapiin activity_detail
                if (is_array($record->activity_detail)) {
                    $record->activity_detail = json_encode($record->activity_detail, JSON_UNESCAPED_UNICODE);
                } elseif (is_string($record->activity_detail) && $this->isJson($record->activity_detail)) {
                    $decoded = json_decode($record->activity_detail, true);
                    $record->activity_detail = json_encode($decoded, JSON_UNESCAPED_UNICODE);
                }

                return $record;
            });
        });

        // Rekap bulanan
        $monthlySummaryQuery = DailyPoint::where('user_id', $userId);
        if ($startDate && $endDate) {
            $monthlySummaryQuery->whereBetween('date', [$startDate, $endDate]);
        } elseif ($startDate) {
            $monthlySummaryQuery->whereDate('date', '>=', $startDate);
        } elseif ($endDate) {
            $monthlySummaryQuery->whereDate('date', '<=', $endDate);
        } else {
            // Default: bulan ini
            $monthlySummaryQuery->whereMonth('date', now()->month)
                ->whereYear('date', now()->year);
        }

        $monthlySummary = $monthlySummaryQuery
            ->selectRaw('date, SUM(point) as total_point')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('Homepage.history', compact('points', 'monthlySummary', 'title'));
    }

    // Helper untuk cek JSON
    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }



    public function report()
    {
        $title = __('homepageControllerMessage.report.title');
        $authUser = Auth::user();
        $reportType = ReportType::all();

        // Ambil semua user kecuali yang sedang login
        $users = User::all();

        return view('Homepage.report', compact('title', 'authUser', 'users', 'reportType'));
    }

    public function reportStore(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'report_type'  => 'required|string|max:255',
            'description'  => 'required|',
            'photos.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*'     => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:102400', // 100MB
            'members'      => 'nullable|array',
            'members.*'    => 'nullable|exists:users,id',
            'date'         => 'required|date',
        ], [
            'user_id.required'     => __('homepageControllerMessage.report.validation.user_id_required'),
            'user_id.exists'       => __('homepageControllerMessage.report.validation.user_id_exists'),
            'report_type.required' => __('homepageControllerMessage.report.validation.report_type_required'),
            'report_type.string'   => __('homepageControllerMessage.report.validation.report_type_string'),
            'report_type.max'      => __('homepageControllerMessage.report.validation.report_type_max'),
            'description.required' => __('homepageControllerMessage.report.validation.description_required'),
            'description.string'   => __('homepageControllerMessage.report.validation.description_string'),
            'photos.*.image'       => __('homepageControllerMessage.report.validation.photos_image'),
            'photos.*.mimes'       => __('homepageControllerMessage.report.validation.photos_mimes'),
            'photos.*.max'         => __('homepageControllerMessage.report.validation.photos_max'),
            'videos.*.mimetypes'   => __('homepageControllerMessage.report.validation.videos_mimetypes'),
            'videos.*.max'         => __('homepageControllerMessage.report.validation.videos_max'),
            'members.array'        => __('homepageControllerMessage.report.validation.members_array'),
            'members.*.exists'     => __('homepageControllerMessage.report.validation.members_exists'),
            'date.required'        => __('homepageControllerMessage.report.validation.date_required'),
            'date.date'            => __('homepageControllerMessage.report.validation.date_date'),
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan report utama
            $report = Report::create([
                'user_id'     => $validated['user_id'],
                'report_type' => $validated['report_type'],
                'description' => $validated['description'] ?? null,
                'date'        => $validated['date'],
            ]);

            // 2. Simpan foto
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('report_photos', 'public');
                    ReportMedia::create([
                        'report_id' => $report->id,
                        'type'      => 'photo',
                        'path'      => $path,
                    ]);
                }
            }

            // 3. Simpan video
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    $path = $video->store('report_videos', 'public');
                    ReportMedia::create([
                        'report_id' => $report->id,
                        'type'      => 'video',
                        'path'      => $path,
                    ]);
                }
            }

            // 4. Simpan member report (jika ada)
            if (!empty($validated['members'])) {
                foreach ($validated['members'] as $memberId) {
                    if ($memberId) {
                        ReportMember::create([
                            'report_id' => $report->id,
                            'user_id'   => $memberId,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('homepage')->with('success', __('homepageControllerMessage.report.success_store'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => __('homepageControllerMessage.report.failed_store') . $e->getMessage()]);
        }
    }

    public function reportHistory(Request $request)
    {
        $title = __('homepageControllerMessage.reportHistory.title');
        $user = Auth::user();

        $reportsQuery = Report::with(['media', 'members'])
            ->where('user_id', $user->id);

        // Filter berdasarkan start_date dan end_date
        if ($request->filled('start_date')) {
            try {
                $startDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay();
                $reportsQuery->whereDate('date', '>=', $startDate);
            } catch (\Exception $e) {
                // format salah, bisa diabaikan atau log
            }
        }

        if ($request->filled('end_date')) {
            try {
                $endDate = Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay();
                $reportsQuery->whereDate('date', '<=', $endDate);
            } catch (\Exception $e) {
                // format salah
            }
        }

        $reports = $reportsQuery->latest()->get();

        return view('Homepage.reportHistory', [
            'title' => $title,
            'reports' => $reports,
        ]);
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $title = $user->nama . ' Profile ';

        $startDate = \DateTime::createFromFormat('d/m/Y', request('start_date'));
        $endDate   = \DateTime::createFromFormat('d/m/Y', request('end_date'));


        // Statistik harian dari tabel cleanings
        $dailyStats = Cleaning::selectRaw('date')
            ->selectRaw('SUM(oa) as total_oa')
            ->selectRaw('SUM(ov) as total_ov')
            ->selectRaw('SUM(stay) as total_stay')
            ->selectRaw('SUM(vec) as total_vec')
            ->selectRaw('SUM(premier) as total_premier')
            ->selectRaw('SUM(total_room) as total_room')
            ->when($request->building_id, fn($q) => $q->where('building_id', $request->building_id))
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate,   fn($q) => $q->whereDate('date', '<=', $endDate))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Tentukan range tanggal
        if ($startDate && $endDate) {
            $period = Carbon::parse($startDate)->daysUntil($endDate);
            $dates = [];
            foreach ($period as $date) {
                $dates[] = $date->format('Y-m-d');
            }
        } else {
            $dates = [];
            for ($i = 6; $i >= 0; $i--) {
                $dates[] = Carbon::now()->subDays($i)->format('Y-m-d');
            }
        }

        $oaData        = [];
        $ovData        = [];
        $stayData      = [];
        $vecData       = [];
        $premierData   = [];
        $totalRoomData = [];

        foreach ($dates as $date) {
            $stat = $dailyStats->firstWhere('date', $date);
            $oaData[]        = $stat ? $stat->total_oa : 0;
            $ovData[]        = $stat ? $stat->total_ov : 0;
            $stayData[]      = $stat ? $stat->total_stay : 0;
            $vecData[]       = $stat ? $stat->total_vec : 0;
            $premierData[]   = $stat ? $stat->total_premier : 0;
            $totalRoomData[] = $stat ? $stat->total_room : 0;
        }

        // Statistik per user
        $userStats = User::with(['cleanings' => function ($q) use ($startDate, $endDate, $request) {
            if ($request->building_id) {
                $q->where('building_id', $request->building_id);
            }
            if ($startDate) {
                $q->whereDate('cleanings.date', '>=', $startDate);
            }
            if ($endDate) {
                $q->whereDate('cleanings.date', '<=', $endDate);
            }
        }])
            ->get()
            ->map(function ($user) use ($dates) {
                $dailyTotals = array_fill_keys($dates, 0);

                foreach ($user->cleanings as $cleaning) {
                    $date = $cleaning->date;
                    if (isset($dailyTotals[$date])) {
                        $memberCount = $cleaning->members->count();
                        $dailyTotals[$date] += $memberCount ? ($cleaning->total_room / $memberCount) : 0;
                    }
                }

                return [
                    'nama'  => $user->nama,
                    'total' => array_sum($dailyTotals),
                    'data'  => array_values($dailyTotals)
                ];
            })->sortByDesc('total')->values();

        // Total Poin Per User dari tabel daily_cleaning_points
        $totalPointsPerUser = DailyPoint::select('user_id', DB::raw('SUM(point) as total_point'))
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
            ->groupBy('user_id')
            ->orderByDesc('total_point')
            ->with('user')
            ->get()
            ->map(function ($item) {
                return [
                    'nama'  => $item->user->nama ?? 'Unknown',
                    'total' => $item->total_point
                ];
            });

        // Ambil daftar aktivitas (activity_type & activity_detail)
        $activityLogs = DailyPoint::with('user')
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
            ->orderBy('date', 'desc')
            ->get();

        // Mapping activity_type => label
        $activityTypes = [
            Cleaning::class => 'Cleaning',
            Checks::class  => 'Checker',
            OfficeRecord::class   => 'Office',
        ];
        $topUsersPerActivity = [];

        foreach ($activityTypes as $type => $label) {
            $topUsersPerActivity[$label] = DailyPoint::with('user')
                ->select('user_id', DB::raw('SUM(point) as total'))
                ->where('activity_type', $type)
                ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
                ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
                ->groupBy('user_id')
                ->orderByDesc('total')
                ->limit(6)
                ->get()
                ->map(fn($item) => [
                    'nama'  => $item->user->nama ?? 'Unknown',
                    'total' => $item->total,
                ]);
        }

        return view('Homepage.profile', compact(
            'title',
            'dates',
            'oaData',
            'ovData',
            'stayData',
            'vecData',
            'premierData',
            'totalRoomData',
            'totalPointsPerUser',
            'userStats',
            'startDate',
            'endDate',
            'activityLogs',
            'topUsersPerActivity',
            'user',
        ));
    }

    // public function userprofileUpdate(Request $request, $slug)
    // {
    //     $user = User::where('slug', $slug)->firstOrFail();

    //     $validated = $request->validate([
    //         'nama'        => 'required|string|max:255',
    //         'username'    => 'required|string|max:255|unique:users,username,' . $user->id,
    //         'email'       => 'required|email|max:255|unique:users,email,' . $user->id,
    //         'password'    => 'nullable|string|min:6',
    //         'nomor_telp'  => 'required|string|max:20',
    //         'gender'      => 'required|in:L,P',
    //         'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ], [
    //         'nama.required'        => __('userControllerMessage.upload.name_required'),
    //         'username.required'    => __('userControllerMessage.upload.username_required'),
    //         'username.unique'      => __('userControllerMessage.upload.username_unique'),
    //         'email.required'       => __('userControllerMessage.upload.email_required'),
    //         'email.unique'         => __('userControllerMessage.upload.email_unique'),
    //         'password.min'         => __('userControllerMessage.upload.password_min'),
    //         'nomor_telp.required'  => __('userControllerMessage.upload.phone_required'),
    //         'gender.in'            => __('userControllerMessage.upload.gender_in'),
    //         'foto.image'           => __('userControllerMessage.upload.photo_error'),
    //         'foto.mimes'           => __('userControllerMessage.upload.photo_mimes'),
    //         'foto.max'             => __('userControllerMessage.upload.photo_max'),
    //     ]);

    //     // Update basic fields
    //     $user->nama       = $validated['nama'];
    //     $user->username   = $validated['username'];
    //     $user->email      = $validated['email'];
    //     $user->nomor_telp = $validated['nomor_telp'];
    //     $user->gender     = $validated['gender'];

    //     // Jika password diisi
    //     if (!empty($validated['password'])) {
    //         $user->password = bcrypt($validated['password']);
    //     }

    //     // Jika ada foto baru
    //     if ($request->hasFile('foto')) {
    //         // Hapus foto lama
    //         if ($user->foto && Storage::exists('public/' . $user->foto)) {
    //             Storage::delete('public/' . $user->foto);
    //         }
    //         // Simpan foto baru
    //         $fotoPath = $request->file('foto')->store('foto', 'public');
    //         $user->foto = $fotoPath;
    //     }

    //     $user->save();

    //     return redirect()
    //         ->route('homepage')
    //         ->with('success', 'Profile Berhasil di Perbarui');
    // }
}
