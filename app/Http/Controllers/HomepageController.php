<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Task;
use App\Models\User;
use App\Models\Skill;
use App\Models\Checks;
use App\Models\Report;
use App\Models\Formula;
use App\Models\Building;
use App\Models\Cleaning;
use App\Models\FoundItem;
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
use App\Models\CheckerRecordDetail;
use App\Models\CleaningRecordDetail;
use App\Models\CheckerRecordLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

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

    public function getRooms($groupId)
    {
        $group = CleaningGroup::with('rooms')->find($groupId);

        if (!$group) {
            return response()->json([], 404);
        }

        $rooms = $group->rooms->map(fn($r) => [
            'id' => $r->id,
            'name' => $r->room_name,
        ]);

        return response()->json($rooms);
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
            'rooms_selected'    => 'nullable|array',
        ]);

        $group = CleaningGroup::with('tasks')->findOrFail($validated['cleaning_group_id']);
        $memberCount   = count($validated['members']);

        // 1. simpan record utama
        $record = CleaningRecord::create([
            'cleaning_group_id' => $validated['cleaning_group_id'],
            'user_id'           => $validated['user_id'],
            'member_count'      => $memberCount,
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
                    $personalValue = $memberCount > 0 ? $calculated / $memberCount : 0;

                    // 🔹 Ambil rooms dari input hidden (bisa array)
                    $rooms = $validated['rooms_selected'][$taskId] ?? [];

                    // Pastikan yang disimpan selalu array (agar cocok dengan kolom JSON)
                    if (!is_array($rooms)) {
                        $rooms = explode(',', (string) $rooms);
                    }

                    $rooms = array_map('intval', $rooms);

                    $record->details()->create([
                        'cleaning_task_id' => $taskId,
                        'value'            => $value,
                        'personal_value'   => $personalValue,
                        'formula'          => $formula,
                        'calculated'       => $calculated,
                        'rooms'            => $rooms,
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

        // GEDUNG (cleaning_groups)
        $groups = CleaningGroup::with('rooms')
            ->where('status', 'active')
            ->get();

        return view('Homepage.checker', [
            'title' => $title,
            'user'  => $user,
            'tasks' => $tasks,
            'groups' => $groups,
        ]);
    }

    public function checkerStore(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'date'       => 'required|date',
            'total_room' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {

            /* =============================
           1. SIMPAN HEADER RECORD
        ============================= */
            $record = CheckerRecord::create([
                'user_id'     => $request->user_id,
                'date'        => $request->date,
                'total_point' => 0, // update di akhir
            ]);

            $grandTotal = 0;

            /* =============================
           2. LOOP TASK AKTIF
        ============================= */
            $tasks = CheckerTask::where('active', true)->get();

            foreach ($tasks as $task) {

                // 🔹 value = jumlah room
                $value = (int) $request->input("tasks.{$task->id}", 0);

                if ($value <= 0) {
                    continue;
                }

                /* =============================
               3. HITUNG POINT
            ============================= */
                $calculated = $value * $task->formula;
                $grandTotal += $calculated;

                /* =============================
               4. SIMPAN DETAIL TASK
            ============================= */
                $detail = CheckerRecordDetail::create([
                    'checker_record_id' => $record->id,
                    'checker_task_id'   => $task->id,
                    'value'             => $value,
                    'formula'           => $task->formula,
                    'calculated'        => $calculated,
                ]);

                /* =============================
               5. SIMPAN LOKASI (GEDUNG & ROOM)
            ============================= */
                $groups = $request->input("groups_selected.{$task->id}");
                $rooms  = $request->input("rooms_selected.{$task->id}");

                if (!$groups || !$rooms) {
                    continue;
                }

                $roomMap = [];

                foreach (explode(',', $rooms) as $pair) {
                    [$groupId, $roomId] = explode(':', $pair);
                    $roomMap[$groupId][] = $roomId;
                }

                foreach ($roomMap as $groupId => $roomIds) {
                    CheckerRecordLocation::create([
                        'checker_record_detail_id' => $detail->id,
                        'cleaning_group_id'        => $groupId,
                        'rooms'                    => $roomIds, // otomatis json
                    ]);
                }
            }

            /* =============================
           6. UPDATE TOTAL POINT
        ============================= */
            $record->update([
                'total_point' => $grandTotal,
            ]);

            /* =============================
           7. DAILY POINT
        ============================= */
            $this->addDailyPoint(
                $request->user_id,
                $request->date,
                $grandTotal,
                'Checker',
                $record->id,
                [
                    'total_room' => $request->total_room
                ]
            );
        });

        return redirect()
            ->route('homepage')
            ->with('success', __('homepageControllerMessage.checker.success_store'));
    }


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
        $groups = CleaningGroup::all();

        return view('Homepage.report', compact('title', 'authUser', 'users', 'groups', 'reportType'));
    }

    public function getRoomsNumber($group_id)
    {
        $rooms = Room::where('cleaning_group_id', $group_id)->get();

        return response()->json($rooms);
    }

    public function reportStore(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'report_type'  => 'required|string|max:255',
            'description'  => 'required|',
            'group_id'     => 'required|exists:cleaning_groups,id',
            'room_id'      => 'required|exists:rooms,id',
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
                'group_id'    => $validated['group_id'],
                'room_id'     => $validated['room_id'],
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

        $reportsQuery = Report::with([
            'media',
            'members',
            'group',
            'room'
        ])->where('user_id', $user->id);

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


    public function replyAndUpdate(Request $request, Report $report)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'reply'           => 'required|string',
            'status'          => 'required|in:pending,in_progress,resolved,rejected',
            'point'           => 'nullable|integer|min:0',

            'delete_media'    => 'nullable|array',
            'delete_media.*'  => 'integer|exists:report_media,id',

            'new_photos.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:20480',
            'new_videos.*'    => 'nullable|mimetypes:video/mp4,video/quicktime|max:20480',
        ]);

        DB::transaction(function () use ($request, $report, $validated, $user) {

            // ================= UPDATE REPORT =================
            $report->update([
                'reply'             => $validated['reply'],
                'point'             => $validated['point'] ?? 0,
                'status'            => $validated['status'],
                'status_updated_by' => $user->id,
            ]);

            // ================= DELETE MEDIA =================
            if ($request->filled('delete_media')) {
                $medias = $report->media()
                    ->whereIn('id', $request->delete_media)
                    ->get();

                foreach ($medias as $media) {
                    Storage::disk('public')->delete($media->path);
                    $media->delete();
                }
            }

            // ================= UPLOAD PHOTO =================
            if ($request->hasFile('new_photos')) {
                foreach ($request->file('new_photos') as $photo) {
                    $path = $photo->store('reports/photos', 'public');

                    $report->media()->create([
                        'type' => 'photo',
                        'path' => $path,
                    ]);
                }
            }

            // ================= UPLOAD VIDEO =================
            if ($request->hasFile('new_videos')) {
                foreach ($request->file('new_videos') as $video) {
                    $path = $video->store('reports/videos', 'public');

                    $report->media()->create([
                        'type' => 'video',
                        'path' => $path,
                    ]);
                }
            }
        });

        return redirect()
            ->back()
            ->with('success', __('dashboardReportData.controller.reply.success_reply'));
    }

    public function reportHistoryDetail(Report $report)
    {
        // 🔒 Security: pastikan report milik user login
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $report->load(['user', 'media', 'members']);

        return view('Homepage.reportHistoryDetail', [
            'title'  => 'Report Detail',
            'report' => $report,
        ]);
    }

    public function lost()
    {
        $title = "Report Lost Item";
        $user = Auth::user();

        return view('Homepage.lost', compact('title', 'user'));
    }

    public function lostStore(Request $request)
    {

        // 🔹 Validasi input
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date'],
            'found_by_id' => ['required', 'exists:users,id'],
            'nameItem' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'media_files.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,mp4,mov,avi', 'max:5000'], // 5MB per file
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 🔹 Simpan file media (jika ada)
        $mediaPaths = [];
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                if ($file->isValid()) {
                    // simpan di folder storage/app/public/found_items
                    $path = $file->store('found_items', 'public');
                    $mediaPaths[] = $path;
                }
            }
        }

        // 🔹 Simpan ke database
        FoundItem::create([
            'date' => $request->date,
            'found_by_id' => $request->found_by_id,
            'name' => $request->nameItem,
            'location' => $request->location,
            'description' => $request->description,
            'serial_number' => $request->serial_number,
            'media_files' => $mediaPaths,
            'status' => 0,
        ]);

        return redirect()->route('homepage')->with('success', 'Data barang ditemukan berhasil disimpan.');
    }

    public function profile(Request $request)
    {
        $userdata = Auth::user();
        $userId = $userdata->id;
        $title = $userdata->nama . ' Profile ';
        $user = User::with('skills')->where('id', $userdata->id)->first();
        $skills = Skill::all();

        $year = now()->year;
        $month = now()->month;

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



        return view('Homepage.profile', [
            'skills'            => $skills,
            'title'             => $title,
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

    public function userprofileUpdate(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:users,email,' . $user->id,
            'nomor_telp'  => 'nullable|string|max:20',
            'gender'      => 'required|in:L,P',
            'skills'      => 'nullable|array',
            'skills.*'    => 'exists:skills,id',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required'        => __('dashboardUser.controller.upload.name_required'),
            'email.required'       => __('dashboardUser.controller.upload.email_required'),
            'email.unique'         => __('dashboardUser.controller.upload.email_unique'),
            'nomor_telp.max'       => __('dashboardUser.controller.upload.phone_max'),
            'gender.in'            => __('dashboardUser.controller.upload.gender_in'),
            'foto.image'           => __('dashboardUser.controller.upload.photo_error'),
            'foto.mimes'           => __('dashboardUser.controller.upload.photo_mimes'),
            'foto.max'             => __('dashboardUser.controller.upload.photo_max'),
        ]);

        // Update data utama
        $user->fill([
            'nama'       => $validated['nama'],
            'email'      => $validated['email'],
            'nomor_telp' => $validated['nomor_telp'] ?? $user->nomor_telp,
            'gender'     => $validated['gender'],
        ]);

        // Jika ada foto baru
        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }

            // simpan foto baru
            $fotoPath = $request->file('foto')->store('foto', 'public');
            $user->foto = $fotoPath;
        }

        $user->save();

        // Sinkronisasi skills (jika ada)
        $user->skills()->sync($request->skills ?? []);

        return redirect()
            ->route('userprofile')
            ->with('success', __('dashboardUser.controller.upload.success_edit'));
    }


    public function selectGroup()
    {
        $title = 'All Buillding | Homepage';
        $groups = CleaningGroup::where('status', 'active')->get();
        return view('Homepage.RoomHistory.index', compact('title', 'groups'));
    }

    public function showGroup($slug)
    {
        $title = 'All Rooms | Homepage';
        $group = CleaningGroup::where('slug', $slug)->firstOrFail();
        $today = now()->toDateString();

        // Semua room milik group ini
        $rooms = Room::where('cleaning_group_id', $group->id)->get();

        // Ambil semua record detail milik group ini
        $details = CleaningRecordDetail::whereHas('record', function ($q) use ($group) {
            $q->where('cleaning_group_id', $group->id);
        })->get();

        // 🔹 Buat array untuk menyimpan tanggal terakhir setiap room dibersihkan
        $lastCleaned = [];

        foreach ($details as $detail) {
            foreach ($detail->rooms ?? [] as $roomId) {
                $recordDate = $detail->record->date ?? null;
                if ($recordDate) {
                    // Simpan tanggal terbaru
                    if (!isset($lastCleaned[$roomId]) || $recordDate > $lastCleaned[$roomId]) {
                        $lastCleaned[$roomId] = $recordDate;
                    }
                }
            }
        }

        // 🔹 Ambil semua room yang sudah dibersihkan hari ini
        $doneRooms = array_keys(array_filter($lastCleaned, fn($date) => $date === $today));

        return view('Homepage.RoomHistory.group', compact('title', 'group', 'rooms', 'doneRooms', 'lastCleaned', 'today'));
    }

    public function show(Request $request, $id)
    {
        $title = 'Room History | Homepage';
        $room = Room::findOrFail($id);

        $cleaningTaskId = $request->query('cleaning_task');
        $checkerTaskId  = $request->query('checker_task');

        // ================= QUICK INFO =================

        // Cleaning terakhir
        $lastCleaning = CleaningRecord::whereHas('details', function ($q) use ($room) {
            $q->whereJsonContains('rooms', $room->id);
        })
            ->with(['members', 'group'])
            ->orderByDesc('date')
            ->first();

        // Checker terakhir
        $lastChecker = CheckerRecord::whereHas('details.locations', function ($q) use ($room) {
            $q->whereJsonContains('rooms', (string) $room->id);
        })
            ->with('user')
            ->orderByDesc('date')
            ->first();

        // Report aktif
        $activeReportsCount = Report::where('room_id', $room->id)
            ->whereIn('status', ['pending', 'in_progress'])
            ->count();


        $cleaningPaginated = CleaningRecord::with([
            'details' => function ($q) use ($room, $cleaningTaskId) {
                $q->whereJsonContains('rooms', $room->id)
                    ->when(
                        $cleaningTaskId,
                        fn($qq) =>
                        $qq->where('cleaning_task_id', $cleaningTaskId)
                    )
                    ->with('task');
            },
            'members',
            'group',
        ])
            ->whereHas('details', function ($q) use ($room, $cleaningTaskId) {
                $q->whereJsonContains('rooms', $room->id)
                    ->when(
                        $cleaningTaskId,
                        fn($qq) =>
                        $qq->where('cleaning_task_id', $cleaningTaskId)
                    );
            })
            ->orderByDesc('date')
            ->paginate(8, ['*'], 'cleaning_page')
            ->withQueryString();


        // ================= CHECKER (FIXED) =================
        $checkerPaginated = CheckerRecord::with([
            'user',
            'details' => function ($q) use ($room, $checkerTaskId) {
                $q->whereHas('locations', function ($loc) use ($room) {
                    $loc->whereJsonContains('rooms', (string) $room->id);
                })
                    ->when(
                        $checkerTaskId,
                        fn($qq) =>
                        $qq->where('checker_task_id', $checkerTaskId)
                    )
                    ->with(['task', 'locations.group']);
            }
        ])
            ->whereHas('details', function ($q) use ($room, $checkerTaskId) {
                $q->whereHas('locations', function ($loc) use ($room) {
                    $loc->whereJsonContains('rooms', (string) $room->id);
                })
                    ->when(
                        $checkerTaskId,
                        fn($qq) =>
                        $qq->where('checker_task_id', $checkerTaskId)
                    );
            })
            ->orderByDesc('date')
            ->paginate(8, ['*'], 'checker_page')
            ->withQueryString();


        // ================= REPORT =================
        $reports = Report::where('room_id', $room->id)
            ->orderByDesc('created_at')
            ->get();

        // ================= MASTER TASK =================
        $cleaningTasks = CleaningTask::where('status', 'active')->orderBy('name')->get();
        $checkerTasks  = CheckerTask::where('active', true)->orderBy('name')->get();

        return view('Homepage.RoomHistory.show', compact(
            'title',
            'room',
            'cleaningPaginated',
            'checkerPaginated',
            'reports',
            'lastCleaning',
            'lastChecker',
            'activeReportsCount',
            'cleaningTasks',
            'checkerTasks',
        ));
    }


    public function showAjax($id)
    {
        $room = Room::findOrFail($id);

        $history = CleaningRecordDetail::with([
            'task',
            'record.user',
            'record.group'
        ])
            ->whereJsonContains('rooms', $room->id)
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($detail) {
                return [
                    'tanggal' => $detail->record->date,
                    'task' => $detail->task->name,
                    'petugas' => $detail->record->user->name ?? '-',
                    'group' => $detail->record->group->building_name ?? '-',
                ];
            });

        return response()->json([
            'room_name' => $room->room_name,
            'history' => $history,
        ]);
    }
}
