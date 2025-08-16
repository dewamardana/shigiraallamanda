<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $building = Building::all();
        return view('dashboard.building.index',[
            'title' => __('buildingControllerMessage.title_index'),
            'building' => $building
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.building.create',[
            'title' => __('buildingControllerMessage.title_create'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'building_name' => 'required|string|max:255',
            'description'   => 'required|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'building_name.required' => __('buildingControllerMessage.validation.building_name_required'),
            'slug.required'          => __('buildingControllerMessage.validation.slug_required'),
            'slug.unique'            => __('buildingControllerMessage.validation.slug_unique'),
            'description.required'   => __('buildingControllerMessage.validation.description_required'),
            'foto.image'             => __('buildingControllerMessage.validation.photo_image'),
            'foto.mimes'             => __('buildingControllerMessage.validation.photo_mimes'),
            'foto.max'               => __('buildingControllerMessage.validation.photo_max')
        ]);
        $validatedData['slug'] = Str::slug($request->building_name, '-');
    
        // handle upload foto (jika ada)
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('building-images', 'public');
            $validatedData['foto'] = $fotoPath;
        }
    
        Building::create($validatedData);
    
        return redirect()->route('building.index')->with('success', __('buildingControllerMessage.success_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        return view('dashboard.building.show',[
            'building' => $building,
            'title' => __('buildingControllerMessage.title_show')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building)
    {
        return view('dashboard.building.edit',[
            'building' => $building,
            'title' => __('buildingControllerMessage.title_edit')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Building $building)
    {
        $building = Building::where('slug', $building->slug)->firstOrFail();

        $validatedData = $request->validate([
            'building_name' => 'required|string|max:255',
            'description'   => 'required|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'building_name.required' => __('buildingControllerMessage.validation.building_name_required'),
            'description.required'   => __('buildingControllerMessage.validation.description_required'),
            'foto.image'             => __('buildingControllerMessage.validation.photo_image'),
            'foto.mimes'             => __('buildingControllerMessage.validation.photo_mimes'),
            'foto.max'               => __('buildingControllerMessage.validation.photo_max')
        ]);

        // handle foto baru
        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($building->foto && Storage::exists('public/' . $building->foto)) {
                Storage::delete('public/' . $building->foto);
            }

            // simpan foto baru
            $fotoPath = $request->file('foto')->store('building-images', 'public');
            $validatedData['foto'] = $fotoPath;
        }

        $building->update($validatedData);

        return redirect()->route('building.index')->with('success', __('buildingControllerMessage.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        // Hapus foto jika ada
        if ($building->foto && Storage::exists('public/'.$building->foto)) {
            Storage::delete('public/'.$building->foto);
        }

        $building->delete();

        return redirect()->route('building.index')->with('success', __('buildingControllerMessage.success_delete'));
    }
}
