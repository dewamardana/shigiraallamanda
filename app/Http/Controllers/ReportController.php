<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\DailyCleaningPoint;

class ReportController extends Controller
{
    public function reportData()
    {
        $title = __('dashboardReportData.controller.index.title');
        $reports = Report::with(['user', 'media', 'members'])
            ->latest()
            ->get();


        return view('Dashboard.report.index', [
            'title' => $title,
            'reports' => $reports,
        ]);
    }

    public function reply(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:reports,id',
            'reply'     => 'required|string',
            'point'     => 'nullable|integer|min:0'
        ]);

        $report = Report::findOrFail($request->report_id);
        $report->reply = $request->reply;
        $report->point = $request->point;
        $report->save();

        // Tambahkan poin ke daily_cleaning_points jika ada nilai
        if (!is_null($request->point) && $request->point >= 0) {

            // Jika laporan punya member, berikan poin ke semua member
            if ($report->members()->exists()) {
                foreach ($report->members as $member) {
                    $this->addDailyPoint(
                        $member->id,
                        $report->date,
                        $request->point,
                        'Laporan',
                        [
                            'Reply Admin' => $request->point,
                            'Jenis'       => $report->report_type
                        ]
                    );
                }
            }
            // Jika tidak punya member, berikan poin ke pelapor
            else {
                $this->addDailyPoint(
                    $report->user_id,
                    $report->date,
                    $request->point,
                    'Laporan',
                    [
                        'Reply Admin' => $request->point,
                        'Jenis'       => $report->report_type
                    ]
                );
            }
        }

        return redirect()->route('reportData')->with('success', __('dashboardReportData.controller.reply.success_reply'));
    }


    private function addDailyPoint($userId, $date, $point, $activityType, array $detailArray = [])
    {
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
