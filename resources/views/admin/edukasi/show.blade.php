@extends('layouts.app-admin')
@section('title', $edukasi->judul)

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12 animate-fade-in-up mt-4">
    <!-- Kontrol Navigasi -->
    <div class="flex items-center justify-between mb-4">
        <a href="{{ route('admin.edukasi.index') }}" class="inline-flex items-center gap-2 text-[13px] font-bold text-slate-500 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Edukasi
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.edukasi.edit', $edukasi->id) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-sky-50 text-sky-700 text-[12px] font-bold hover:bg-sky-100 transition-colors">Edit</a>
            <form action="{{ route('admin.edukasi.destroy', $edukasi->id) }}" method="POST" onsubmit="return confirm('Hapus permanen artikel ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-red-50 text-red-600 text-[12px] font-bold hover:bg-red-100 transition-colors">Hapus</button>
            </form>
        </div>
    </div>

    <!-- Tampilan Artikel Utama -->
    <article class="bg-white rounded-[24px] border border-slate-200/60 overflow-hidden shadow-sm">
        
        <!-- Jika ada URL gambar, tampilkan banner -->
        @if($edukasi->gambar)
        <div class="w-full h-64 bg-slate-100 overflow-hidden">
            <img src="{{ $edukasi->gambar }}" alt="Cover Edukasi" class="w-full h-full object-cover">
        </div>
        @endif

        <div class="p-8 lg:p-12">
            <!-- Meta Data -->
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-[11px] font-bold border border-blue-100">
                    Kategori: {{ $edukasi->target_kategori }}
                </span>
                <span class="text-[12px] font-medium text-slate-400">
                    Dipublikasikan pada {{ $edukasi->created_at->format('d M Y, H:i') }} WIB
                </span>
            </div>

            <!-- Judul -->
            <h1 class="font-display text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight mb-8">
                {{ $edukasi->judul }}
            </h1>

            <!-- Konten (Tipografi Fokus pada Keterbacaan) -->
            <div class="prose prose-slate max-w-none text-[15px] leading-loose text-slate-700 whitespace-pre-line font-medium">
                {{ $edukasi->konten }}
            </div>
        </div>
    </article>
</div>
@endsection