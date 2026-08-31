@extends('layouts.app-admin')
@section('title', isset($edukasi) ? 'Edit Edukasi' : 'Tulis Edukasi Kesehatan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 pb-12 animate-fade-in-up mt-4">
    <div class="flex items-center justify-between mb-2">
        <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">{{ isset($edukasi) ? 'Edit Artikel Edukasi' : 'Tulis Artikel Edukasi' }}</h1>
        <a href="{{ route('admin.edukasi.index') }}" class="text-[13px] font-bold text-slate-500 hover:text-blue-600 transition-colors flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-[24px] border border-slate-200/60 p-8 shadow-sm">
        <form action="{{ isset($edukasi) ? route('admin.edukasi.update', $edukasi->id) : route('admin.edukasi.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($edukasi)) @method('PUT') @endif

            <!-- Field Judul -->
            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Judul Artikel</label>
                <input type="text" name="judul" value="{{ old('judul', $edukasi->judul ?? '') }}" required placeholder="Masukkan judul artikel kesehatan..." class="w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 px-4 text-[14px] font-semibold text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all">
            </div>

            <!-- Field Kategori & URL Gambar (Baris yang sama) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Target Kategori Warga</label>
                    <div class="relative">
                        <select name="target_kategori" required class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 pl-4 pr-10 text-[13px] font-semibold text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all cursor-pointer">
                            <option value="">Pilih Kategori Sasaran</option>
                            @foreach(['Semua', 'Balita', 'Remaja', 'Lansia'] as $kat)
                                <option value="{{ $kat }}" {{ old('target_kategori', $edukasi->target_kategori ?? '') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">URL Gambar (Opsional)</label>
                    <input type="url" name="gambar" value="{{ old('gambar', $edukasi->gambar ?? '') }}" placeholder="https://contoh.com/gambar.jpg" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 px-4 text-[13px] font-medium text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all">
                </div>
            </div>

            <!-- Field Konten Area Lebar -->
            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Isi Materi Edukasi</label>
                <textarea name="konten" rows="12" required placeholder="Tuliskan materi edukasi kesehatan secara detail dan informatif..." class="w-full rounded-xl border border-slate-200 bg-slate-50/50 p-4 text-[14px] leading-relaxed font-medium text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all resize-y">{{ old('konten', $edukasi->konten ?? '') }}</textarea>
            </div>

            <!-- Aksi Tombol -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.edukasi.index') }}" class="rounded-xl px-6 py-3 text-[13px] font-bold text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition-colors">Batal</a>
                <button type="submit" class="rounded-xl bg-blue-600 px-8 py-3 text-[13px] font-bold text-white shadow-md shadow-blue-600/20 hover:bg-blue-700 transition-colors">
                    {{ isset($edukasi) ? 'Simpan Perubahan' : 'Publikasikan Artikel' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection