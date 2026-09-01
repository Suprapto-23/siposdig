<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitPosyandu;
use Illuminate\Http\Request;

class UnitPosyanduController extends Controller
{
    public function index(Request $request)
    {
        // Hitung relasi sekalian untuk ditampilkan di tabel tanpa query berulang (N+1 safe)
        $units = UnitPosyandu::withCount(['kader', 'warga'])->latest()->paginate(10);
        return view('admin.unit-posyandu.index', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'desa_kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        UnitPosyandu::create($validated);
        return redirect()->route('admin.unit.index')->with('success', 'Unit Posyandu berhasil ditambahkan.');
    }

    public function update(Request $request, UnitPosyandu $unit)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'desa_kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        $unit->update($validated);
        return redirect()->route('admin.unit.index')->with('success', 'Unit Posyandu berhasil diperbarui.');
    }

    public function destroy(UnitPosyandu $unit)
    {
        // PROTEKSI: Cegah hapus jika ada kader/warga (Mencegah error fk constraint)
        if ($unit->kader()->exists() || $unit->warga()->exists()) {
            return back()->with('error', 'Gagal menghapus. Pindahkan terlebih dahulu Kader dan Warga dari Unit ini.');
        }

        $unit->delete();
        return back()->with('success', 'Unit Posyandu berhasil dihapus.');
    }
}