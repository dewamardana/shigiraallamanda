<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FoundItem;
use Illuminate\Http\Request;

class LostandFoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = __('dashboardLostFound.controller.index.title');
        $query = FoundItem::with('foundBy')->orderByDesc('date');

        // 🔹 Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        // 🔹 Filter user
        if ($request->filled('user_id')) {
            $query->where('found_by_id', $request->user_id);
        }

        $foundItems = $query->paginate(20);
        $users = User::select('id', 'nama')->get();

        return view('Dashboard.lostandfound.index', compact('title', 'foundItems', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FoundItem $lostitem)
    {
        $title = __('dashboardLostFound.controller.show.title');
        $mediaUrls = $lostitem->media_files;
        return view('Dashboard.lostandfound.show', compact('title', 'lostitem', 'mediaUrls'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoundItem $foundItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoundItem $lostitem)
    {
        // Validasi input
        $validated = $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $lostitem->update($validated);

        // Redirect dengan pesan sukses
        return redirect()
            ->route('lostitem.index')
            ->with('success', __('dashboardLostFound.controller.update.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoundItem $lostitem)
    {
        // Hapus file media jika ada
        if (!empty($lostitem->media_files)) {
            foreach ($lostitem->media_files as $file) {
                $path = storage_path('app/public/' . $file);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // Hapus data dari database
        $lostitem->delete();

        // Redirect dengan pesan sukses
        return redirect()
            ->back()
            ->with('success', __('dashboardLostFound.controller.delete.success_deleted'));
    }
}
