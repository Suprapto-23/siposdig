@extends('layouts.app-admin')

@section('title', 'Tambah Kader Baru - SIPOSDIG')

@section('content')
<div class="w-full max-w-4xl mx-auto space-y-6">

    <!-- Tombol Kembali -->
    <a href="{{ route('admin.kader.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Data Kader
    </a>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="p-6 md:p-8 border-b border-slate-100">
            <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">Tambah Kader Baru</h1>
            <p class="text-sm text-slate-500 mt-1">Masukkan informasi profil kader. Sistem akan membuatkan akun dan password secara otomatis.</p>
        </div>

        <form action="{{ route('admin.kader.store') }}" method="POST" class="p-6 md:p-8">
            @csrf

            <!-- Info Banner -->
            <div class="mb-8 flex items-start gap-4 p-4 bg-blue-50/50 border border-blue-100 rounded-2xl">
                <div class="p-2 bg-blue-100 text-blue-600 rounded-xl shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-blue-900">Pembuatan Password Otomatis</h4>
                    <p class="text-xs text-blue-700 mt-1 leading-relaxed">Anda tidak perlu memasukkan password. Password unik akan dibuatkan otomatis oleh sistem setelah data ini disimpan, dan kader diwajibkan mengganti password pada saat login pertama kali.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Contoh: Siti Aminah" class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-slate-700 @error('nama_lengkap') border-rose-300 ring-4 ring-rose-500/10 @enderror">
                    @error('nama_lengkap') <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="kader@email.com" class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-slate-700">
                </div>

                <!-- Unit Posyandu -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Penempatan Unit <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="unit_posyandu_id" required class="w-full py-3 pl-4 pr-10 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-slate-700 appearance-none cursor-pointer">
                            <option value="">-- Pilih Unit Posyandu --</option>
                            <!-- Looping dari controller -->
                            @foreach($unitPosyandus ?? [] as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_posyandu_id') == $unit->id ? 'selected' : '' }}>{{ $unit->nama }} - {{ $unit->wilayah }}</option>
                            @endforeach
                        </select>
                        <svg class="w-5 h-5 absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.kader.index') }}" class="py-2.5 px-6 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</a>
                <button type="submit" class="py-2.5 px-6 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm shadow-blue-600/20 transition-all">Simpan & Generate Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection