<?php

namespace App\Http\Controllers;

use App\Models\CleaningTask;
use Illuminate\Http\Request;
use App\Models\CleaningGroup;

class CleaningTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = CleaningTask::latest()->paginate(10);
        return view('Dashboard.cleaning_tasks.index', [
            'title' => __('dashboardCleaningTask.controller.index.title'),
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.cleaning_tasks.create', [
            'title' => __('dashboardCleaningTask.controller.create.title'),
        ]);
    }
    // public function create(Request $request)
    // {
    //     $title = 'Create Cleaning Task';

    //     $cleaning_group = CleaningGroup::findOrFail($request->get('cleaning_group_id'));
    //     return view('Dashboard.cleaning_task.create', compact('cleaning_group', 'title'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255|unique:cleaning_tasks,name',
            'status' => 'required|in:active,inactive',
        ]);

        CleaningTask::create($validated);

        return redirect()->route('cleaningTasks.index')
            ->with('success', __('dashboardCleaningTask.alert.success'));
    }
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name'    => 'required|string|max:255',
    //         'formula' => 'required|numeric|min:0',
    //         'cleaning_group_id' => 'required',
    //     ]);

    //     $cleaning_group_id = $request->cleaning_group_id;
    //     $cleaning_group = CleaningGroup::findOrFail($cleaning_group_id);

    //     $validated['cleaning_group_id'] = $cleaning_group_id;


    //     CleaningTask::create($validated);

    //     return redirect()->route('cleaningGroup.show', $cleaning_group->slug)
    //         ->with('success', 'Cleaning Task created successfully');
    // }

    /**
     * Display the specified resource.
     */
    public function show(CleaningTask $cleaningTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CleaningTask $cleaningTask)
    {
        return view('Dashboard.cleaning_tasks.edit', [
            'title' => __('dashboardCleaningTask.controller.edit.title'),
            'task'  => $cleaningTask,
        ]);
    }
    // public function edit(CleaningTask $cleaningTask)
    // {
    //     $title = 'Edit Cleaning Task';
    //     return view('Dashboard.cleaning_task.edit', compact('cleaningTask', 'title'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CleaningTask $cleaningTask)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255|unique:cleaning_tasks,name,' . $cleaningTask->id,
            'status' => 'required|in:active,inactive',
        ]);

        $cleaningTask->update($validated);

        return redirect()->route('cleaningTasks.index')
            ->with('success', __('dashboardCleaningTask.controller.edit.success_edit'));
    }
    // public function update(Request $request, CleaningTask $cleaningTask)
    // {
    //     $validated = $request->validate([
    //         'name'    => 'required|string|max:255',
    //         'formula' => 'required|numeric|min:0',
    //     ]);


    //     $validated['cleaning_group_id'] = $cleaningTask->group->id;

    //     $cleaningTask->update($validated);

    //     return redirect()->route('cleaningGroup.show', $cleaningTask->group->slug)
    //         ->with('success', 'Cleaning Task updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CleaningTask $cleaningTask)
    {
        // cek apakah task sudah digunakan di group
        if ($cleaningTask->groups()->exists()) {
            // kalau sudah dipakai, jangan hapus, hanya nonaktifkan
            $cleaningTask->update(['status' => 'inactive']);
            return redirect()->route('cleaningTasks.index')
                ->with('warning', __('dashboardCleaningTask.controller.delete.deactivated_warning'));
        }

        // kalau belum dipakai, baru bisa dihapus
        $cleaningTask->delete();
        return redirect()->route('cleaningTasks.index')
            ->with('success', __('dashboardCleaningTask.controller.delete.deleted_success'));
    }
}
