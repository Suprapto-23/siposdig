<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\UnitPosyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::with('unitPosyandu')->where(function($q) {
            $q->where('status', '!=', 'pending')
              ->orWhereNull('status');
        });

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($request->has('unit_posyandu_id') && $request->unit_posyandu_id != '') {
            $query->where('unit_posyandu_id', $request->unit_posyandu_id);
        }

        $warga = $query->latest()->paginate(12)->withQueryString();
        $unitPosyandu = UnitPosyandu::orderBy('nama', 'asc')->get();

        return view('admin.warga.index', compact('warga', 'unitPosyandu'));
    }

    public function create()
    {
        $unitPosyandu = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.warga.create', compact('unitPosyandu'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nik'              => 'required|string|size:16|unique:warga,nik',
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
            'tanggal_lahir'    => 'required|date|before:today',
            'jenis_kelamin'    => 'required|in:L,P',
            'kategori'         => 'required|in:Balita,Remaja,Lansia',
            'alamat'           => 'required|string|max:500',
            'no_hp'            => 'nullable|string|max:20',
            'status'           => 'required|in:aktif,nonaktif'
        ], [
            'nik.unique' => 'Pendaftaran gagal: NIK ini sudah terdaftar.',
            'nik.size'   => 'Format NIK harus 16 digit.',
        ]);

        $passwordPlain = Str::random(8);
        $validated['password'] = Hash::make($passwordPlain);
        $validated['wajib_ganti_password'] = true;

        Warga::create($validated);

        return redirect()->route('admin.warga.index')->with([
            'modal_title' => 'Akun Warga Berhasil Dibuat',
            'modal_sub'   => 'Gunakan NIK untuk masuk sistem. Berikut kata sandi acak sementara:',
            'modal_user'  => $validated['nik'],
            'modal_pass'  => $passwordPlain
        ]);
    }

    public function show(Warga $warga)
    {
        $warga->load(['unitPosyandu', 'pengukuranFisik' => function($q) {
            $q->latest('tanggal_ukur')->limit(5);
        }]);
        
        return view('admin.warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        $unitPosyandu = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.warga.edit', compact('warga', 'unitPosyandu'));
    }

    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nik'              => ['required', 'string', 'size:16', Rule::unique('warga')->ignore($warga->id)],
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
            'tanggal_lahir'    => 'required|date|before:today',
            'jenis_kelamin'    => 'required|in:L,P',
            'kategori'         => 'required|in:Balita,Remaja,Lansia',
            'alamat'           => 'required|string|max:500',
            'no_hp'            => 'nullable|string|max:20',
            'status'           => 'required|in:aktif,nonaktif'
        ]);

        $warga->update($validated);

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil dihapus.');
    }

    public function resetPassword(Warga $warga)
    {
        $passwordBaru = Str::random(8);

        $warga->update([
            'password' => Hash::make($passwordBaru),
            'wajib_ganti_password' => true
        ]);

        return redirect()->back()->with([
            'modal_title' => "Reset Password: {$warga->nama_lengkap}",
            'modal_sub'   => 'Kata sandi baru berhasil digenerate oleh sistem:',
            'modal_user'  => $warga->nik,
            'modal_pass'  => $passwordBaru
        ]);
    }
}