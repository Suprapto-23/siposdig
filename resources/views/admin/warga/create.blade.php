@extends('layouts.app-admin')

@section('title', 'Tambah Warga Baru - SIPOSDIG')

@section('content')
<div class="w-full max-w-4xl mx-auto space-y-6">
    <a href="{{ route('admin.warga.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Data Warga
    </a>

    <div class="bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="p-6 md:p-8 border-b border-slate-100">
            <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">Tambah Warga Baru</h1>
            <p class="text-sm text-slate-500 mt-1">Daftarkan data warga langsung ke dalam sistem posyandu.</p>
        </div>

        <form action="{{ route('admin.warga.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 outline-none transition-all text-slate-700">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">NIK (16 Digit) <span class="text-rose-500">*</span></label>
                    <input type="text" name="nik" maxlength="16" value="{{ old('nik') }}" required class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono focus:bg-white focus:ring-2 focus:ring-blue-600/20 outline-none transition-all text-slate-700">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 outline-none transition-all text-slate-700">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir <span class="text-rose-500">*</span></label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 outline-none transition-all text-slate-700">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin <span class="text-rose-500">*</span></label>
                    <select name="jenis_kelamin" required class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 outline-none transition-all text-slate-700">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Penempatan Unit Posyandu <span class="text-rose-500">*</span></label>
                    <select name="unit_posyandu_id" required class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 outline-none transition-all text-slate-700">
                        <option value="">-- Pilih Posyandu --</option>
                        @foreach($unitPosyandus as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->nama }} - {{ $unit->wilayah }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap <span class="text-rose-500">*</span></label>
                    <textarea name="alamat" rows="3" required class="w-full py-3 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 outline-none transition-all text-slate-700 resize-none">{{ old('alamat') }}</textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.warga.index') }}" class="py-2.5 px-6 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</a>
                <button type="submit" class="py-2.5 px-6 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm shadow-blue-600/20 transition-all">Simpan Warga</button>
            </div>
        </form>
    </div>
</div>
@endsection