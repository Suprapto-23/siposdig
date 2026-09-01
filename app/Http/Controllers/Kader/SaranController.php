<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\SaranKader;
use App\Models\Warga;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    public function store(Request $request)
    {
        $kaderId = auth('kader')->id();
        $kaderUnitId = auth('kader')->user()->unit_posyandu_id;

        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'pengukuran_fisik_id' => 'nullable|exists:pengukuran_fisik,id',
            'pesan_saran' => 'required|string|max:1000',
        ]);

        // Proteksi: Pastikan warga adalah warga di unit yang sama
        Warga::where('unit_posyandu_id', $kaderUnitId)->findOrFail($validated['warga_id']);

        $validated['kader_id'] = $kaderId;
        $validated['tanggal'] = now()->format('Y-m-d');

        SaranKader::create($validated);

        return back()->with('success', 'Catatan/Saran berhasil ditambahkan ke riwayat Warga.');
    }

    public function destroy($id)
    {
        $kaderId = auth('kader')->id();
        
        // Kader hanya bisa menghapus saran yang ditulis olehnya sendiri
        $saran = SaranKader::where('kader_id', $kaderId)->findOrFail($id);
        $saran->delete();

        return back()->with('success', 'Saran berhasil ditarik/dihapus.');
    }
}