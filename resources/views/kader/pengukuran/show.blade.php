@extends('layouts.app-kader')
@section('title', 'Detail Rekam Medis - SIPOSDIG')
@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up">

    <!-- Header & Back Button -->
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('kader.pengukuran.index') }}" class="w-11 h-11 flex items-center justify-center bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all shadow-sm focus:outline-none hover:-translate-x-1"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg></a>
        <div>
            <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 tracking-tight">E-Rekam Medis Posyandu</h2>
            <p class="text-[13px] text-slate-500 font-bold mt-0.5">Tgl Ukur: <span class="text-blue-600">{{ \Carbon\Carbon::parse($pengukuran->tanggal_ukur)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span></p>
        </div>
    </div>

    <!-- Identitas -->
    <div class="bg-white/90 backdrop-blur-xl border border-slate-100 rounded-[2rem] p-6 shadow-[0_8px_30px_rgba(37,99,235,0.04)] flex flex-col sm:flex-row items-center justify-between gap-6 relative overflow-hidden">
        <div class="flex items-center gap-5 relative z-10">
            <div class="w-20 h-20 rounded-[1.5rem] bg-gradient-to-br from-blue-500 to-sky-500 flex items-center justify-center text-white font-extrabold text-3xl shadow-lg shadow-blue-500/30">{{ substr($pengukuran->warga->nama_lengkap ?? 'U', 0, 1) }}</div>
            <div>
                <h3 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight mb-1">{{ $pengukuran->warga->nama_lengkap }}</h3>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-slate-500 font-mono bg-slate-50 px-3 py-1 rounded-lg border">NIK: {{ $pengukuran->warga->nik }}</span>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-3 py-1 rounded-lg border border-blue-100">{{ $pengukuran->kategori_saat_ukur }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Metric Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- 1. Antropometri Dasar -->
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 pb-3 mb-4 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Pengukuran Dasar</h4>
            <div class="space-y-3">
                <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">Berat Badan</span><span class="text-lg font-black">{{ $pengukuran->berat_badan ?? '-' }} <span class="text-xs text-slate-400">kg</span></span></div>
                <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">Tinggi Badan</span><span class="text-lg font-black">{{ $pengukuran->tinggi_badan ?? '-' }} <span class="text-xs text-slate-400">cm</span></span></div>
                
                @if($pengukuran->kategori_saat_ukur == 'Balita')
                    <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">Lingkar Kepala</span><span class="text-lg font-black">{{ $pengukuran->lingkar_kepala ?? '-' }} <span class="text-xs text-slate-400">cm</span></span></div>
                    <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl border border-slate-100"><span class="text-sm font-bold text-slate-600">Status Stunting</span><span class="text-sm font-black text-emerald-500">{{ $pengukuran->status_stunting ? ucfirst(str_replace('_', ' ', $pengukuran->status_stunting)) : '-' }}</span></div>
                @else
                    <div class="flex justify-between items-center bg-blue-50/50 p-3 rounded-xl border border-blue-50"><span class="text-sm font-bold text-blue-700">Skor IMT</span><span class="text-xl font-black text-blue-700">{{ $pengukuran->imt ?? '-' }}</span></div>
                @endif
            </div>
        </div>

        <!-- 2. Pemeriksaan Lanjutan (Remaja & Lansia) -->
        @if(in_array($pengukuran->kategori_saat_ukur, ['Remaja', 'Lansia']))
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 pb-3 mb-4 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-rose-400"></span> Pemeriksaan Fisik</h4>
            <div class="space-y-3">
                <div class="flex justify-between items-center bg-rose-50/30 p-3 rounded-xl border border-rose-50"><span class="text-sm font-bold text-rose-700">Tensi (Sis/Dias)</span><span class="text-lg font-black text-rose-700">{{ $pengukuran->sistol ?? '-' }} / {{ $pengukuran->diastol ?? '-' }} <span class="text-[10px]">mmHg</span></span></div>
                <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">Lingkar Perut</span><span class="text-lg font-black">{{ $pengukuran->lingkar_perut ?? '-' }} <span class="text-xs text-slate-400">cm</span></span></div>
                <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">LILA</span><span class="text-lg font-black">{{ $pengukuran->lila ?? '-' }} <span class="text-xs text-slate-400">cm</span></span></div>
                <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">Hemoglobin (HB)</span><span class="text-lg font-black">{{ $pengukuran->hemoglobin ?? '-' }} <span class="text-xs text-slate-400">g/dL</span></span></div>
            </div>
        </div>
        @endif

        <!-- 3. Lab & Kemandirian (Khusus Lansia) -->
        @if($pengukuran->kategori_saat_ukur == 'Lansia')
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm lg:col-span-1 md:col-span-2">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 pb-3 mb-4 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Laboratorium & Kemandirian</h4>
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-3 mb-4">
                <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">Gula Darah</span><span class="text-lg font-black">{{ $pengukuran->gula_darah ?? '-' }} <span class="text-[10px]">mg/dL</span></span></div>
                <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">Kolesterol</span><span class="text-lg font-black">{{ $pengukuran->kolesterol ?? '-' }} <span class="text-[10px]">mg/dL</span></span></div>
                <div class="flex justify-between items-center bg-slate-50/50 p-3 rounded-xl"><span class="text-sm font-bold text-slate-600">Asam Urat</span><span class="text-lg font-black">{{ $pengukuran->asam_urat ?? '-' }} <span class="text-[10px]">mg/dL</span></span></div>
            </div>
            <div class="bg-purple-50/50 p-4 rounded-xl border border-purple-100 flex flex-col">
                <span class="text-[11px] font-bold text-purple-600 uppercase tracking-widest mb-1">Status Kemandirian</span>
                <span class="text-sm font-black text-purple-800">{{ $pengukuran->status_kemandirian ? ucwords(str_replace('_', ' ', $pengukuran->status_kemandirian)) : 'Belum Ditentukan' }}</span>
            </div>
        </div>
        @endif
    </div>

    <!-- Catatan -->
    <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm">
        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 pb-3 mb-3">Catatan Petugas Pemeriksa</h4>
        <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl">
            <p class="text-sm font-medium text-slate-700 leading-relaxed">{{ $pengukuran->catatan ?? 'Tidak ada catatan tambahan untuk warga ini.' }}</p>
        </div>
    </div>

</div>
@endsection