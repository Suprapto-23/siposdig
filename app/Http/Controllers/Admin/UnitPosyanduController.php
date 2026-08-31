<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitPosyandu;
use Illuminate\Http\Request;

class UnitPosyanduController extends Controller
{
    public function index() {
        $unitPosyandus = UnitPosyandu::latest()->paginate(10);
        return view('admin.unit-posyandu.index', compact('unitPosyandus'));
    }

    public function create() {
        return view('admin.unit-posyandu.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'rw' => 'required|string|max:10',
            'rt' => 'nullable|string|max:10',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        UnitPosyandu::create($validated);

        return redirect()->route('admin.unit-posyandu.index')->with('success', 'Unit Posyandu berhasil ditambahkan.');
    }

    public function show(UnitPosyandu $unitPosyandu) {
        return view('admin.unit-posyandu.show', compact('unitPosyandu'));
    }

    public function edit(UnitPosyandu $unitPosyandu) {
        return view('admin.unit-posyandu.edit', compact('unitPosyandu'));
    }

    public function update(Request $request, UnitPosyandu $unitPosyandu) {
        $validated = $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'rw' => 'required|string|max:10',
            'rt' => 'nullable|string|max:10',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $unitPosyandu->update($validated);

        return redirect()->route('admin.unit-posyandu.index')->with('success', 'Unit Posyandu berhasil diperbarui.');
    }

    public function destroy(UnitPosyandu $unitPosyandu) {
        $unitPosyandu->delete();
        return redirect()->route('admin.unit-posyandu.index')->with('success', 'Unit Posyandu berhasil dihapus.');
    }
}