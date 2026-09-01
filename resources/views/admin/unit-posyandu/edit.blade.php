@extends('layouts.app-admin')
@section('title', 'Edit Unit Posyandu - SIPOSDIG')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 pb-8">
    <h1 class="font-display text-2xl font-extrabold text-slate-900">Edit Unit Posyandu</h1>

    <form method="POST" action="{{ route('admin.unit-posyandu.update', $unit->id) }}" class="bg-white p-6 rounded-3xl border border-slate-200/60 shadow-[0_4px_24px_rgba(37,99,235,0.03)] space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="text-xs font-bold text-slate-700">Nama Posyandu</label>
            <input type="text" name="nama" value="{{ old('nama', $unit->nama) }}" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm">
        </div>

        <div>
            <label class="text-xs font-bold text-slate-700">Kode Posyandu (opsional)</label>
            <input type="text" name="kode_posyandu" value="{{ old('kode_posyandu', $unit->kode_posyandu) }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm">
        </div>

        <div>
            <label class="text-xs font-bold text-slate-700">Wilayah</label>
            <input type="text" name="wilayah" value="{{ old('wilayah', $unit->wilayah) }}" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm">
        </div>

        <div>
            <label class="text-xs font-bold text-slate-700">Alamat</label>
            <textarea name="alamat" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm">{{ old('alamat', $unit->alamat) }}</textarea>
        </div>

        <div>
            <label class="text-xs font-bold text-slate-700">Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab', $unit->penanggung_jawab) }}" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm">
        </div>

        <div>
            <label class="text-xs font-bold text-slate-700">No. Telepon (opsional)</label>
            <input type="text" name="no_telepon" value="{{ old('no_telepon', $unit->no_telepon) }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-blue-700">Simpan Perubahan</button>
            <a href="{{ route('admin.unit-posyandu.index') }}" class="rounded-xl bg-slate-100 px-5 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-200">Batal</a>
        </div>
    </form>
</div>
@endsection