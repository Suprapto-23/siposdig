<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitPosyandu;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UnitPosyanduController extends Controller
{
    public function index(): View
    {
        $units = UnitPosyandu::withCount(['kader', 'warga'])->latest()->paginate(10);
        return view('admin.unit-posyandu.index', compact('units'));
    }

    public function create(): View
    {
        return view('admin.unit-posyandu.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode_posyandu' => 'nullable|string|max:50',
            'wilayah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'penanggung_jawab' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        UnitPosyandu::create($validated);

        return redirect()->route('admin.unit-posyandu.index')->with('success', 'Unit Posyandu berhasil ditambahkan.');
    }

    public function edit(UnitPosyandu $unitPosyandu): View
    {
        return view('admin.unit-posyandu.edit', ['unit' => $unitPosyandu]);
    }

    public function update(Request $request, UnitPosyandu $unitPosyandu): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode_posyandu' => 'nullable|string|max:50',
            'wilayah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'penanggung_jawab' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        $unitPosyandu->update($validated);

        return redirect()->route('admin.unit-posyandu.index')->with('success', 'Unit Posyandu berhasil diperbarui.');
    }

    public function destroy(UnitPosyandu $unitPosyandu): RedirectResponse
    {
        if ($unitPosyandu->kader()->exists() || $unitPosyandu->warga()->exists()) {
            return back()->with('error', 'Gagal menghapus. Pindahkan dulu Kader dan Warga dari unit ini.');
        }

        $unitPosyandu->delete();

        return back()->with('success', 'Unit Posyandu berhasil dihapus.');
    }
}