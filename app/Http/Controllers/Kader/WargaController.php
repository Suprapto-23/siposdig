<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class WargaController extends Controller
{
    // 1. HALAMAN INDEX: Menampilkan Daftar Warga
    public function index(Request $request)
    {
        $kader = auth('kader')->user();
        
        $query = Warga::where('unit_posyandu_id', $kader->unit_posyandu_id);

        // Filter Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Filter Kategori (Balita/Remaja/Lansia)
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter Status (aktif/pending/nonaktif)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $warga = $query->orderBy('nama_lengkap', 'asc')->paginate(12)->withQueryString();

        return view('kader.warga.index', compact('warga'));
    }

    // 2. HALAMAN CREATE: Form Tambah Warga
    public function create()
    {
        return view('kader.warga.create');
    }

    // 3. PROSES SIMPAN: Validasi Ekstra Ketat
    public function store(Request $request)
    {
        $kader = auth('kader')->user();

        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'nik'           => 'required|string|size:16|unique:warga,nik', // Wajib 16 digit & Unik
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'kategori'      => 'required|in:Balita,Remaja,Lansia',
            'alamat'        => 'required|string|max:500',
            'no_hp'         => 'nullable|string|max:20',
            'status'        => 'required|in:aktif,pending,nonaktif'
        ], [
            'nik.unique' => 'NIK ini sudah terdaftar di dalam sistem SIPOSDIG.',
            'nik.size'   => 'Format NIK tidak valid (Wajib 16 digit).',
        ]);

        $validated['unit_posyandu_id'] = $kader->unit_posyandu_id;
        
        // Setup Akun Login Warga (Opsional jika kedepannya Warga bisa login)
        $validated['password'] = Hash::make($validated['nik']); // Default password = NIK
        $validated['wajib_ganti_password'] = true;

        Warga::create($validated);

        return redirect()->route('kader.warga.index')
                         ->with('success', 'Data Warga Binaan berhasil ditambahkan.');
    }
public function show(Warga $warga)
    {
        // Menampilkan halaman detail spesifik untuk warga yang dipilih
        return view('kader.warga.show', compact('warga'));
    }
    // Fitur Edit & Delete bisa Anda kembangkan selanjutnya menggunakan prinsip yang sama
}