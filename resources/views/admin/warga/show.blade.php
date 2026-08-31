@extends('layouts.app-admin')

@section('title', 'Detail Warga - SIPOSDIG')

@section('content')
<div class="w-full max-w-4xl mx-auto space-y-6">
    <a href="{{ route('admin.warga.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Data Warga
    </a>

    <div class="bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="p-6 md:p-8 bg-slate-50 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-xl font-bold font-display shadow-lg shadow-blue-500/20">
                    {{ substr($warga->nama_lengkap, 0, 1) }}
                </div>
                <div>
                    <h1 class="font-display text-xl font-bold text-slate-900">{{ $warga->nama_lengkap }}</h1>
                    <p class="text-xs text-slate-500 font-mono mt-0.5">NIK: {{ $warga->nik }}</p>
                </div>
            </div>
            <div>
                <span class="px-3 py-1.5 rounded-xl text-xs font-bold {{ $warga->status == 'aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600' }}">
                    Status: {{ ucfirst($warga->status) }}
                </span>
            </div>
        </div>

        <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div class="p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Jenis Kelamin</p>
                <p class="font-bold text-slate-800 mt-1">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            </div>
            <div class="p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Umur & Tanggal Lahir</p>
                <p class="font-bold text-slate-800 mt-1">{{ \Carbon\Carbon::parse($warga->tanggal_lahir)->age }} Tahun ({{ \Carbon\Carbon::parse($warga->tanggal_lahir)->format('d M Y') }})</p>
            </div>
            <div class="p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Unit Posyandu</p>
                <p class="font-bold text-slate-800 mt-1">{{ $warga->unitPosyandu->nama ?? '-' }}</p>
            </div>
            <div class="p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Nomor HP / WhatsApp</p>
                <p class="font-bold text-slate-800 mt-1">{{ $warga->no_hp ?? '-' }}</p>
            </div>
            <div class="col-span-1 md:col-span-2 p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Alamat Domisili</p>
                <p class="font-bold text-slate-800 mt-1">{{ $warga->alamat }}</p>
            </div>
        </div>
    </div>
</div>
@endsection