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
use App\Models\ReportMedia;
use App\Models\CheckRecords;
use App\Models\FormulaCheck;
use App\Models\OfficeRecord;
use App\Models\ReportMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CleaningRecords;
use App\Models\OfficeTaskDetail;
use App\Models\DailyCleaningPoint;
use App\Models\ReportType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index() {
        $title = __('homepageControllerMessage.index.title');
        $user = Auth::user();
        return view('Homepage.index',[
            'title' => $title,
            'user'  => $user,
        ]);
    }

    public function cleaning(){
        $title = __('homepageControllerMessage.cleaning.title');
        $user = User::where('status', 'Active')->get();
        $user_id = Auth::user();
        $building = Building::all();
        return view('Homepage.cleaning',[
            'title' => $title,
            'users' => $user,
            'building' => $building,
            'user_id' => $user_id,
        ]);
    }

    public function cleaningstore(Request $request){
        
        $validated = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'user_id'    => 'required|integer',
            'oa'         => 'required|integer|min:0',
            'ov'         => 'required|integer|min:0',
            'stay'       => 'required|integer|min:0',
            'vec'        => 'required|integer|min:0',
            'premier'    => 'nullable|integer|min:0',
            'date'       => 'required|date',
            'total_room' => 'required|integer|min:0',
            'members'    => 'required|array',
            'members.*'  => 'exists:users,id'
        ],[
            'building_id.required' => __('homepageControllerMessage.cleaning.validation.building_required'),
            'building_id.exists'   => __('homepageControllerMessage.cleaning.validation.building_id_exists'),

            'oa.required'          => __('homepageControllerMessage.cleaning.validation.oa_required'),
            'oa.integer'           => __('homepageControllerMessage.cleaning.validation.oa_integer'),
            'oa.min'               => __('homepageControllerMessage.cleaning.validation.oa_min'),

            'ov.required'          => __('homepageControllerMessage.cleaning.validation.ov_required'),
            'ov.integer'           => __('homepageControllerMessage.cleaning.validation.ov_integer'),
            'ov.min'               => __('homepageControllerMessage.cleaning.validation.ov_min'),

            'stay.required'        => __('homepageControllerMessage.cleaning.validation.stay_required'),
            'stay.integer'         => __('homepageControllerMessage.cleaning.validation.stay_integer'),
            'stay.min'             => __('homepageControllerMessage.cleaning.validation.stay_min'),

            'vec.required'         => __('homepageControllerMessage.cleaning.validation.vec_required'),
            'vec.integer'          => __('homepageControllerMessage.cleaning.validation.vec_integer'),
            'vec.min'              => __('homepageControllerMessage.cleaning.validation.vec_min'),

            'date.required'        => __('homepageControllerMessage.cleaning.validation.date_required'),
            'date.date'            => __('homepageControllerMessage.cleaning.validation.date_date'), 

            'total_room.required'  => __('homepageControllerMessage.cleaning.validation.total_room_required'),
            'total_room.integer'   => __('homepageControllerMessage.cleaning.validation.total_room_integer'),
            'total_room.min'       => __('homepageControllerMessage.cleaning.validation.total_room_min'),

            'members.required'     => __('homepageControllerMessage.cleaning.validation.members_required'),
            'members.array'        => __('homepageControllerMessage.cleaning.validation.members_array'),
            'members.*.exists'     => __('homepageControllerMessage.cleaning.validation.members_exists')
        ]);
    
        $validated['premier'] = $validated['premier'] ?? 0;
    
        // Simpan cleaning record
        $cleaning = Cleaning::create($validated);
        $cleaning->members()->attach($validated['members']);
    
        // Ambil slug building
        $building = Building::findOrFail($validated['building_id']);
        $buildingSlug = $building->slug;
    
        $memberCount = count($validated['members']);
        $formulaKey = $memberCount;
    
        // Ambil formula sesuai building & member count
        $formula = Formula::where('building_slug', $buildingSlug)
                    ->where('member_count', $formulaKey)
                    ->first();
    
        if (!$formula) {
            return redirect()->back()->with('warning', __('homepageControllerMessage.cleaning.warning_formula'));
        }
            
        // Hitung total poin dari hasil perkalian masing-masing kategori dengan formula
        $oaPoint   = $validated['oa'] * $formula->oa;
        $ovPoint   = $validated['ov'] * $formula->ov;
        $stayPoint = $validated['stay'] * $formula->stay;
        $vecPoint  = $validated['vec'] * $formula->vec;
    
        $total = $oaPoint + $ovPoint + $stayPoint + $vecPoint;
    
        if ($buildingSlug === 'royal') {
            $total += $validated['premier'] * $formula->premier;
        }
    
        // Hitung poin per member
        $poinPerMember = $memberCount > 0 ? $total / $memberCount : 0;
    

        // Simpan ke tabel poin_records
        CleaningRecords::create([
            'cleaning_id'   => $cleaning->id,
            'user_id'       => $validated['user_id'],
            'member_count'  => $memberCount,
            'oa'            => $formula->oa,
            'ov'            => $formula->ov,
            'stay'          => $formula->stay,
            'vec'           => $formula->vec,
            'premier'       => $buildingSlug === 'royal' ? $formula->premier : null,
        ]);


        // Simpan ke tabel daily_cleaning_points
        $date = $validated['date'];
        foreach ($validated['members'] as $memberId) {
            $detail = [
                'OA' => $validated['oa'],
                'OV' => $validated['ov'],
                'Stay' => $validated['stay'],
                'Vec' => $validated['vec']
            ];
            if ($buildingSlug === 'royal') {
                $detail['Premier'] = $validated['premier'];
            }

            $this->addDailyPoint(
                $memberId,
                $date,
                $poinPerMember,
                'Cleaning',
                $detail
            );
        }

        return redirect()->route('homepage')->with('success', __('homepageControllerMessage.cleaning.success_store'));
    }

    public function checker() {
        $title = __('homepageControllerMessage.checker.title');
        $user = Auth::user();
        return view('Homepage.checker',[
            'title' => $title,
            'user'  => $user,
        ]);
    }

    public function checkerStore(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'jumlah_kamar' => 'required|integer|min:0',
        ], [
            'user_id.required' => __('homepageControllerMessage.checker.validation.user_id_required'),
            'user_id.exists' =>  __('homepageControllerMessage.checker.validation.user_id_exists'),
            'date.required' =>  __('homepageControllerMessage.checker.validation.date_required'),
            'date.date' =>  __('homepageControllerMessage.checker.validation.date_date'),
            'jumlah_kamar.required' =>  __('homepageControllerMessage.checker.validation.jumlah_kamar_required'),
            'jumlah_kamar.integer' =>  __('homepageControllerMessage.checker.validation.jumlah_kamar_integer'),
            'jumlah_kamar.min' =>  __('homepageControllerMessage.checker.validation.jumlah_kamar_min'),
        ]);

        // Ambil formula yang aktif
        $formulaCheck = FormulaCheck::where('active', true)->first();

        if (!$formulaCheck) {
            return redirect()->route('homepage')->with('error',  __('homepageControllerMessage.checker.error_no_formula'));
        }

        // Hitung total poin berdasarkan formula aktif dan input user
        $total = 
            ($request->jumlah_kamar * $formulaCheck->jumlah_kamar) +
            ($request->has('mengajar') ? $formulaCheck->mengajar : 0) +
            ($request->has('pembersihan_khusus') ? $formulaCheck->pembersihan_khusus : 0) +
            ($request->has('membawa_bagasi') ? $formulaCheck->mengangkat_barang : 0) +
            ($request->has('membersihkan_gudang') ? $formulaCheck->membersihkan_gudang : 0) +
            ($request->has('obat_pool') ? $formulaCheck->obat_pool : 0) +
            ($request->has('membersihkan_kolam') ? $formulaCheck->membersihkan_pool : 0) +
            ($request->has('sampah') ? $formulaCheck->sampah : 0);

        // Simpan ke tabel `checks`
        $check = Checks::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'jumlah_kamar' => $request->jumlah_kamar,
            'mengajar' => $request->has('mengajar'),
            'pembersihan_khusus' => $request->has('pembersihan_khusus'),
            'mengangkat_barang' => $request->has('membawa_bagasi'),
            'membersihkan_gudang' => $request->has('membersihkan_gudang'),
            'obat_pool' => $request->has('obat_pool'),
            'membersihkan_pool' => $request->has('membersihkan_kolam'),
            'sampah' => $request->has('sampah'),
        ]);

        // Simpan ke `check_records`
        CheckRecords::create([
            'check_id'             => $check->id,
            'user_id'              => $request->user_id,
            'jumlah_kamar'         => $formulaCheck->jumlah_kamar,
            'mengajar'             => $formulaCheck->mengajar,
            'pembersihan_khusus'   => $formulaCheck->pembersihan_khusus,
            'mengangkat_barang'    => $formulaCheck->mengangkat_barang,
            'membersihkan_gudang'  => $formulaCheck->membersihkan_gudang,
            'obat_pool'            => $formulaCheck->obat_pool,
            'membersihkan_pool'    => $formulaCheck->membersihkan_pool,
            'sampah'               => $formulaCheck->sampah,
            'total'                => $total,
        ]);


        // Siapkan detail aktivitas untuk history
        $detail = [
            'Kamar' => $request->jumlah_kamar
        ];
        if ($request->has('mengajar')) $detail['Mengajar'] = 1;
        if ($request->has('pembersihan_khusus')) $detail['Pembersihan Khusus'] = 1;
        if ($request->has('membawa_bagasi')) $detail['Mengangkat Barang'] = 1;
        if ($request->has('membersihkan_gudang')) $detail['Membersihkan Gudang'] = 1;
        if ($request->has('obat_pool')) $detail['Obat Pool'] = 1;
        if ($request->has('membersihkan_kolam')) $detail['Membersihkan Kolam'] = 1;
        if ($request->has('sampah')) $detail['Sampah'] = 1;

        // Simpan ke tabel daily_cleaning_points (untuk history)
        $this->addDailyPoint(
            $request->user_id,
            $request->date,
            $total,
            'Checker', // jenis aktivitas
            $detail    // detail aktivitas
        );

        return redirect()->route('homepage')->with('success',  __('homepageControllerMessage.checker.success_store'));
    }

    // public function office() {
    //     $title = 'Office Input | Homepage';
    //     $user = Auth::user();

    //     $date = now()->format('Y-m-d');

    //     // Ambil task group aktif beserta relasi tasks dan detail siapa yang kerjakan
    //     $tasksActive = TaskGroup::where('active', true)
    //         ->with(['tasks.details' => function($q) use ($date) {
    //             $q->whereHas('record', function($qr) use ($date) {
    //                 $qr->where('date', $date);
    //             })->with('user');
    //         }])
    //         ->first();

    //     return view('Homepage.office', [
    //         'title'       => $title,
    //         'user'        => $user,
    //         'tasksActive' => $tasksActive,
    //         'date'        => $date,
    //     ]);
    // }

    public function office(Request $request)
    {
        $title = __('homepageControllerMessage.office.title');
        $user = Auth::user();

        // Default hari ini
        $date = now()->format('Y-m-d');

        $tasksActive = TaskGroup::where('active', true)
            ->with(['tasks.details' => function($q) use ($date) {
                $q->whereHas('record', function($qr) use ($date) {
                    $qr->where('date', $date);
                })->with('user');
            }])
            ->first();

        return view('Homepage.office', compact('title', 'user', 'tasksActive', 'date'));
    }


    public function officeStore(Request $request) {
        
         $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'tasks' => 'required|array',
            'task_group_id' => 'required|exists:task_groups,id',
        ],[
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

        // Loop setiap task untuk simpan ke OfficeTaskDetail
        foreach ($request->tasks as $taskId) {
            $task = Task::findOrFail($taskId); // Ambil model Task
            OfficeTaskDetail::create([
                'office_record_id' => $record->id, // Pasti isi dari record baru
                'task_id' => $task->id,
                'user_id' => $request->user_id,
                'point' => $task->point ?? 0, // Ambil point dari tabel tasks
            ]);
        }

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

        // Tambahkan ke DailyCleaningPoint
        $this->addDailyPoint(
            $request->user_id,
            $request->date,
            $totalPoint,
            'Office',
            ['Tasks' => implode(', ', $taskNames)]
        );

        return redirect()->route('homepage')->with('success', __('homepageControllerMessage.office.success_store'));
    }

    // private function addDailyPoint($userId, $date, $point)
    // {
    //     $existing = DailyCleaningPoint::where('user_id', $userId)
    //                 ->where('date', $date)
    //                 ->first();

    //     if ($existing) {
    //         $existing->total_point += $point;
    //         $existing->save();
    //     } else {
    //         DailyCleaningPoint::create([
    //             'user_id'     => $userId,
    //             'date'        => $date,
    //             'total_point' => $point
    //         ]);
    //     }
    // }

    public function history(Request $request)
    {
        $title = __('homepageControllerMessage.history.title');
        $userId = Auth::id();

        // Ambil start dan end date dari request (format dd/mm/yyyy -> Y-m-d)
        $startDate = $request->start_date ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d') : null;
        $endDate   = $request->end_date ? \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d') : null;

        // Query dasar
        $query = DailyCleaningPoint::where('user_id', $userId);

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

        // Rekap bulanan, juga mengikuti filter date kalau ada
        $monthlySummaryQuery = DailyCleaningPoint::where('user_id', $userId);
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


    public function report() {
            $title = __('homepageControllerMessage.report.title');
            $authUser = Auth::user();
            $reportType = ReportType::all();

            // Ambil semua user kecuali yang sedang login
            $users = User::all();

            return view('Homepage.report', compact('title','authUser','users', 'reportType'));
    }

    public function reportStore(Request $request) {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'report_type'  => 'required|string|max:255',
            'description'  => 'required|',
            'photos.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*'     => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:102400', // 100MB
            'members'      => 'nullable|array',
            'members.*'    => 'nullable|exists:users,id',
            'date'         => 'required|date',
        ],[
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

    public function reportHistory(Request $request) {
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

    public function profile(Request $request) {
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
            ->when($request->building_id, fn ($q) => $q->where('building_id', $request->building_id))
            ->when($startDate, fn ($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate,   fn ($q) => $q->whereDate('date', '<=', $endDate))
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
        $totalPointsPerUser = DailyCleaningPoint::select('user_id', DB::raw('SUM(point) as total_point'))
            ->when($startDate, fn ($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('date', '<=', $endDate))
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
        $activityLogs = DailyCleaningPoint::with('user')
            ->when($startDate, fn ($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('date', '<=', $endDate))
            ->orderBy('date', 'desc')
            ->get();

        $activityTypes = ['Cleaning', 'Checker', 'Office'];
        $topUsersPerActivity = [];

        foreach ($activityTypes as $type) {
            $topUsersPerActivity[$type] = DailyCleaningPoint::select('users.nama as nama')
                ->join('users', 'users.id', '=', 'daily_cleaning_points.user_id')
                ->where('activity_type', $type)
                ->groupBy('users.id', 'users.nama')
                ->selectRaw('users.nama as nama, SUM(point) as total')
                ->orderByDesc('total')
                ->limit(6)
                ->get();
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

    public function userprofileUpdate(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'username'    => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'       => 'required|email|max:255|unique:users,email,' . $user->id,
            'password'    => 'nullable|string|min:6',
            'nomor_telp'  => 'required|string|max:20',
            'gender'      => 'required|in:L,P',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required'        => __('userControllerMessage.upload.name_required'),
            'username.required'    => __('userControllerMessage.upload.username_required'),
            'username.unique'      => __('userControllerMessage.upload.username_unique'),
            'email.required'       => __('userControllerMessage.upload.email_required'),
            'email.unique'         => __('userControllerMessage.upload.email_unique'),
            'password.min'         => __('userControllerMessage.upload.password_min'),
            'nomor_telp.required'  => __('userControllerMessage.upload.phone_required'),
            'gender.in'            => __('userControllerMessage.upload.gender_in'),
            'foto.image'           => __('userControllerMessage.upload.photo_error'),
            'foto.mimes'           => __('userControllerMessage.upload.photo_mimes'),
            'foto.max'             => __('userControllerMessage.upload.photo_max'),
        ]);

        // Update basic fields
        $user->nama       = $validated['nama'];
        $user->username   = $validated['username'];
        $user->email      = $validated['email'];
        $user->nomor_telp = $validated['nomor_telp'];
        $user->gender     = $validated['gender'];

        // Jika password diisi
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // Jika ada foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('foto', 'public');
            $user->foto = $fotoPath;
        }

        $user->save();

        return redirect()
            ->route('homepage')
            ->with('success', 'Profile Berhasil di Perbarui');
    }


    private function addDailyPoint($userId, $date, $point, $activityType, array $detailArray = []){
        // Gabungkan detail array jadi string, contoh: "OA: 5, OV: 3"
        $detailString = collect($detailArray)
            ->map(fn($val, $key) => "$key: $val")
            ->implode(', ');

            DailyCleaningPoint::create([
                'user_id'         => $userId,
                'date'            => $date,
                'activity_type'   => $activityType,
                'activity_detail' => $detailString,
                'point'           => $point
            ]);
    }
}
