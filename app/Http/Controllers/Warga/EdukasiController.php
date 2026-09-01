<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\EdukasiKesehatan;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index(Request $request)
    {
        $wargaKategori = auth('warga')->user()->kategori;

        $query = EdukasiKesehatan::with('pembuat:id,nama')
            ->where('status', 'publish')
            ->whereIn('target_kategori', [$wargaKategori, 'Semua']);

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $edukasi = $query->latest()->paginate(9); // Grid 3x3

        return view('warga.edukasi.index', compact('edukasi'));
    }

    public function show($slug)
    {
        $wargaKategori = auth('warga')->user()->kategori;

        $artikel = EdukasiKesehatan::with('pembuat:id,nama')
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->whereIn('target_kategori', [$wargaKategori, 'Semua'])
            ->firstOrFail();

        return view('warga.edukasi.show', compact('artikel'));
    }
}