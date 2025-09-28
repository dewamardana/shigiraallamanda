<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use App\Models\ReportType;
use Illuminate\Http\Request;
use App\Models\DailyCleaningPoint;
use App\Traits\HandlesDailyPoints;

class ReportController extends Controller
{

    use HandlesDailyPoints;

    public function reportData(Request $request)
    {
        $title = __('dashboardReportData.controller.index.title');
        $users = User::all();
        $reportType = ReportType::all();
        $reports = Report::with(['user', 'media', 'members'])
            ->when($request->start_date, function ($query) use ($request) {
                $startDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
                $query->whereDate('date', '>=', $startDate);
            })
            ->when($request->end_date, function ($query) use ($request) {
                $endDate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
                $query->whereDate('date', '<=', $endDate);
            })
            ->when($request->user_id, function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->report_types_name, function ($query) use ($request) {
                $query->where('report_type', $request->report_types_name);
            })
            ->latest()
            ->get();


        return view('Dashboard.report.index', [
            'title' => $title,
            'reports' => $reports,
            'users' => $users,
            'type' => $reportType,
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
                        'Report',        // langsung string
                        $report->id,
                        [
                            'Reply Admin' => $request->point,
                            'Jenis'       => $report->report_type
                        ]   // hanya task + value
                    );
                }
            }
            // Jika tidak punya member, berikan poin ke pelapor
            else {
                $this->addDailyPoint(
                    $report->user_id,
                    $report->date,
                    $request->point,
                    'Report',        // langsung string
                    $report->id,
                    [
                        'Reply Admin' => $request->point,
                        'Jenis'       => $report->report_type
                    ]   // hanya task + value
                );
            }
        }

        return redirect()->route('reportData')->with('success', __('dashboardReportData.controller.reply.success_reply'));
    }
}
