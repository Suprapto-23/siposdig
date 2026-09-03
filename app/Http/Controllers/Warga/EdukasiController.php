<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\EdukasiKesehatan;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index(Request $request)
    {
        $query = EdukasiKesehatan::latest();

        // Fitur Pencarian Artikel
        if ($request->has('cari') && $request->cari != '') {
            $query->where('judul', 'like', '%' . $request->cari . '%')
                  ->orWhere('konten', 'like', '%' . $request->cari . '%');
        }

        // Tampilkan 9 artikel per halaman
        $edukasi = $query->paginate(9)->withQueryString();

        return view('warga.edukasi.index', compact('edukasi'));
    }

    public function show($id)
    {
        // Cari artikel berdasarkan ID
        $edukasi = EdukasiKesehatan::findOrFail($id);

        // Ambil 3 artikel terbaru lainnya untuk rekomendasi bacaan
        $artikelLain = EdukasiKesehatan::where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('warga.edukasi.show', compact('edukasi', 'artikelLain'));
    }
}