<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use App\Models\ReportType;
use Illuminate\Http\Request;
use App\Models\DailyCleaningPoint;
use App\Traits\HandlesDailyPoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    use HandlesDailyPoints;

    public function reportData(Request $request)
    {
        $title = __('dashboardReportData.controller.index.title');
        $users = User::all();
        $reportType = ReportType::all();
        $reports = Report::with(['user', 'media', 'group', 'room'])
            ->when($request->start_date, function ($query) use ($request) {
                $query->whereDate('date', '>=', Carbon::createFromFormat('d/m/Y', $request->start_date));
            })
            ->when($request->end_date, function ($query) use ($request) {
                $query->whereDate('date', '<=', Carbon::createFromFormat('d/m/Y', $request->end_date));
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

    public function show(Report $report)
    {
        $report->load(['user', 'media', 'members']);

        return view('Dashboard.report.show', [
            'title'  => 'Detail Report | Dashboard',
            'report' => $report,
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

        // 🔹 Tambahkan poin HANYA jika > 0 (Aktifkan jika suatu saat menggunakan poin lagi)
        // if (!empty($validated['point']) && $validated['point'] > 0) {

        //     $targets = $report->members()->exists()
        //         ? $report->members
        //         : collect([$report->user]);

        //     foreach ($targets as $target) {
        //         $this->addDailyPoint(
        //             $target->id,
        //             $report->date,
        //             $validated['point'],
        //             'Report',
        //             $report->id,
        //             [
        //                 'Reply Admin' => $validated['reply'],
        //                 'Jenis'       => $report->report_type,
        //             ]
        //         );
        //     }
        // }

        return redirect()
            ->route('reports.show', $report)
            ->with('success', __('dashboardReportData.controller.reply.success_reply'));
    }

    public function destroy(Report $report)
    {
        DB::transaction(function () use ($report) {

            // 1️⃣ Hapus media + file fisik
            foreach ($report->media as $media) {
                if (Storage::disk('public')->exists($media->path)) {
                    Storage::disk('public')->delete($media->path);
                }
                $media->delete();
            }

            // 2️⃣ Lepas relasi member (pivot)
            $report->members()->detach();

            // 3️⃣ dailyPoints otomatis terhapus dari booted()

            // 4️⃣ Hapus report utama
            $report->delete();
        });

        return redirect()
            ->route('reportData')
            ->with('success', __('dashboardReportData.controller.delete.success'));
    }
}
