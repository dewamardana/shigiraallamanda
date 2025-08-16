<?php

namespace App\Http\Controllers;

use App\Models\Formula;
use App\Models\Building;
use Illuminate\Http\Request;

class FormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __('formulaControllerMessage.title_index');
        $formulas = Formula::all();
        return view('dashboard.formula.index', compact('formulas','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $building = Building::all();
        $title = __('formulaControllerMessage.title_create');
        return view('dashboard.formula.create', compact('building', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'building_slug' => 'required|string',
            'member_count'  => 'required|string',
            'oa'            => 'required|numeric',
            'ov'            => 'required|numeric',
            'stay'          => 'required|numeric',
            'vec'           => 'required|numeric',
            'premier'       => 'nullable|numeric'
        ],[
            'building_slug.required' => __('formulaControllerMessage.validation.building_slug_required'),
            'member_count.required'  => __('formulaControllerMessage.validation.member_count_required'),
            'oa.required'            => __('formulaControllerMessage.validation.oa_required'),
            'ov.required'            => __('formulaControllerMessage.validation.ov_required'),
            'stay.required'          => __('formulaControllerMessage.validation.stay_required'),
            'vec.required'           => __('formulaControllerMessage.validation.vec_required'),
            'premier.numeric'        => __('formulaControllerMessage.validation.premier_numeric'),
        ]);

        Formula::create($validated);

        return redirect()->route('formula.index')->with('success', __('formulaControllerMessage.success_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Formula $formula)
    {
        $title = __('formulaControllerMessage.title_show');
        return view('dashboard.formula.show', compact('formula','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formula $formula)
    {
        $title = __('formulaControllerMessage.title_edit');
        return view('dashboard.formula.edit', compact('formula','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formula $formula)
    {
        $validated = $request->validate([
            'building_slug' => 'required|string',
            'member_count'  => 'required|string',
            'oa'            => 'required|numeric',
            'ov'            => 'required|numeric',
            'stay'          => 'required|numeric',
            'vec'           => 'required|numeric',
            'premier'       => 'nullable|numeric'
        ],[
            'building_slug.required' => __('formulaControllerMessage.validation.building_slug_required'),
            'member_count.required'  => __('formulaControllerMessage.validation.member_count_required'),
            'oa.required'            => __('formulaControllerMessage.validation.oa_required'),
            'ov.required'            => __('formulaControllerMessage.validation.ov_required'),
            'stay.required'          => __('formulaControllerMessage.validation.stay_required'),
            'vec.required'           => __('formulaControllerMessage.validation.vec_required'),
            'premier.numeric'        => __('formulaControllerMessage.validation.premier_numeric'),
        ]);

        $formula->update($validated);

        return redirect()->route('formula.index')->with('success', __('formulaControllerMessage.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formula $formula)
    {
        $formula->delete();
        return back()->with('success', __('formulaControllerMessage.success_delete'));
    }
}
