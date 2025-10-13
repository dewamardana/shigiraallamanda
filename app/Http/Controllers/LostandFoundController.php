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
        $title = "Lost Item Data | Dashboard";
        $query = FoundItem::with('foundBy')->where('status', 0)->orderByDesc('date');

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
        $title = "Detail Item | Dashboard";
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
            ->with('success', 'Status barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoundItem $foundItem)
    {
        //
    }


    public function founditem(Request $request)
    {
        $title = "Return Item Data | Dashboard";
        $query = FoundItem::with('foundBy')->where('status', 1)->orderByDesc('date');

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

        return view('Dashboard.lostandfound.found', compact('title', 'foundItems', 'users'));
    }
}
