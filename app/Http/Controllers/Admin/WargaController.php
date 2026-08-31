<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\UnitPosyandu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = Warga::with('unitPosyandu');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $wargas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.warga.index', compact('wargas', 'search', 'status'));
    }

    public function create()
    {
        $unitPosyandus = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.warga.create', compact('unitPosyandus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:warga,nik',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
            'no_hp' => 'nullable|string|max:15',
        ], [
            'nik.size' => 'NIK harus tepat 16 digit.',
            'nik.unique' => 'NIK ini sudah terdaftar dalam sistem.'
        ]);

        $plainPassword = Str::random(8);

        $warga = Warga::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'unit_posyandu_id' => $request->unit_posyandu_id,
            'status' => 'aktif', // Langsung aktif jika didaftarkan oleh admin
            'password' => Hash::make($plainPassword),
            'wajib_ganti_password' => true,
        ]);

        return redirect()->route('admin.warga.index')
            ->with('success', "Data warga {$warga->nama_lengkap} berhasil ditambahkan.")
            ->with('generated_password', $plainPassword);
    }

    public function show(string $id)
    {
        $warga = Warga::with('unitPosyandu')->findOrFail($id);
        return view('admin.warga.show', compact('warga'));
    }

    public function edit(string $id)
    {
        $warga = Warga::findOrFail($id);
        $unitPosyandus = UnitPosyandu::orderBy('nama', 'asc')->get();
        return view('admin.warga.edit', compact('warga', 'unitPosyandus'));
    }

    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:warga,nik,' . $warga->id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'unit_posyandu_id' => 'required|exists:unit_posyandu,id',
            'status' => 'required|in:pending,aktif,ditolak,nonaktif',
        ]);

        $warga->update($request->all());

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}