@extends('layouts.app-warga')
@section('title', $edukasi->judul . ' - SIPOSDIG')

@section('content')
<div class="space-y-8 pb-40 animate-fade-in-up">

    <!-- Tombol Kembali -->
    <a href="{{ route('warga.edukasi.index') }}" class="inline-flex items-center gap-2 text-xs font-black text-slate-400 hover:text-blue-600 transition-colors uppercase tracking-widest bg-white/50 px-4 py-2 rounded-xl">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Edukasi
    </a>

    <!-- ARTIKEL UTAMA -->
    <article class="bg-white/90 backdrop-blur-2xl border border-slate-100 rounded-[2.5rem] shadow-[0_15px_40px_rgba(37,99,235,0.04)] overflow-hidden">
        
        <!-- Cover Image -->
        @if($edukasi->gambar)
            <div class="w-full h-[250px] sm:h-[350px] lg:h-[450px] relative">
                <img src="{{ asset('storage/' . $edukasi->gambar) }}" alt="{{ $edukasi->judul }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
            </div>
        @endif

        <div class="p-6 sm:p-10 lg:p-12">
            <!-- Header Artikel -->
            <div class="{{ $edukasi->gambar ? '-mt-16 sm:-mt-20 lg:-mt-24 relative z-10 bg-white p-6 sm:p-8 rounded-[2rem] shadow-xl' : '' }}">
                <div class="flex items-center gap-3 mb-4">
                    <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest">Kesehatan</span>
                    <span class="text-[11px] font-bold text-slate-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ \Carbon\Carbon::parse($edukasi->created_at)->translatedFormat('d M Y') }}
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-800 leading-tight mb-4">{{ $edukasi->judul }}</h1>
                <hr class="border-slate-100">
            </div>

            <!-- Isi Konten Artikel (Typografi dioptimalkan untuk membaca) -->
            <div class="prose prose-slate prose-blue max-w-none mt-8 text-sm sm:text-base text-slate-600 leading-loose
                prose-headings:font-black prose-headings:text-slate-800
                prose-a:text-blue-600 prose-a:font-bold prose-img:rounded-[2rem] prose-img:shadow-md">
                {!! $edukasi->konten !!}
            </div>
        </div>
    </article>

    <!-- ARTIKEL REKOMENDASI (BACA JUGA) -->
    @if($artikelLain->count() > 0)
    <div class="mt-12">
        <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> Baca Juga
        </h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach($artikelLain as $item)
                <a href="{{ route('warga.edukasi.show', $item->id) }}" class="group bg-white/80 backdrop-blur-xl border border-slate-100 p-4 rounded-[2rem] shadow-[0_8px_20px_rgba(37,99,235,0.03)] hover:shadow-[0_15px_30px_rgba(37,99,235,0.08)] hover:-translate-y-1 transition-all flex flex-col gap-4">
                    <div class="w-full h-32 rounded-2xl bg-slate-100 overflow-hidden shrink-0">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Thumbnail" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 line-clamp-2 group-hover:text-blue-600 transition-colors">{{ $item->judul }}</h4>
                        <p class="text-[10px] font-bold text-slate-400 mt-2">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection