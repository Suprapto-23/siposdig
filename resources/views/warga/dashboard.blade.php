@extends('layouts.app-warga')
@section('title', 'Beranda Warga - SIPOSDIG')

@section('content')
<div class="space-y-8 animate-fade-in-up">

    <!-- HERO SECTION -->
    <div class="bg-gradient-to-br from-blue-600 via-blue-500 to-sky-400 rounded-[2.5rem] p-8 lg:p-10 shadow-[0_15px_40px_rgba(59,130,246,0.25)] relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-48 h-48 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-48 h-48 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10">
            <p class="text-blue-100 text-xs font-bold tracking-widest uppercase mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                Selamat Datang,
            </p>
            <h2 class="text-3xl lg:text-4xl font-black text-white leading-tight">{{ $warga->nama_lengkap ?? 'Warga Binaan' }}</h2>
            <div class="flex flex-wrap gap-3 mt-4">
                <span class="bg-black/10 backdrop-blur-sm border border-white/20 text-white text-[11px] font-extrabold uppercase tracking-wider px-3.5 py-2 rounded-xl">Kategori: {{ $warga->kategori ?? '-' }}</span>
                <span class="bg-emerald-500/20 backdrop-blur-sm border border-emerald-300/30 text-emerald-50 text-[11px] font-extrabold uppercase tracking-wider px-3.5 py-2 rounded-xl flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Terpantau Aktif
                </span>
            </div>
        </div>
    </div>

    <!-- MENU PINTAS (Quick Actions) -->
    <div class="grid grid-cols-4 gap-4 lg:gap-6">
        <a href="{{ route('warga.riwayat.index') }}" class="group flex flex-col items-center gap-2.5">
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-white border border-slate-100 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.04)] flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all group-hover:-translate-y-1.5">
                <svg class="w-7 h-7 lg:w-8 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <span class="text-xs font-bold text-slate-600 text-center tracking-tight">Riwayat Cek</span>
        </a>
        <a href="{{ route('warga.edukasi.index') }}" class="group flex flex-col items-center gap-2.5">
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-white border border-slate-100 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.04)] flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all group-hover:-translate-y-1.5">
                <svg class="w-7 h-7 lg:w-8 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <span class="text-xs font-bold text-slate-600 text-center tracking-tight">Artikel Edukasi</span>
        </a>
        <a href="{{ route('warga.profil.index') }}" class="group flex flex-col items-center gap-2.5">
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-white border border-slate-100 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.04)] flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-all group-hover:-translate-y-1.5">
                <svg class="w-7 h-7 lg:w-8 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
            </div>
            <span class="text-xs font-bold text-slate-600 text-center tracking-tight">Kartu Posyandu</span>
        </a>
        <a href="{{ route('warga.profil.index') }}" class="group flex flex-col items-center gap-2.5">
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-white border border-slate-100 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.04)] flex items-center justify-center text-rose-500 group-hover:bg-rose-500 group-hover:text-white transition-all group-hover:-translate-y-1.5">
                <svg class="w-7 h-7 lg:w-8 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-xs font-bold text-slate-600 text-center tracking-tight">Pengaturan</span>
        </a>
    </div>

    <!-- GRID BAWAH -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- KOLOM KIRI -->
        <div class="space-y-8">
            
            <!-- Jadwal Posyandu Terdekat -->
            <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 p-8 rounded-[2.5rem] shadow-[0_10px_40px_rgba(37,99,235,0.04)]">
                <h3 class="text-base font-black text-slate-800 mb-5 flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Jadwal Terdekat
                </h3>
                
                @if(isset($jadwalMendatang) && $jadwalMendatang)
                    <div class="bg-emerald-50/50 border border-emerald-100 p-6 rounded-3xl flex items-center gap-5">
                        <div class="w-16 h-16 lg:w-20 lg:h-20 bg-white rounded-2xl flex flex-col items-center justify-center border border-emerald-100 shrink-0 shadow-sm">
                            <span class="text-xs font-bold text-emerald-600">{{ \Carbon\Carbon::parse($jadwalMendatang->tanggal)->translatedFormat('M') }}</span>
                            <span class="text-2xl font-black text-emerald-700 leading-none mt-1">{{ \Carbon\Carbon::parse($jadwalMendatang->tanggal)->format('d') }}</span>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-800 leading-tight">{{ $jadwalMendatang->keterangan ?? 'Pelayanan Rutin Posyandu' }}</h4>
                            <p class="text-sm font-medium text-slate-500 mt-1.5">Pukul {{ \Carbon\Carbon::parse($jadwalMendatang->waktu_mulai)->format('H:i') }} WIB</p>
                            <p class="text-xs font-bold text-blue-600 mt-2 flex items-center gap-1.5 bg-white inline-block px-3 py-1.5 rounded-xl border border-blue-50 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $warga->unitPosyandu->nama ?? 'Unit Anda' }}
                            </p>
                        </div>
                    </div>
                @else
                    <div class="bg-slate-50 border border-dashed border-slate-200 p-8 rounded-3xl text-center">
                        <p class="text-sm font-bold text-slate-400">Belum ada jadwal posyandu bulan ini.</p>
                    </div>
                @endif
            </div>

            <!-- Hasil Pengukuran Terakhir -->
            <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 p-8 rounded-[2.5rem] shadow-[0_10px_40px_rgba(37,99,235,0.04)]">
                <h3 class="text-base font-black text-slate-800 mb-5 flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Hasil Pengukuran Terakhir
                </h3>

                @if(isset($pengukuranTerakhir) && $pengukuranTerakhir)
                    <div class="grid grid-cols-2 gap-5">
                        <div class="bg-slate-50 border border-slate-100 p-5 rounded-3xl relative overflow-hidden group hover:bg-amber-50/50 transition-colors">
                            <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mb-3 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                            </div>
                            <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest group-hover:text-amber-500 transition-colors">Berat Badan</p>
                            <p class="text-2xl font-black text-slate-800 mt-1">{{ $pengukuranTerakhir->berat_badan }} <span class="text-sm font-bold text-slate-500">kg</span></p>
                        </div>
                        
                        <div class="bg-slate-50 border border-slate-100 p-5 rounded-3xl relative overflow-hidden group hover:bg-sky-50/50 transition-colors">
                            <div class="w-10 h-10 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center mb-3 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest group-hover:text-sky-500 transition-colors">Tinggi Badan</p>
                            <p class="text-2xl font-black text-slate-800 mt-1">{{ $pengukuranTerakhir->tinggi_badan }} <span class="text-sm font-bold text-slate-500">cm</span></p>
                        </div>
                    </div>
                @else
                    <div class="bg-slate-50 border border-dashed border-slate-200 p-8 rounded-3xl text-center">
                        <p class="text-sm font-bold text-slate-400">Belum ada data kesehatan.</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- KOLOM KANAN -->
        <div class="bg-white/90 backdrop-blur-2xl border border-slate-100 p-8 rounded-[2.5rem] shadow-[0_10px_40px_rgba(37,99,235,0.04)] h-fit">
            <div class="flex justify-between items-end mb-6">
                <h3 class="text-base font-black text-slate-800 flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> Artikel Edukasi
                </h3>
                <a href="{{ route('warga.edukasi.index') }}" class="text-xs font-black text-blue-600 uppercase tracking-wider hover:text-blue-800 transition-colors">Semua</a>
            </div>

            <div class="space-y-4">
                @forelse($edukasiTerbaru ?? [] as $edukasi)
                    <a href="{{ route('warga.edukasi.show', $edukasi->id) }}" class="block bg-slate-50 hover:bg-blue-50/50 border border-slate-100 p-4 rounded-3xl transition-all flex gap-4 items-center group">
                        <div class="w-14 h-14 rounded-2xl bg-white shadow-sm text-blue-500 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-slate-800 line-clamp-2 leading-snug group-hover:text-blue-600 transition-colors">{{ $edukasi->judul }}</h4>
                            <p class="text-[11px] font-bold text-slate-400 mt-1.5 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $edukasi->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                @empty
                    <p class="text-xs font-bold text-slate-400 text-center py-6">Belum ada artikel terbaru.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection