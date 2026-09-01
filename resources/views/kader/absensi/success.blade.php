@extends('layouts.app-kader')
@section('title', 'Absensi Berhasil - SIPOSDIG')
@section('content')
<div class="w-full h-[80vh] flex items-center justify-center animate-fade-in-up">
    <div class="w-full max-w-md bg-white/80 backdrop-blur-2xl border border-white/90 rounded-[2.5rem] p-10 sm:p-12 shadow-[0_24px_60px_-15px_rgba(37,99,235,0.12)] relative text-center">
        
        <div class="absolute inset-0 bg-gradient-to-b from-blue-50/50 to-transparent pointer-events-none rounded-[2.5rem]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-48 h-48 bg-sky-300/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex justify-center mb-6">
            <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-blue-100 to-sky-50 flex items-center justify-center shadow-inner border border-white relative">
                <div class="absolute inset-0 rounded-full border-2 border-blue-400 border-dashed animate-[spin_8s_linear_infinite] opacity-50"></div>
                <svg class="w-12 h-12 text-blue-500 animate-[bounce_2s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <div class="relative z-10 space-y-3 mb-10">
            <h2 class="font-jakarta text-2xl font-extrabold tracking-tight text-slate-800">Penyimpanan Berhasil!</h2>
            <p class="text-[13.5px] text-slate-500 font-medium leading-relaxed">
                Data kehadiran massal untuk unit posyandu Anda telah berhasil direkam ke dalam sistem.
            </p>
        </div>

        <div class="relative z-10 flex flex-col gap-3">
            <a href="{{ route('kader.absensi.index') }}" class="w-full inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-500 text-white font-bold text-sm py-3.5 px-4 rounded-2xl shadow-[0_8px_20px_-6px_rgba(37,99,235,0.4)] transition-all hover:-translate-y-0.5">
                Lihat Riwayat Absensi
            </a>
            <a href="{{ route('kader.absensi.create') }}" class="w-full inline-flex items-center justify-center bg-slate-50 hover:bg-blue-50 border border-slate-200 text-slate-600 hover:text-blue-600 font-bold text-sm py-3.5 px-4 rounded-2xl transition-colors">
                Catat Kategori Lainnya
            </a>
        </div>
    </div>
</div>
@endsection