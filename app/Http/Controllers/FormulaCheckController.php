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
        $title = 'Formula Check | Homepage';
        $formulas = FormulaCheck::all();
        return view('Dashboard.formulacheck.index', compact('formulas','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Formula Check Create | Homepage';
        return view('Dashboard.formulacheck.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
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
        ],[
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',

            'jumlah_kamar.required' => 'The number of rooms is required.',
            'jumlah_kamar.numeric' => 'The number of rooms must be a number.',

            'mengajar.required' => 'The teaching value is required.',
            'mengajar.numeric' => 'The teaching value must be a number.',

            'pembersihan_khusus.required' => 'The special cleaning value is required.',
            'pembersihan_khusus.numeric' => 'The special cleaning value must be a number.',

            'mengangkat_barang.required' => 'The lifting items value is required.',
            'mengangkat_barang.numeric' => 'The lifting items value must be a number.',

            'membersihkan_gudang.required' => 'The warehouse cleaning value is required.',
            'membersihkan_gudang.numeric' => 'The warehouse cleaning value must be a number.',

            'obat_pool.required' => 'The pool treatment value is required.',
            'obat_pool.numeric' => 'The pool treatment value must be a number.',

            'membersihkan_pool.required' => 'The pool cleaning value is required.',
            'membersihkan_pool.numeric' => 'The pool cleaning value must be a number.',

            'sampah.required' => 'The trash value is required.',
            'sampah.numeric' => 'The trash value must be a number.',
        ]);

        // Tambahkan 'active' ke data yang akan disimpan
        $validated['active'] = $request->has('active');

        // Jika data ini di-set sebagai aktif, set semua lainnya jadi tidak aktif
        if ($validated['active']) {
            FormulaCheck::where('active', true)->update(['active' => false]);
        }

        FormulaCheck::create($validated);

        return redirect()->route('formulaCheck.index')->with('success', 'Formula berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(FormulaCheck $formulaCheck)
    {
        $title = 'Detail Formula Check | Homepage';
        return view('Dashboard.formulacheck.show', compact('formulaCheck', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormulaCheck $formulaCheck)
    {
        $title = 'Formula Check Edit | Homepage';
        return view('Dashboard.formulacheck.edit', compact('formulaCheck','title'));
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
        ],[
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',

            'jumlah_kamar.required' => 'The number of rooms is required.',
            'jumlah_kamar.numeric' => 'The number of rooms must be a number.',

            'mengajar.required' => 'The teaching value is required.',
            'mengajar.numeric' => 'The teaching value must be a number.',

            'pembersihan_khusus.required' => 'The special cleaning value is required.',
            'pembersihan_khusus.numeric' => 'The special cleaning value must be a number.',

            'mengangkat_barang.required' => 'The lifting items value is required.',
            'mengangkat_barang.numeric' => 'The lifting items value must be a number.',

            'membersihkan_gudang.required' => 'The warehouse cleaning value is required.',
            'membersihkan_gudang.numeric' => 'The warehouse cleaning value must be a number.',

            'obat_pool.required' => 'The pool treatment value is required.',
            'obat_pool.numeric' => 'The pool treatment value must be a number.',

            'membersihkan_pool.required' => 'The pool cleaning value is required.',
            'membersihkan_pool.numeric' => 'The pool cleaning value must be a number.',

            'sampah.required' => 'The trash value is required.',
            'sampah.numeric' => 'The trash value must be a number.',
        ]);

        // Atur status 'active' berdasarkan input checkbox
        $validated['active'] = $request->has('active');
        
        // Cegah jika satu-satunya formula yang aktif ingin dinonaktifkan
        if (!$validated['active'] && $formulaCheck->active) {
            $activeCount = FormulaCheck::where('active', true)->count();
            if ($activeCount === 1) {
                return redirect()->route('formulaCheck.index')->with('error', 'Setidaknya satu formula harus tetap aktif.');
            }
        }

        // Jika diaktifkan, nonaktifkan semua formula lainnya
        if ($validated['active']) {
            FormulaCheck::where('active', true)->where('id', '!=', $formulaCheck->id)->update(['active' => false]);
        }

        // Update data
        $formulaCheck->update($validated);

        return redirect()->route('formulaCheck.index')->with('success', 'Formula berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormulaCheck $formulaCheck)
    {
        if ($formulaCheck->active) {
            return redirect()->route('formulaCheck.index')->with('error', 'Formula yang masih aktif tidak bisa dihapus.');
        }

        $formulaCheck->delete();

        return redirect()->route('formulaCheck.index')->with('success', 'Data formula berhasil dihapus.');
    }
}
