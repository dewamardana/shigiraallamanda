<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\DailyPoint;
use Illuminate\Http\Request;
use App\Models\CheckerRecord;
use App\Models\CleaningRecord;
use App\Models\OfficeTaskDetail;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{


    public function index(Request $request)
    {
        $title = __('dashboardIndex.title_dashboard');

        // --- Card Statistik ---
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();

        $totalCleaning = [
            'activity' => DailyPoint::where('activity_type', 'Cleaning')->count(),
            'point'    => DailyPoint::where('activity_type', 'Cleaning')->sum('point')
        ];
        $totalChecker = [
            'activity' => DailyPoint::where('activity_type', 'Checker')->count(),
            'point'    => DailyPoint::where('activity_type', 'Checker')->sum('point')
        ];
        $totalOffice = [
            'activity' => DailyPoint::where('activity_type', 'Office')->count(),
            'point'    => DailyPoint::where('activity_type', 'Office')->sum('point')
        ];

        // --- Semua User ---
        $users = User::all();
        $labels = $users->pluck('nama');

        $cleaning = $users->map(
            fn($u) => DailyPoint::where('user_id', $u->id)->where('activity_type', 'Cleaning')->sum('point')
        );
        $checker = $users->map(
            fn($u) => DailyPoint::where('user_id', $u->id)->where('activity_type', 'Checker')->sum('point')
        );
        $office = $users->map(
            fn($u) => DailyPoint::where('user_id', $u->id)->where('activity_type', 'Office')->sum('point')
        );

        $chartData = [
            'labels'   => $labels,
            'cleaning' => $cleaning,
            'checker'  => $checker,
            'office'   => $office,
        ];

        // --- Leaderboard (semua user) ---
        $leaderboard = DailyPoint::select('user_id', DB::raw('SUM(point) as total'))
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('total')
            ->get();

        $leaderboardData = [
            'labels' => $leaderboard->pluck('user.nama'),
            'points' => $leaderboard->pluck('total'),
        ];

        // --- Tren Harian ---
        $dailyStats = DailyPoint::select('date', 'activity_type as type', DB::raw('SUM(point) as total'))
            ->groupBy('date', 'activity_type')
            ->orderBy('date')
            ->get();

        return view('Dashboard.index', compact(
            'title',
            'totalUsers',
            'activeUsers',
            'totalCleaning',
            'totalChecker',
            'totalOffice',
            'chartData',
            'leaderboardData',
            'dailyStats'
        ));
    }
}
