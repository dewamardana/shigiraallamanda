<?php

namespace App\Http\Controllers;

use App\Models\CheckerTask;
use Illuminate\Http\Request;

class CheckerTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = CheckerTask::orderBy('id', 'desc')->get();
        $title = __('dashboardCheckerTask.controller.index.title');

        return view('Dashboard.checker-tasks.index', compact('tasks', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __('dashboardCheckerTask.controller.create.title');
        return view('Dashboard.checker-tasks.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255|unique:checker_tasks,name',
            'type'    => 'required|in:boolean,number',
            'formula' => 'required|numeric|min:0',
        ]);

        CheckerTask::create($validated);

        return redirect()
            ->route('checker-tasks.index')
            ->with('success', __('dashboardCheckerTask.controller.create.success_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CheckerTask $checkerTask)
    {
        $title = __('dashboardCheckerTask.controller.edit.title');
        return view('Dashboard.checker-tasks.edit', compact('checkerTask', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckerTask $checkerTask)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255|unique:checker_tasks,name,' . $checkerTask->id,
            'type'    => 'required|in:boolean,number',
            'formula' => 'required|numeric|min:0',
        ]);

        $validated['active'] = $request->has('active') ? 1 : 0;

        $checkerTask->update($validated);

        return redirect()
            ->route('checker-tasks.index')
            ->with('success', __('dashboardCheckerTask.controller.edit.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckerTask $checkerTask)
    {
        // kalau sudah ada relasi dengan record detail, jangan dihapus
        if ($checkerTask->details()->exists()) {
            $checkerTask->update(['active' => false]);

            return redirect()
                ->route('checker-tasks.index')
                ->with('success', __('dashboardCheckerTask.controller.delete.disabled'));
        }

        // kalau belum ada data, baru boleh dihapus permanen
        $checkerTask->delete();

        return redirect()
            ->route('checker-tasks.index')
            ->with('success', __('dashboardCheckerTask.controller.delete.success_delete'));
    }
}
