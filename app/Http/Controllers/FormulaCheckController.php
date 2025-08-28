<?php

namespace App\Http\Controllers;

use App\Models\FormulaCheck;
use Illuminate\Http\Request;

class FormulaCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __('dashboardFormulaCheck.controller.index.title');
        $formulas = FormulaCheck::all();
        return view('Dashboard.formulacheck.index', compact('formulas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __('dashboardFormulaCheck.controller.create.title');
        return view('Dashboard.formulacheck.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'jumlah_kamar' => 'required|numeric',
            'mengajar' => 'required|numeric',
            'pembersihan_khusus' => 'required|numeric',
            'mengangkat_barang' => 'required|numeric',
            'membersihkan_gudang' => 'required|numeric',
            'obat_pool' => 'required|numeric',
            'membersihkan_pool' => 'required|numeric',
            'sampah' => 'required|numeric',
        ], [
            'name.required' => __('dashboardFormulaCheck.controller.validation.name.required'),
            'name.string' => __('dashboardFormulaCheck.controller.validation.name.string'),
            'name.max' => __('dashboardFormulaCheck.controller.validation.name.max'),

            'description.required' => __('dashboardFormulaCheck.controller.validation.description.required'),
            'description.string' => __('dashboardFormulaCheck.controller.validation.description.string'),

            'jumlah_kamar.required' => __('dashboardFormulaCheck.controller.validation.jumlah_kamar.required'),
            'jumlah_kamar.numeric' => __('dashboardFormulaCheck.controller.validation.jumlah_kamar.numeric'),

            'mengajar.required' => __('dashboardFormulaCheck.controller.validation.mengajar.required'),
            'mengajar.numeric' => __('dashboardFormulaCheck.controller.validation.mengajar.numeric'),

            'pembersihan_khusus.required' => __('dashboardFormulaCheck.controller.validation.pembersihan_khusus.required'),
            'pembersihan_khusus.numeric' => __('dashboardFormulaCheck.controller.validation.pembersihan_khusus.numeric'),

            'mengangkat_barang.required' => __('dashboardFormulaCheck.controller.validation.mengangkat_barang.required'),
            'mengangkat_barang.numeric' => __('dashboardFormulaCheck.controller.validation.mengangkat_barang.numeric'),

            'membersihkan_gudang.required' => __('dashboardFormulaCheck.controller.validation.membersihkan_gudang.required'),
            'membersihkan_gudang.numeric' => __('dashboardFormulaCheck.controller.validation.membersihkan_gudang.numeric'),

            'obat_pool.required' => __('dashboardFormulaCheck.controller.validation.obat_pool.required'),
            'obat_pool.numeric' => __('dashboardFormulaCheck.controller.validation.obat_pool.numeric'),

            'membersihkan_pool.required' => __('dashboardFormulaCheck.controller.validation.membersihkan_pool.required'),
            'membersihkan_pool.numeric' => __('dashboardFormulaCheck.controller.validation.membersihkan_pool.numeric'),

            'sampah.required' => __('dashboardFormulaCheck.controller.validation.sampah.required'),
            'sampah.numeric' => __('dashboardFormulaCheck.controller.validation.sampah.numeric'),
        ]);

        // Tambahkan 'active' ke data yang akan disimpan
        $validated['active'] = $request->has('active');

        // Jika data ini di-set sebagai aktif, set semua lainnya jadi tidak aktif
        if ($validated['active']) {
            FormulaCheck::where('active', true)->update(['active' => false]);
        }

        FormulaCheck::create($validated);

        return redirect()->route('formulaCheck.index')->with('success', __('dashboardFormulaCheck.controller.create.success_create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(FormulaCheck $formulaCheck)
    {
        $title = __('dashboardFormulaCheck.controller.show.title');
        return view('Dashboard.formulacheck.show', compact('formulaCheck', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormulaCheck $formulaCheck)
    {
        $title = __('dashboardFormulaCheck.controller.edit.title');
        return view('Dashboard.formulacheck.edit', compact('formulaCheck', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormulaCheck $formulaCheck)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'jumlah_kamar' => 'required|numeric',
            'mengajar' => 'required|numeric',
            'pembersihan_khusus' => 'required|numeric',
            'mengangkat_barang' => 'required|numeric',
            'membersihkan_gudang' => 'required|numeric',
            'obat_pool' => 'required|numeric',
            'membersihkan_pool' => 'required|numeric',
            'sampah' => 'required|numeric',
        ], [
            'name.required' => __('dashboardFormulaCheck.controller.validation.name.required'),
            'name.string' => __('dashboardFormulaCheck.controller.validation.name.string'),
            'name.max' => __('dashboardFormulaCheck.controller.validation.name.max'),

            'description.required' => __('dashboardFormulaCheck.controller.validation.description.required'),
            'description.string' => __('dashboardFormulaCheck.controller.validation.description.string'),

            'jumlah_kamar.required' => __('dashboardFormulaCheck.controller.validation.jumlah_kamar.required'),
            'jumlah_kamar.numeric' => __('dashboardFormulaCheck.controller.validation.jumlah_kamar.numeric'),

            'mengajar.required' => __('dashboardFormulaCheck.controller.validation.mengajar.required'),
            'mengajar.numeric' => __('dashboardFormulaCheck.controller.validation.mengajar.numeric'),

            'pembersihan_khusus.required' => __('dashboardFormulaCheck.controller.validation.pembersihan_khusus.required'),
            'pembersihan_khusus.numeric' => __('dashboardFormulaCheck.controller.validation.pembersihan_khusus.numeric'),

            'mengangkat_barang.required' => __('dashboardFormulaCheck.controller.validation.mengangkat_barang.required'),
            'mengangkat_barang.numeric' => __('dashboardFormulaCheck.controller.validation.mengangkat_barang.numeric'),

            'membersihkan_gudang.required' => __('dashboardFormulaCheck.controller.validation.membersihkan_gudang.required'),
            'membersihkan_gudang.numeric' => __('dashboardFormulaCheck.controller.validation.membersihkan_gudang.numeric'),

            'obat_pool.required' => __('dashboardFormulaCheck.controller.validation.obat_pool.required'),
            'obat_pool.numeric' => __('dashboardFormulaCheck.controller.validation.obat_pool.numeric'),

            'membersihkan_pool.required' => __('dashboardFormulaCheck.controller.validation.membersihkan_pool.required'),
            'membersihkan_pool.numeric' => __('dashboardFormulaCheck.controller.validation.membersihkan_pool.numeric'),

            'sampah.required' => __('dashboardFormulaCheck.controller.validation.sampah.required'),
            'sampah.numeric' => __('dashboardFormulaCheck.controller.validation.sampah.numeric'),
        ]);

        // Atur status 'active' berdasarkan input checkbox
        $validated['active'] = $request->has('active');

        // Cegah jika satu-satunya formula yang aktif ingin dinonaktifkan
        if (!$validated['active'] && $formulaCheck->active) {
            $activeCount = FormulaCheck::where('active', true)->count();
            if ($activeCount === 1) {
                return redirect()->route('formulaCheck.index')->with('error', __('dashboardFormulaCheck.controller.edit.error_edit'));
            }
        }

        // Jika diaktifkan, nonaktifkan semua formula lainnya
        if ($validated['active']) {
            FormulaCheck::where('active', true)->where('id', '!=', $formulaCheck->id)->update(['active' => false]);
        }

        // Update data
        $formulaCheck->update($validated);

        return redirect()->route('formulaCheck.index')->with('success', __('dashboardFormulaCheck.controller.edit.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormulaCheck $formulaCheck)
    {
        if ($formulaCheck->active) {
            return redirect()->route('formulaCheck.index')->with('error', __('dashboardFormulaCheck.controller.delete.error_delete'));
        }

        $formulaCheck->delete();

        return redirect()->route('formulaCheck.index')->with('success', __('dashboardFormulaCheck.controller.delete.success_delete'));
    }
}
