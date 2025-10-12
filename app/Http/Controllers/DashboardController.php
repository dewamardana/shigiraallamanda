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

        $startDate = null;
        $endDate   = null;

        if ($request->filled('start_date')) {
            $startDateObj = \DateTime::createFromFormat('d/m/Y', $request->start_date);
            if ($startDateObj) {
                $startDate = $startDateObj->format('Y-m-d');
            }
        }

        if ($request->filled('end_date')) {
            $endDateObj = \DateTime::createFromFormat('d/m/Y', $request->end_date);
            if ($endDateObj) {
                $endDate = $endDateObj->format('Y-m-d');
            }
        }

        // --- Card Statistik ---
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();

        $totalCleaning = [
            'activity' => DailyPoint::where('activity_type', 'Cleaning')
                ->when($startDate && $endDate, fn($q) => $q->whereBetween('date', [$startDate, $endDate]))
                ->when($startDate && !$endDate, fn($q) => $q->where('date', '>=', $startDate))
                ->when(!$startDate && $endDate, fn($q) => $q->where('date', '<=', $endDate))
                ->count(),
            'point'    => DailyPoint::where('activity_type', 'Cleaning')
                ->when($startDate && $endDate, fn($q) => $q->whereBetween('date', [$startDate, $endDate]))
                ->when($startDate && !$endDate, fn($q) => $q->where('date', '>=', $startDate))
                ->when(!$startDate && $endDate, fn($q) => $q->where('date', '<=', $endDate))
                ->sum('point')
        ];
        $totalChecker = [
            'activity' => DailyPoint::where('activity_type', 'Checker')
                ->when($startDate && $endDate, fn($q) => $q->whereBetween('date', [$startDate, $endDate]))
                ->when($startDate && !$endDate, fn($q) => $q->where('date', '>=', $startDate))
                ->when(!$startDate && $endDate, fn($q) => $q->where('date', '<=', $endDate))
                ->count(),
            'point'    => DailyPoint::where('activity_type', 'Checker')
                ->when($startDate && $endDate, fn($q) => $q->whereBetween('date', [$startDate, $endDate]))
                ->when($startDate && !$endDate, fn($q) => $q->where('date', '>=', $startDate))
                ->when(!$startDate && $endDate, fn($q) => $q->where('date', '<=', $endDate))
                ->sum('point')
        ];
        $totalOffice = [
            'activity' => DailyPoint::where('activity_type', 'Office')
                ->when($startDate && $endDate, fn($q) => $q->whereBetween('date', [$startDate, $endDate]))
                ->when($startDate && !$endDate, fn($q) => $q->where('date', '>=', $startDate))
                ->when(!$startDate && $endDate, fn($q) => $q->where('date', '<=', $endDate))
                ->count(),
            'point'    => DailyPoint::where('activity_type', 'Office')
                ->when($startDate && $endDate, fn($q) => $q->whereBetween('date', [$startDate, $endDate]))
                ->when($startDate && !$endDate, fn($q) => $q->where('date', '>=', $startDate))
                ->when(!$startDate && $endDate, fn($q) => $q->where('date', '<=', $endDate))
                ->sum('point')
        ];

        // --- Semua User ---
        $users = User::all();

        // Ambil poin per aktivitas
        $points = $users->map(function ($u) use ($startDate, $endDate) {

            $query = fn($q) => $q
                ->when($startDate && $endDate, fn($q) => $q->whereBetween('date', [$startDate, $endDate]))
                ->when($startDate && !$endDate, fn($q) => $q->where('date', '>=', $startDate))
                ->when(!$startDate && $endDate, fn($q) => $q->where('date', '<=', $endDate));

            return [
                'id'       => $u->id,
                'nama'     => $u->nama,
                'cleaning' => DailyPoint::where('user_id', $u->id)->where('activity_type', 'Cleaning')->tap($query)->sum('point'),
                'checker'  => DailyPoint::where('user_id', $u->id)->where('activity_type', 'Checker')->tap($query)->sum('point'),
                'office'   => DailyPoint::where('user_id', $u->id)->where('activity_type', 'Office')->tap($query)->sum('point'),
            ];
        });

        // Hanya user dengan total poin > 0
        $usersWithPoints = $points->filter(fn($p) => ($p['cleaning'] + $p['checker'] + $p['office']) > 0);

        // Urutkan setiap kategori dari terbesar ke terkecil
        $cleaningSorted = $points->sortByDesc('cleaning')->values();
        $checkerSorted  = $points->sortByDesc('checker')->values();
        $officeSorted   = $points->sortByDesc('office')->values();

        $chartData = [
            'labels'   => $points->pluck('nama'),
            'cleaning' => $points->pluck('cleaning'),
            'checker'  => $points->pluck('checker'),
            'office'   => $points->pluck('office'),

            // Tambahan untuk filter "user dengan poin"
            'hasPointLabels'   => $usersWithPoints->pluck('nama'),
            'hasPointCleaning' => $usersWithPoints->pluck('cleaning'),
            'hasPointChecker'  => $usersWithPoints->pluck('checker'),
            'hasPointOffice'   => $usersWithPoints->pluck('office'),

            // Data terurut (default bisa pakai ini jika mau tampilkan sorted langsung)
            'sorted' => [
                'cleaning' => [
                    'labels' => $cleaningSorted->pluck('nama'),
                    'points' => $cleaningSorted->pluck('cleaning'),
                ],
                'checker' => [
                    'labels' => $checkerSorted->pluck('nama'),
                    'points' => $checkerSorted->pluck('checker'),
                ],
                'office' => [
                    'labels' => $officeSorted->pluck('nama'),
                    'points' => $officeSorted->pluck('office'),
                ],
            ]
        ];

        // --- Leaderboard (semua user) ---
        $leaderboard = User::leftJoin('daily_points', 'users.id', '=', 'daily_points.user_id')
            ->when($startDate && $endDate, fn($q) => $q->whereBetween('daily_points.date', [$startDate, $endDate]))
            ->select('users.id', 'users.nama', DB::raw('COALESCE(SUM(daily_points.point), 0) as total'))
            ->groupBy('users.id', 'users.nama')
            ->orderByDesc('total')
            ->get();

        $leaderboardData = [
            'labels' => $leaderboard->pluck('nama'),
            'points' => $leaderboard->pluck('total'),
        ];


        // --- Tren Harian ---
        $dailyStats = DailyPoint::select('date', 'activity_type as type', DB::raw('SUM(point) as total'))
            ->when($startDate && $endDate, fn($q) => $q->whereBetween('date', [$startDate, $endDate]))
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
            'dailyStats',
            'startDate',
            'endDate',
        ));
    }
}
