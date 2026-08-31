@extends('layouts.app-admin')

@section('title', 'Edit Data Kader - SIPOSDIG')

@section('content')
<div class="w-full max-w-4xl mx-auto space-y-6">

    <!-- Tombol Kembali -->
    <a href="{{ route('admin.kader.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Data Kader
    </a>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="p-6 md:p-8 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">Edit Data Kader</h1>
                <p class="text-sm text-slate-500 mt-1">Ubah informasi profil atau penempatan unit kader.</p>
            </div>
            <!-- Badge Status -->
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold {{ $kader->status == 'aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                Status Saat Ini: {{ ucfirst($kader->status) }}
            </span>
        </div>

        <form action="{{ route('admin.kader.update', $kader->id) }}" method="POST" class="p-6 md:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $kader->nama_lengkap) }}" required class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-slate-700">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $kader->email) }}" required class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-slate-700">
                </div>

                <!-- Unit Posyandu -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Penempatan Unit <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="unit_posyandu_id" required class="w-full py-3 pl-4 pr-10 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-slate-700 appearance-none cursor-pointer">
                            <option value="">-- Pilih Unit Posyandu --</option>
                            @foreach($unitPosyandus ?? [] as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_posyandu_id', $kader->unit_posyandu_id) == $unit->id ? 'selected' : '' }}>{{ $unit->nama }}</option>
                            @endforeach
                        </select>
                        <svg class="w-5 h-5 absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-span-1 md:col-span-2 mt-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Status Akun</label>
                    <div class="relative">
                        <select name="status" class="w-full py-3 pl-4 pr-10 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-slate-700 appearance-none cursor-pointer">
                            <option value="aktif" {{ old('status', $kader->status) == 'aktif' ? 'selected' : '' }}>Aktif (Bisa Login)</option>
                            <option value="nonaktif" {{ old('status', $kader->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif (Akses Dibekukan)</option>
                        </select>
                        <svg class="w-5 h-5 absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Mengubah status menjadi Nonaktif akan memblokir kader ini dari sistem tanpa menghapus datanya.</p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.kader.index') }}" class="py-2.5 px-6 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</a>
                <button type="submit" class="py-2.5 px-6 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm shadow-blue-600/20 transition-all">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection