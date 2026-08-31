@extends('layouts.app-admin')
@section('title', isset($unitPosyandu) ? 'Edit Unit Posyandu' : 'Tambah Unit Posyandu')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 pb-8 animate-fade-in-up">
    <div class="bg-white rounded-3xl border border-slate-200/60 p-8 shadow-[0_4px_24px_rgba(37,99,235,0.03)]">
        <h1 class="font-display text-xl font-bold text-slate-900 mb-6">{{ isset($unitPosyandu) ? 'Edit Unit Posyandu' : 'Tambah Unit Posyandu Baru' }}</h1>

        <form action="{{ isset($unitPosyandu) ? route('admin.unit-posyandu.update', $unitPosyandu->id) : route('admin.unit-posyandu.store') }}" method="POST" class="space-y-4">
            @csrf
            @if(isset($unitPosyandu)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Posyandu</label>
                <input type="text" name="nama_posyandu" value="{{ old('nama_posyandu', $unitPosyandu->nama_posyandu ?? '') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3 px-4 text-xs focus:border-blue-500 focus:bg-white focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">RW</label>
                    <input type="text" name="rw" value="{{ old('rw', $unitPosyandu->rw ?? '') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3 px-4 text-xs focus:border-blue-500 focus:bg-white focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">RT (Opsional)</label>
                    <input type="text" name="rt" value="{{ old('rt', $unitPosyandu->rt ?? '') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3 px-4 text-xs focus:border-blue-500 focus:bg-white focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3 px-4 text-xs focus:border-blue-500 focus:bg-white focus:outline-none">{{ old('alamat', $unitPosyandu->alamat ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Keterangan</label>
                <textarea name="keterangan" rows="2" class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3 px-4 text-xs focus:border-blue-500 focus:bg-white focus:outline-none">{{ old('keterangan', $unitPosyandu->keterangan ?? '') }}</textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.unit-posyandu.index') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-xs font-bold text-slate-600 hover:bg-slate-50">Batal</a>
                <button type="submit" class="rounded-2xl bg-blue-600 px-6 py-3 text-xs font-bold text-white shadow-lg shadow-blue-600/30 hover:bg-blue-700">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection