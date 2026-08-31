<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EdukasiKesehatan;
use Illuminate\Http\Request;

class EdukasiKesehatanController extends Controller {
    
    public function index() {
        $edukasis = EdukasiKesehatan::latest()->paginate(10);
        return view('admin.edukasi.index', compact('edukasis'));
    }

    public function create() {
        return view('admin.edukasi.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:Gizi Balita,Ibu Hamil,Lansia,Penyakit Umum',
            'konten' => 'required|string',
            'penulis' => 'nullable|string|max:100',
        ]);

        EdukasiKesehatan::create($validated);

        return redirect()->route('admin.edukasi.index')->with('success', 'Artikel edukasi kesehatan berhasil dipublikasikan.');
    }

    public function show(EdukasiKesehatan $edukasi) {
        return view('admin.edukasi.show', compact('edukasi'));
    }

    public function edit(EdukasiKesehatan $edukasi) {
        return view('admin.edukasi.edit', compact('edukasi'));
    }

    public function update(Request $request, EdukasiKesehatan $edukasi) {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:Gizi Balita,Ibu Hamil,Lansia,Penyakit Umum',
            'konten' => 'required|string',
            'penulis' => 'nullable|string|max:100',
        ]);

        $edukasi->update($validated);

        return redirect()->route('admin.edukasi.index')->with('success', 'Artikel edukasi berhasil diperbarui.');
    }

    public function destroy(EdukasiKesehatan $edukasi) {
        $edukasi->delete();
        return redirect()->route('admin.edukasi.index')->with('success', 'Artikel edukasi berhasil dihapus.');
    }
}