<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EdukasiKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EdukasiKesehatanController extends Controller
{
    public function index()
    {
        $edukasi = EdukasiKesehatan::with('pembuat')->latest()->paginate(10);
        return view('admin.edukasi.index', compact('edukasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'target_kategori' => 'required|in:Balita,Remaja,Lansia,Semua',
            'status' => 'required|in:draft,publish',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // Batas 2MB
        ]);

        $validated['slug'] = Str::slug($validated['judul']) . '-' . uniqid();
        $validated['admin_id'] = auth('admin')->id();
        
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('edukasi', 'public');
        }

        EdukasiKesehatan::create($validated);
        return redirect()->route('admin.edukasi.index')->with('success', 'Materi edukasi berhasil diterbitkan.');
    }

    public function update(Request $request, EdukasiKesehatan $edukasi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'target_kategori' => 'required|in:Balita,Remaja,Lansia,Semua',
            'status' => 'required|in:draft,publish',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama agar storage tidak bengkak
            if ($edukasi->gambar) {
                Storage::disk('public')->delete($edukasi->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('edukasi', 'public');
        }

        // Update slug hanya jika judul berubah
        if ($request->judul !== $edukasi->judul) {
            $validated['slug'] = Str::slug($validated['judul']) . '-' . uniqid();
        }

        $edukasi->update($validated);
        return redirect()->route('admin.edukasi.index')->with('success', 'Materi edukasi diperbarui.');
    }

    public function destroy(EdukasiKesehatan $edukasi)
    {
        if ($edukasi->gambar) {
            Storage::disk('public')->delete($edukasi->gambar);
        }
        $edukasi->delete();
        return back()->with('success', 'Materi edukasi berhasil dihapus.');
    }
}