@extends('layouts.app-admin')
@section('title', isset($edukasi) ? 'Edit Edukasi Kesehatan' : 'Tulis Edukasi Kesehatan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-8 animate-fade-in-up">
    <div class="bg-white rounded-3xl border border-slate-200/60 p-8 shadow-[0_4px_24px_rgba(37,99,235,0.03)]">
        <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-6">
            <h1 class="font-display text-xl font-bold text-slate-900">{{ isset($edukasi) ? 'Edit Artikel Edukasi' : 'Buat Artikel Edukasi Baru' }}</h1>
            <a href="{{ route('admin.edukasi.index') }}" class="text-xs font-bold text-blue-600 hover:underline">&larr; Kembali</a>
        </div>
        
        <form action="{{ isset($edukasi) ? route('admin.edukasi.update', $edukasi->id) : route('admin.edukasi.store') }}" method="POST" class="space-y-5">
            @csrf
            @if(isset($edukasi)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Artikel</label>
                <input type="text" name="judul" value="{{ old('judul', $edukasi->judul ?? '') }}" required placeholder="Contoh: Pentingnya Pemberian ASI Eksklusif untuk Mencegah Stunting" class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3.5 px-4 text-xs font-medium text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none transition-all">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Edukasi</label>
                    <select name="kategori" required class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3.5 px-4 text-xs font-medium text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none transition-all">
                        <option value="">Pilih Kategori</option>
                        @foreach(['Gizi Balita', 'Ibu Hamil', 'Lansia', 'Penyakit Umum'] as $kat)
                            <option value="{{ $kat }}" {{ (old('kategori', $edukasi->kategori ?? '') == $kat) ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Penulis / Instansi</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $edukasi->penulis ?? 'Administrator') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3.5 px-4 text-xs font-medium text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Konten Artikel</label>
                <textarea name="konten" rows="8" required placeholder="Tuliskan panduan atau informasi kesehatan secara lengkap..." class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 p-4 text-xs font-medium text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none transition-all">{{ old('konten', $edukasi->konten ?? '') }}</textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.edukasi.index') }}" class="rounded-2xl border border-slate-200 bg-white px-6 py-3 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all">Batal</a>
                <button type="submit" class="rounded-2xl bg-blue-600 px-7 py-3 text-xs font-bold text-white shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition-all">Simpan & Publikasikan</button>
            </div>
        </form>
    </div>
</div>
@endsection