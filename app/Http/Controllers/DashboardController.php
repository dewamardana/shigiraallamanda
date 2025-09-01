<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Checks;
use App\Models\Cleaning;
use App\Models\DailyPoint;
use App\Models\OfficeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $title = __('dashboardIndex.title_dashboard');

        $startDate = \DateTime::createFromFormat('d/m/Y', request('start_date'));
        $endDate   = \DateTime::createFromFormat('d/m/Y', request('end_date'));

        $totalUsers  = User::count();
        $activeUsers = User::where('status', 'active')->count();

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

        // Total Poin Per User dari tabel daily_points
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

        $mostActiveUser = $totalPointsPerUser->first();

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

        return view('Dashboard.index', compact(
            'title',
            'totalUsers',
            'activeUsers',
            'mostActiveUser',
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
        ));
    }
}
