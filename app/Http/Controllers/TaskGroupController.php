<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use Illuminate\Http\Request;

class TaskGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Task Active | Dashboard';
        $taskGroups = TaskGroup::all();
        return view('dashboard.taskgroup.index', compact('taskGroups', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Task Group Create';
        return view('dashboard.taskgroup.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        if ($request->active) {
            TaskGroup::where('active', true)->update(['active' => false]);
        }

        TaskGroup::create([
            'name' => $request->name,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('task-groups.index')->with('success', 'Task group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskGroup $taskGroup)
    {
        $title = 'Task Active | Dashboard';
        $tasks = $taskGroup->tasks; // Pastikan relasi tasks sudah dibuat di model
        return view('dashboard.taskgroup.show', compact('taskGroup', 'tasks', 'title'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskGroup $taskGroup)
    {
        $title = 'Task Edit | Dashboard';
        return view('dashboard.taskgroup.edit', compact('taskGroup', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskGroup $taskGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cek jika sedang menonaktifkan dan ini task aktif terakhir
        if (!$request->has('active') && $taskGroup->active) {
            $otherActiveCount = TaskGroup::where('active', true)
                ->where('id', '!=', $taskGroup->id)
                ->count();

            if ($otherActiveCount === 0) {
                return redirect()
                    ->back()
                    ->withErrors(['active' => 'Tidak bisa menonaktifkan semua task. Harus ada minimal satu task aktif.'])
                    ->withInput();
            }
        }

        // Kalau user mengaktifkan task ini, nonaktifkan yang lain
        if ($request->has('active')) {
            TaskGroup::where('active', true)
                ->where('id', '!=', $taskGroup->id)
                ->update(['active' => false]);
        }

        // Update data
        $taskGroup->update([
            'name' => $request->name,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('task-groups.index')->with('success', 'Task group updated successfully.');

        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskGroup $taskGroup)
    {
        if ($taskGroup->active) {
            return redirect()->route('task-groups.index')->with('error', 'Task Grup yang masih aktif tidak bisa dihapus.');
        }

        $taskGroup->delete();

        return redirect()->route('task-groups.index')->with('success', 'Data Task Grup berhasil dihapus.');
    }
}
