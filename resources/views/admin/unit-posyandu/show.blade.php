@extends('layouts.app-admin')
@section('title', 'Detail Unit Posyandu')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 pb-8 animate-fade-in-up">
    <div class="bg-white rounded-3xl border border-slate-200/60 p-8 shadow-[0_4px_24px_rgba(37,99,235,0.03)] space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <h1 class="font-display text-xl font-bold text-slate-900">{{ $unitPosyandu->nama_posyandu }}</h1>
            <a href="{{ route('admin.unit-posyandu.index') }}" class="text-xs font-bold text-blue-600 hover:underline">&larr; Kembali</a>
        </div>

        <div class="grid grid-cols-2 gap-4 text-xs">
            <div>
                <p class="text-slate-400 font-bold uppercase tracking-wider">Wilayah RW / RT</p>
                <p class="font-bold text-slate-800 mt-1">RW {{ $unitPosyandu->rw }} / RT {{ $unitPosyandu->rt ?? '-' }}</p>
            </div>
            <div>
                <p class="text-slate-400 font-bold uppercase tracking-wider">Tanggal Dibuat</p>
                <p class="font-bold text-slate-800 mt-1">{{ $unitPosyandu->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <div>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Alamat Lengkap</p>
            <p class="text-xs text-slate-700 font-medium mt-1 bg-slate-50 p-4 rounded-2xl border border-slate-100">{{ $unitPosyandu->alamat }}</p>
        </div>

        <div>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Keterangan</p>
            <p class="text-xs text-slate-700 font-medium mt-1 bg-slate-50 p-4 rounded-2xl border border-slate-100">{{ $unitPosyandu->keterangan ?? 'Tidak ada keterangan tambahan.' }}</p>
        </div>
    </div>
</div>
@endsection