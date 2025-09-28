<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\CleaningTask;
use Illuminate\Http\Request;
use App\Models\CleaningGroup;
use Illuminate\Support\Facades\Storage;

class CleaningGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = CleaningGroup::latest()->paginate(10);
        return view('Dashboard.cleaning_groups.index', [
            'title'  => 'Cleaning Group Master',
            'groups' => $groups,
        ]);
    }
    // public function index()
    // {
    //     $building = CleaningGroup::all();
    //     return view('Dashboard.building.index', [
    //         'title' => __('dashboardBuilding.controller.index.title'),
    //         'building' => $building,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.cleaning_groups.create', [
            'title' => 'Create Cleaning Group'
        ]);
    }
    // public function create()
    // {
    //     return view('Dashboard.building.create', [
    //         'title' => __('dashboardBuilding.controller.create.title'),
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'building_name' => 'required|string|max:255|unique:cleaning_groups,building_name',
            'description'   => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'        => 'required|in:active,inactive',
        ]);

        $validated['slug'] = $this->generateSlug($validated['building_name']);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('building-images', 'public');
        }

        CleaningGroup::create($validated);

        return redirect()->route('cleaningGroups.index')
            ->with('success', 'Cleaning Group created successfully');
    }
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate(
    //         [
    //             'building_name' => 'required|unique:cleaning_groups,building_name',
    //             'description'   => 'required|string',
    //             'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         ],
    //         [
    //             'building_name.required' => __('dashboardBuilding.controller.validation.building_name_required'),
    //             'slug.required'          => __('dashboardBuilding.controller.validation.slug_required'),
    //             'slug.unique'            => __('dashboardBuilding.controller.validation.slug_unique'),
    //             'description.required'   => __('dashboardBuilding.controller.validation.description_required'),
    //             'foto.image'             => __('dashboardBuilding.controller.validation.photo_image'),
    //             'foto.mimes'             => __('dashboardBuilding.controller.validation.photo_mimes'),
    //             'foto.max'               => __('dashboardBuilding.controller.validation.photo_max')
    //         ]
    //     );
    //     $validatedData['slug'] = $this->generateSlug($request->building_name);

    //     if ($request->hasFile('foto')) {
    //         $fotoPath = $request->file('foto')->store('building-images', 'public');
    //         $validatedData['foto'] = $fotoPath;
    //     }

    //     CleaningGroup::create($validatedData);

    //     return redirect()->route('cleaningGroup.index')->with('success', __('dashboardBuilding.controller.create.success_add'));
    // }

    /**
     * Display the specified resource.
     */
    public function show(CleaningGroup $cleaningGroup)
    {
        $title = "Cleaning Group Detail";
        $cleaningGroup->load('tasks'); // eager load tasks

        return view('Dashboard.cleaning_groups.show', compact('title', 'cleaningGroup'));
    }



    /**
     * Show the form for editing the specified resource.
     */

    public function edit(CleaningGroup $cleaningGroup)
    {
        $tasks = CleaningTask::where('status', 'active')->get();

        return view('Dashboard.cleaning_groups.edit', [
            'title' => 'Edit Cleaning Group',
            'group' => $cleaningGroup,
            'tasks' => $tasks,
        ]);
    }
    // public function edit(CleaningGroup $cleaningGroup)
    // {
    //     return view('Dashboard.building.edit', [
    //         'building' => $cleaningGroup,
    //         'title' => __('dashboardBuilding.controller.edit.title')
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CleaningGroup $cleaningGroup)
    {
        $validated = $request->validate([
            'building_name' => 'required|string|max:255|unique:cleaning_groups,building_name,' . $cleaningGroup->id,
            'description'   => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'        => 'required|in:active,inactive',
            'tasks'         => 'array', // id task
            'tasks.*'       => 'exists:cleaning_tasks,id',
            'formulas'      => 'array',
        ]);

        $validated['slug'] = $this->generateSlug($validated['building_name']);

        if ($request->hasFile('foto')) {
            if ($cleaningGroup->foto) {
                Storage::disk('public')->delete($cleaningGroup->foto);
            }
            $validated['foto'] = $request->file('foto')->store('building-images', 'public');
        }

        $cleaningGroup->update($validated);

        // sinkronisasi pivot
        $syncData = [];
        if ($request->has('tasks')) {
            foreach ($request->tasks as $taskId) {
                $formula = $request->formulas[$taskId] ?? 0;
                $syncData[$taskId] = ['formula' => $formula];
            }
        }
        $cleaningGroup->tasks()->sync($syncData);

        return redirect()->route('cleaningGroups.index')
            ->with('success', 'Cleaning Group updated successfully');
    }
    // public function update(Request $request, CleaningGroup $cleaningGroup)
    // {
    //     $validatedData = $request->validate([
    //         'building_name' => 'required|unique:cleaning_groups,building_name,' . $cleaningGroup->id,
    //         'description'   => 'required|string',
    //         'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ], [
    //         'building_name.required' => __('dashboardBuilding.controller.validation.building_name_required'),
    //         'description.required'   => __('dashboardBuilding.controller.validation.description_required'),
    //         'foto.image'             => __('dashboardBuilding.controller.validation.photo_image'),
    //         'foto.mimes'             => __('dashboardBuilding.controller.validation.photo_mimes'),
    //         'foto.max'               => __('dashboardBuilding.controller.validation.photo_max')
    //     ]);

    //     // handle foto baru
    //     if ($request->hasFile('foto')) {
    //         // hapus foto lama jika ada
    //         if ($cleaningGroup->foto && Storage::exists('public/' . $cleaningGroup->foto)) {
    //             Storage::delete('public/' . $cleaningGroup->foto);
    //         }

    //         // simpan foto baru
    //         $fotoPath = $request->file('foto')->store('building-images', 'public');
    //         $validatedData['foto'] = $fotoPath;
    //     }

    //     $cleaningGroup->update($validatedData);

    //     return redirect()->route('cleaningGroup.index')->with('success', __('dashboardBuilding.controller.edit.success_update'));
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CleaningGroup $cleaningGroup)
    {
        // cek apakah group sudah dipakai di cleaning_records
        if ($cleaningGroup->cleanings()->exists()) {
            $cleaningGroup->update(['status' => 'inactive']);
            return redirect()->route('cleaningGroups.index')
                ->with('warning', 'Group sudah digunakan, status diubah menjadi inactive.');
        }

        if ($cleaningGroup->foto) {
            Storage::disk('public')->delete($cleaningGroup->foto);
        }

        $cleaningGroup->delete();
        return redirect()->route('cleaningGroups.index')
            ->with('success', 'Cleaning Group deleted successfully');
    }

    // public function destroy(CleaningGroup $cleaningGroup)
    // {
    //     // Hapus foto jika ada
    //     if ($cleaningGroup->foto && Storage::exists('public/' . $cleaningGroup->foto)) {
    //         Storage::delete('public/' . $cleaningGroup->foto);
    //     }

    //     $cleaningGroup->delete();

    //     return redirect()->route('cleaningGroup.index')->with('success', __('dashboardBuilding.controller.delete.success_delete'));
    // }

    private function generateSlug(string $text, string $separator = '-'): string
    {
        $text = trim($text);

        // 1. Transliterate (ubah non-latin ke latin, kalau extension intl aktif)
        if (function_exists('transliterator_transliterate')) {
            $text = transliterator_transliterate('Any-Latin; Latin-ASCII;', $text);
        }

        // 2. Slug standar untuk huruf latin
        $slug = Str::slug($text, $separator);

        // 3. Kalau slug kosong, pakai aksara asli tapi tetap aman
        if (empty($slug)) {
            $slug = preg_replace('/\s+/u', $separator, $text);
            $slug = preg_replace('/[^A-Za-z0-9\p{L}\-]+/u', '', $slug);
        }

        // 4. Fallback kalau tetap kosong
        if (empty($slug)) {
            $slug = Str::random(8);
        }

        return mb_strtolower($slug, 'UTF-8');
    }
}
