<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskGroup;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $taskGroupId = $request->get('task_group_id');
        $taskGroup = TaskGroup::findOrFail($taskGroupId);
        $title = "Tambah Task | Dashboard";
        return view('dashboard.task.create', compact('taskGroup', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_group_id' => 'required|exists:task_groups,id',
            'name' => 'required|string|max:255',
            'point' => 'required|integer|min:0',
        ]);

        Task::create($validated);

        return redirect()->route('task-groups.show', $validated['task_group_id'])
            ->with('success', 'Task berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $title = "Edit Task | Dashboard";
        return view('dashboard.task.edit', compact('task', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'point' => 'required|integer|min:0',
        ]);

        $task->update($validated);

        return redirect()->route('task-groups.show', $task->task_group_id)->with('success', 'Task berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $groupId = $task->task_group_id;
        $task->delete();

        return redirect()->route('task-groups.show', $groupId)
            ->with('success', 'Task berhasil dihapus.');
    }
}
