<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        
        $query = Warga::where('unit_posyandu_id', $kaderUnitId);

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        // Hitung umur secara dinamis via Accessor (sudah disiapkan di Model)
        $warga = $query->latest()->paginate(15);

        return view('kader.warga.index', compact('warga'));
    }

    public function store(Request $request)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;

        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:warga,nik',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
            'kategori' => 'required|in:Balita,Remaja,Lansia',
        ]);

        // Proteksi Lapis 2: Paksa unit ID milik Kader, abaikan input user
        $validated['unit_posyandu_id'] = $kaderUnitId;
        $validated['status'] = 'aktif'; 
        $validated['wajib_ganti_password'] = true;
        
        $rawPassword = Str::random(8);
        $validated['password'] = Hash::make($rawPassword);

        Warga::create($validated);

        // Flash password sementara agar Kader bisa memberikannya ke Warga
        return redirect()->route('kader.warga.index')
            ->with('success', 'Warga binaan berhasil didaftarkan.')
            ->with('kredensial_warga', [
                'nik' => $validated['nik'],
                'password' => $rawPassword
            ]);
    }

    public function update(Request $request, $id)
    {
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;
        
        // Proteksi: findOrFail berantai dengan kondisi unit
        $warga = Warga::where('unit_posyandu_id', $kaderUnitId)->findOrFail($id);

        $validated = $request->validate([
            'nik' => ['required', 'digits:16', Rule::unique('warga')->ignore($warga->id)],
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
            'kategori' => 'required|in:Balita,Remaja,Lansia',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $warga->update($validated);

        return redirect()->route('kader.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function show($id)
    {
        $warga = Warga::with(['pengukuran' => function($q) {
            $q->latest('tanggal_ukur')->take(12); // Ambil 12 riwayat terakhir untuk grafik
        }, 'unit'])
        ->where('unit_posyandu_id', auth('kader')->user()->unit_posyandu_id)
        ->findOrFail($id);

        return view('kader.warga.show', compact('warga'));
    }
}