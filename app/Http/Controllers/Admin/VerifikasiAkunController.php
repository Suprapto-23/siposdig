<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VerifikasiAkunController extends Controller
{
    public function index(Request $request)
    {
        $antrean = Warga::with('unit')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);
            
        return view('admin.verifikasi.index', compact('antrean'));
    }

    public function setujui(Request $request, Warga $warga)
    {
        if ($warga->status !== 'pending') {
            return back()->with('error', 'Status warga sudah diproses sebelumnya.');
        }

        $rawPassword = Str::random(8); // Sesuai PRD
        
        DB::transaction(function () use ($warga, $rawPassword) {
            $warga->update([
                'status' => 'aktif',
                'password' => Hash::make($rawPassword),
                'wajib_ganti_password' => true,
                'catatan_admin' => null // bersihkan catatan jika pernah ditolak sebelumnya
            ]);
            
            // Rekam aktivitas
            activity()->performedOn($warga)->causedBy(auth('admin')->user())->log('menyetujui pendaftaran warga');
        });

        // Lempar ke UI untuk dicetak "Kartu Akun" / di-copy Admin
        return back()
            ->with('success', 'Pendaftaran warga disetujui.')
            ->with('kredensial_warga', [
                'nik' => $warga->nik,
                'password' => $rawPassword,
                'nama' => $warga->nama
            ]);
    }

    public function tolak(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'catatan_admin' => 'required|string|max:500'
        ]);

        $warga->update([
            'status' => 'ditolak',
            'catatan_admin' => $validated['catatan_admin']
        ]);

        activity()->performedOn($warga)->causedBy(auth('admin')->user())->log('menolak pendaftaran warga');

        return back()->with('success', 'Pendaftaran warga telah ditolak.');
    }
}