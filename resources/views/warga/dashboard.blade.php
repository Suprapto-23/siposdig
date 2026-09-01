@extends('layouts.app-warga')
@section('title', 'Dashboard Warga - SIPOSDIG')

@section('content')
<div class="w-full max-w-lg mx-auto space-y-8 pb-20 animate-fade-in-up">

    <!-- 1. HEADER & GREETING (Glassmorphism) -->
    <div class="bg-gradient-to-br from-blue-500 to-sky-400 rounded-[2.5rem] p-8 shadow-[0_15px_40px_-10px_rgba(14,165,233,0.4)] relative overflow-hidden text-white">
        <!-- Dekorasi Ornamen -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 h-32 bg-sky-200 opacity-20 rounded-full blur-xl"></div>
        
        <div class="relative z-10 flex items-center gap-5">
            <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-md border border-white/40 flex items-center justify-center text-2xl font-black shadow-inner">
                {{ substr($warga->nama_lengkap, 0, 1) }}
            </div>
            <div>
                <p class="text-sky-100 text-sm font-medium tracking-wide mb-0.5">Selamat datang,</p>
                <h1 class="font-jakarta text-2xl font-black leading-tight">{{ $warga->nama_lengkap }}</h1>
                <span class="inline-block mt-2 px-3 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[10px] font-extrabold uppercase tracking-widest border border-white/30">
                    Warga {{ $warga->kategori }}
                </span>
            </div>
        </div>
    </div>

    <!-- 2. KARTU MENUJU SEHAT DIGITAL (Ringkasan Pengukuran Terakhir) -->
    <div>
        <div class="flex items-center justify-between mb-4 px-2">
            <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider">Cek Kesehatan Terakhir</h2>
            <a href="{{ route('warga.riwayat.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-3 py-1.5 rounded-full transition-colors">Lihat Riwayat</a>
        </div>

        @if($pengukuranTerakhir)
            <div class="bg-white/80 backdrop-blur-2xl rounded-[2rem] p-6 shadow-[0_8px_30px_rgba(37,99,235,0.05)] border border-slate-100 relative">
                
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100/80">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Tanggal Pemeriksaan</p>
                        <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($pengukuranTerakhir->tanggal_ukur)->locale('id')->isoFormat('D MMMM YYYY') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-2xl p-4 text-center border border-slate-100/50">
                        <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Berat Badan</p>
                        <p class="text-2xl font-black text-blue-600">{{ $pengukuranTerakhir->berat_badan ?? '-' }}<span class="text-xs text-slate-500 font-bold ml-1">kg</span></p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 text-center border border-slate-100/50">
                        <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Tinggi Badan</p>
                        <p class="text-2xl font-black text-blue-600">{{ $pengukuranTerakhir->tinggi_badan ?? '-' }}<span class="text-xs text-slate-500 font-bold ml-1">cm</span></p>
                    </div>
                </div>

                <!-- Info Spesifik Kategori -->
                <div class="mt-4 p-4 rounded-2xl border flex items-start gap-3 
                    {{ $warga->kategori == 'Balita' ? 'bg-emerald-50 border-emerald-100' : 'bg-purple-50 border-purple-100' }}">
                    <div class="mt-0.5">
                        @if($warga->kategori == 'Balita')
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        @else
                            <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        @endif
                    </div>
                    <div>
                        @if($warga->kategori == 'Balita')
                            <p class="text-[10px] font-extrabold text-emerald-600 uppercase tracking-widest mb-0.5">Status Tumbuh Kembang (Stunting)</p>
                            <p class="text-sm font-bold text-emerald-800">{{ $pengukuranTerakhir->status_stunting ? ucwords(str_replace('_', ' ', $pengukuranTerakhir->status_stunting)) : 'Belum dievaluasi' }}</p>
                        @else
                            <p class="text-[10px] font-extrabold text-purple-600 uppercase tracking-widest mb-0.5">Indeks Massa Tubuh (IMT)</p>
                            <p class="text-sm font-bold text-purple-800">{{ $pengukuranTerakhir->imt ?? '-' }}</p>
                        @endif
                    </div>
                </div>

            </div>
        @else
            <!-- State jika belum pernah periksa -->
            <div class="bg-white/80 backdrop-blur-2xl rounded-[2rem] p-8 shadow-[0_8px_30px_rgba(37,99,235,0.05)] border border-slate-100 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-base font-black text-slate-800 mb-1">Belum Ada Data</h3>
                <p class="text-xs font-medium text-slate-500">Anda belum memiliki riwayat pengukuran di Posyandu. Silakan hadir pada jadwal Posyandu berikutnya.</p>
            </div>
        @endif
    </div>

    <!-- 3. ARTIKEL EDUKASI KESEHATAN -->
    <div>
        <div class="flex items-center justify-between mb-4 px-2">
            <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider">Artikel Kesehatan</h2>
            <a href="{{ route('warga.edukasi.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-3 py-1.5 rounded-full transition-colors">Lihat Semua</a>
        </div>

        <div class="space-y-4">
            @forelse($edukasiTerbaru as $edukasi)
                <a href="{{ route('warga.edukasi.show', $edukasi->slug ?? $edukasi->id) }}" class="block bg-white/80 backdrop-blur-2xl p-4 rounded-[1.5rem] border border-slate-100 shadow-sm hover:shadow-[0_8px_30px_rgba(37,99,235,0.08)] transition-all hover:-translate-y-1 group">
                    <div class="flex gap-4 items-center">
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-100 to-sky-50 flex items-center justify-center shrink-0">
                            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-bold text-slate-800 leading-snug group-hover:text-blue-600 transition-colors line-clamp-2">{{ $edukasi->judul }}</h3>
                            <p class="text-[11px] font-medium text-slate-400 mt-1.5 flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $edukasi->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="bg-slate-50/80 border border-slate-100 p-6 rounded-[1.5rem] text-center">
                    <p class="text-xs font-bold text-slate-500">Belum ada artikel edukasi terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection