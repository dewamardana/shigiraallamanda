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
        $title = __('dashboardTaskGroup.controller.index.title');
        $taskGroups = TaskGroup::all();
        return view('Dashboard.taskgroup.index', compact('taskGroups', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __('dashboardTaskGroup.controller.create.title');
        return view('Dashboard.taskgroup.create', compact('title'));
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

        return redirect()->route('task-groups.index')->with('success', __('dashboardTaskGroup.controller.create.success_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskGroup $taskGroup)
    {
        $title = __('dashboardTaskGroup.controller.show.title');
        $tasks = $taskGroup->tasks; // Pastikan relasi tasks sudah dibuat di model
        return view('Dashboard.taskgroup.show', compact('taskGroup', 'tasks', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskGroup $taskGroup)
    {
        $title = __('dashboardTaskGroup.controller.edit.title');
        return view('Dashboard.taskgroup.edit', compact('taskGroup', 'title'));
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
                    ->withErrors(['active' => __('dashboardTaskGroup.controller.edit.error_edit')])
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

        return redirect()->route('task-groups.index')->with('success', __('dashboardTaskGroup.controller.edit.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskGroup $taskGroup)
    {
        if ($taskGroup->active) {
            return redirect()->route('task-groups.index')->with('error', __('dashboardTaskGroup.controller.delete.error_delete'));
        }

        $taskGroup->delete();

        return redirect()->route('task-groups.index')->with('success', __('dashboardTaskGroup.controller.delete.success_delete'));
    }
}
