@extends('layouts.app-kader')
@section('title', 'Profil Warga Binaan - SIPOSDIG')

@section('content')
<div class="w-full max-w-4xl mx-auto space-y-6 pb-12 animate-fade-in-up">

    <!-- Header & Back Button -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('kader.warga.index') }}" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all shadow-sm focus:outline-none hover:-translate-x-1"><svg class="w-6 h-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg></a>
            <div>
                <h2 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight">Profil Warga Binaan</h2>
                <p class="text-[13px] text-slate-500 font-medium mt-0.5">Informasi demografi lengkap dan status layanan posyandu.</p>
            </div>
        </div>
        <a href="{{ route('kader.warga.edit', $warga->id) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-amber-50 text-amber-600 hover:bg-amber-100 border border-amber-200 font-bold text-sm rounded-xl transition-all focus:outline-none shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit Profil
        </a>
    </div>

    <!-- Digital ID Card (Glassmorphism) -->
    <div class="bg-white/90 backdrop-blur-xl border border-slate-100 rounded-[2rem] p-8 sm:p-10 shadow-[0_8px_30px_rgba(37,99,235,0.05)] relative overflow-hidden">
        
        <!-- Dekorasi Background -->
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-gradient-to-br from-blue-50 to-sky-100 rounded-full blur-3xl pointer-events-none opacity-70"></div>
        <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-gradient-to-tr from-emerald-50 to-teal-50 rounded-full blur-3xl pointer-events-none opacity-60"></div>

        <div class="flex flex-col md:flex-row gap-8 relative z-10">
            <!-- Avatar Section -->
            <div class="flex flex-col items-center gap-4">
                <div class="w-32 h-32 rounded-[2rem] bg-gradient-to-br from-blue-500 to-sky-500 flex items-center justify-center text-white font-extrabold text-5xl shadow-xl shadow-blue-500/30">
                    {{ substr($warga->nama_lengkap, 0, 1) }}
                </div>
                @if($warga->status === 'aktif')
                    <span class="px-4 py-1.5 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 text-xs font-black uppercase tracking-widest shadow-sm">Aktif Layanan</span>
                @elseif($warga->status === 'pending')
                    <span class="px-4 py-1.5 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 text-xs font-black uppercase tracking-widest shadow-sm">Pending Verifikasi</span>
                @else
                    <span class="px-4 py-1.5 rounded-xl bg-slate-50 text-slate-500 border border-slate-200 text-xs font-black uppercase tracking-widest shadow-sm">Nonaktif</span>
                @endif
            </div>

            <!-- Identitas Section -->
            <div class="flex-1 space-y-6">
                <div>
                    <h3 class="font-jakarta text-3xl font-black text-slate-800 tracking-tight">{{ $warga->nama_lengkap }}</h3>
                    <p class="text-sm font-bold text-blue-600 font-mono mt-2 bg-blue-50 inline-block px-3 py-1.5 rounded-lg border border-blue-100 shadow-sm">NIK: {{ $warga->nik }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8 pt-2">
                    <div>
                        <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1.5">Tanggal Lahir</p>
                        <p class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1.5">Umur Aktual & Klasifikasi</p>
                        <p class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $warga->kategori == 'Balita' ? intval(\Carbon\Carbon::parse($warga->tanggal_lahir)->diffInMonths(now())) . ' Bulan' : intval(\Carbon\Carbon::parse($warga->tanggal_lahir)->age) . ' Tahun' }}
                            <span class="text-[10px] uppercase font-black text-blue-600 bg-blue-100 px-2 py-0.5 rounded-md">{{ $warga->kategori }}</span>
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1.5">Jenis Kelamin</p>
                        <p class="text-sm font-bold flex items-center gap-2">
                            @if($warga->jenis_kelamin == 'L')
                                <span class="text-blue-500 font-extrabold px-3 py-1 bg-blue-50 rounded-lg">👨 Laki-Laki</span>
                            @else
                                <span class="text-rose-500 font-extrabold px-3 py-1 bg-rose-50 rounded-lg">👩 Perempuan</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1.5">No. Handphone / WhatsApp</p>
                        <p class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $warga->no_hp ?? 'Tidak ditambahkan' }}
                        </p>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Alamat Domisili Lengkap</p>
                    <div class="p-4 bg-slate-50/80 border border-slate-100 rounded-xl">
                        <p class="text-sm font-medium text-slate-700 leading-relaxed">{{ $warga->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection