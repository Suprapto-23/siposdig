@extends('layouts.app-warga')
@section('title', 'Beranda - SIPOSDIG')

@section('content')
<!-- KUNCI FIX: pb-40 memberikan ruang kosong ekstra besar di bawah agar konten tidak tertutup bottom navbar -->
<div class="space-y-6 pb-40 animate-fade-in-up">

    <!-- 1. KARTU SAMBUTAN UTAMA -->
    <div class="bg-gradient-to-br from-blue-500 to-sky-400 rounded-[2rem] p-6 shadow-[0_10px_40px_rgba(59,130,246,0.3)] relative overflow-hidden">
        <!-- Efek Cahaya Latar (Glassmorphism) -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-40 h-40 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10">
            <p class="text-blue-50 text-xs font-bold tracking-widest uppercase mb-1">Selamat Datang,</p>
            <h2 class="text-2xl font-black text-white leading-tight mb-4">{{ $warga->nama_lengkap ?? 'Warga' }}</h2>
            
            <div class="flex items-center gap-3 bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl p-3">
                <div class="w-10 h-10 bg-white text-blue-500 rounded-xl flex items-center justify-center font-black shadow-sm">
                    {{ substr($warga->nama_lengkap ?? 'W', 0, 1) }}
                </div>
                <div>
                    <p class="text-white text-sm font-bold">{{ $warga->nik ?? '-' }}</p>
                    <p class="text-blue-100 text-[10px] font-extrabold uppercase tracking-wider">Kategori: {{ $warga->kategori ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. JADWAL POSYANDU TERDEKAT -->
    <div>
        <div class="flex justify-between items-end mb-3 px-1">
            <h3 class="text-sm font-extrabold text-slate-800">Jadwal Posyandu Terdekat</h3>
        </div>
        
        @if(isset($jadwalMendatang) && $jadwalMendatang)
            <div class="bg-white/80 backdrop-blur-xl border border-slate-100 p-5 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.05)] flex items-center gap-4 relative overflow-hidden">
                <div class="w-1.5 h-full bg-emerald-400 absolute left-0 top-0"></div>
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex flex-col items-center justify-center border border-emerald-100 shrink-0">
                    <span class="text-xs font-bold text-emerald-600">{{ \Carbon\Carbon::parse($jadwalMendatang->tanggal)->translatedFormat('M') }}</span>
                    <span class="text-lg font-black text-emerald-700 leading-none">{{ \Carbon\Carbon::parse($jadwalMendatang->tanggal)->format('d') }}</span>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800">{{ $jadwalMendatang->keterangan ?? 'Pelayanan Rutin Posyandu' }}</h4>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">Pukul {{ \Carbon\Carbon::parse($jadwalMendatang->waktu_mulai)->format('H:i') }} WIB</p>
                </div>
            </div>
        @else
            <div class="bg-white/60 border border-dashed border-slate-200 p-5 rounded-[2rem] flex flex-col items-center justify-center text-center">
                <p class="text-xs font-bold text-slate-400">Belum ada jadwal posyandu terdekat untuk unit Anda.</p>
            </div>
        @endif
    </div>

    <!-- 3. KESEHATAN TERAKHIR -->
    <div>
        <div class="flex justify-between items-end mb-3 px-1">
            <h3 class="text-sm font-extrabold text-slate-800">Kesehatan Terakhir</h3>
            <a href="{{ route('warga.riwayat.index') }}" class="text-[10px] font-black text-blue-600 uppercase tracking-wider hover:text-blue-800 transition-colors">Lihat Riwayat</a>
        </div>

        @if(isset($pengukuranTerakhir) && $pengukuranTerakhir)
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/80 backdrop-blur-xl border border-slate-100 p-4 rounded-[2rem] shadow-[0_8px_20px_rgba(37,99,235,0.04)]">
                    <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </div>
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Berat Badan</p>
                    <p class="text-xl font-black text-slate-800 mt-1">{{ $pengukuranTerakhir->berat_badan }} <span class="text-xs font-bold text-slate-500">kg</span></p>
                </div>
                <div class="bg-white/80 backdrop-blur-xl border border-slate-100 p-4 rounded-[2rem] shadow-[0_8px_20px_rgba(37,99,235,0.04)]">
                    <div class="w-8 h-8 rounded-full bg-sky-50 text-sky-500 flex items-center justify-center mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Tinggi/Panjang</p>
                    <p class="text-xl font-black text-slate-800 mt-1">{{ $pengukuranTerakhir->tinggi_badan }} <span class="text-xs font-bold text-slate-500">cm</span></p>
                </div>
            </div>
        @else
            <div class="bg-white/60 border border-dashed border-slate-200 p-5 rounded-[2rem] flex flex-col items-center justify-center text-center">
                <div class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-[11px] font-bold text-slate-500">Belum ada data pengukuran.</p>
                <p class="text-[10px] text-slate-400 mt-0.5">Silakan hadir pada jadwal Posyandu berikutnya.</p>
            </div>
        @endif
    </div>

    <!-- 4. ARTIKEL KESEHATAN -->
    <div>
        <div class="flex justify-between items-end mb-3 px-1">
            <h3 class="text-sm font-extrabold text-slate-800">Artikel Kesehatan</h3>
            <a href="{{ route('warga.edukasi.index') }}" class="text-[10px] font-black text-blue-600 uppercase tracking-wider hover:text-blue-800 transition-colors">Semua</a>
        </div>

        <div class="space-y-3">
            @forelse($edukasiTerbaru ?? [] as $edukasi)
                <a href="{{ route('warga.edukasi.show', $edukasi->id) }}" class="block bg-white/80 backdrop-blur-xl border border-slate-100 p-3.5 rounded-2xl shadow-[0_4px_15px_rgba(37,99,235,0.03)] hover:bg-blue-50/30 transition-all flex gap-3 items-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0 border border-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 leading-snug">{{ $edukasi->judul }}</h4>
                        <p class="text-[9px] font-bold text-slate-400 mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $edukasi->created_at->diffForHumans() }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="bg-white/60 border border-dashed border-slate-200 p-4 rounded-2xl text-center">
                    <p class="text-xs font-bold text-slate-400">Belum ada artikel terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection