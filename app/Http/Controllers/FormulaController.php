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
        $title = __('dashboardFormulaBuilding.controller.index.title');
        $formulas = Formula::all();
        return view('Dashboard.formula.index', compact('formulas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $building = Building::all();
        $title = __('dashboardFormulaBuilding.controller.create.title');
        return view('Dashboard.formula.create', compact('building', 'title'));
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
        ], [
            'building_slug.required' => __('dashboardFormulaBuilding.controller.validation.building_slug_required'),
            'member_count.required'  => __('dashboardFormulaBuilding.controller.validation.member_count_required'),
            'oa.required'            => __('dashboardFormulaBuilding.controller.validation.oa_required'),
            'ov.required'            => __('dashboardFormulaBuilding.controller.validation.ov_required'),
            'stay.required'          => __('dashboardFormulaBuilding.controller.validation.stay_required'),
            'vec.required'           => __('dashboardFormulaBuilding.controller.validation.vec_required'),
            'premier.numeric'        => __('dashboardFormulaBuilding.controller.validation.premier_numeric'),
        ]);

        Formula::create($validated);

        return redirect()->route('formula.index')->with('success', __('dashboardFormulaBuilding.controller.create.success_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Formula $formula)
    {
        $title = __('dashboardFormulaBuilding.controller.show.title');
        return view('Dashboard.formula.show', compact('formula', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formula $formula)
    {
        $title = __('dashboardFormulaBuilding.controller.edit.title');
        return view('Dashboard.formula.edit', compact('formula', 'title'));
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
        ], [
            'building_slug.required' => __('dashboardFormulaBuilding.controller.validation.building_slug_required'),
            'member_count.required'  => __('dashboardFormulaBuilding.controller.validation.member_count_required'),
            'oa.required'            => __('dashboardFormulaBuilding.controller.validation.oa_required'),
            'ov.required'            => __('dashboardFormulaBuilding.controller.validation.ov_required'),
            'stay.required'          => __('dashboardFormulaBuilding.controller.validation.stay_required'),
            'vec.required'           => __('dashboardFormulaBuilding.controller.validation.vec_required'),
            'premier.numeric'        => __('dashboardFormulaBuilding.controller.validation.premier_numeric'),
        ]);

        $formula->update($validated);

        return redirect()->route('formula.index')->with('success', __('dashboardFormulaBuilding.controller.edit.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formula $formula)
    {
        $formula->delete();
        return back()->with('success', __('dashboardFormulaBuilding.controller.delete.success_delete'));
    }
}
