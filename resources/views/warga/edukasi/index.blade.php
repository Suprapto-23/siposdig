@extends('layouts.app-warga')
@section('title', 'Edukasi Kesehatan - SIPOSDIG')

@section('content')
<div class="space-y-6 lg:space-y-8 pb-40 animate-fade-in-up">

    <!-- HEADER & PENCARIAN -->
    <div class="bg-gradient-to-br from-blue-600 via-blue-500 to-sky-400 rounded-[2.5rem] p-8 shadow-[0_15px_40px_rgba(59,130,246,0.25)] relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-48 h-48 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <p class="text-blue-100 text-xs font-bold tracking-widest uppercase mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Pusat Informasi
                </p>
                <h2 class="text-3xl font-black text-white leading-tight">Edukasi Kesehatan</h2>
                <p class="text-blue-100 text-sm font-medium mt-2 max-w-md">Temukan berbagai artikel, tips, dan panduan kesehatan terpercaya dari petugas posyandu.</p>
            </div>

            <!-- Form Pencarian -->
            <form action="{{ route('warga.edukasi.index') }}" method="GET" class="w-full md:w-80 relative">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari artikel..." class="w-full pl-5 pr-12 py-3.5 bg-white/20 backdrop-blur-md border border-white/30 text-white placeholder-blue-100 rounded-2xl outline-none focus:bg-white/30 transition-all font-medium text-sm">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-white hover:text-blue-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
        </div>
    </div>

    <!-- GRID ARTIKEL -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        @forelse($edukasi as $item)
            <a href="{{ route('warga.edukasi.show', $item->id) }}" class="group bg-white/90 backdrop-blur-2xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] hover:shadow-[0_15px_40px_rgba(37,99,235,0.08)] transition-all duration-300 overflow-hidden flex flex-col hover:-translate-y-1">
                
                <!-- Thumbnail -->
                <div class="w-full h-48 bg-slate-100 relative overflow-hidden shrink-0">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <!-- Placeholder jika tidak ada gambar -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-sky-100 flex items-center justify-center text-blue-300">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    <!-- Badge Kategori/Tanggal -->
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl text-[10px] font-black text-blue-600 uppercase tracking-widest shadow-sm">
                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-black text-slate-800 leading-snug mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $item->judul }}</h3>
                        <p class="text-xs font-medium text-slate-500 line-clamp-3 leading-relaxed">
                            {{ strip_tags($item->konten) }}
                        </p>
                    </div>
                    <div class="mt-5 pt-5 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $item->created_at->diffForHumans() }}
                        </span>
                        <span class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white/60 border-2 border-dashed border-slate-200 p-12 rounded-[2rem] flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-3xl flex items-center justify-center text-slate-400 mb-4 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-base font-black text-slate-700">Tidak Ada Artikel</h3>
                <p class="text-xs font-medium text-slate-500 mt-1">Belum ada artikel edukasi yang dipublikasikan atau sesuai pencarian Anda.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginasi -->
    @if($edukasi->hasPages())
    <div class="mt-8 pt-4">
        {{ $edukasi->links() }}
    </div>
    @endif

</div>
@endsection