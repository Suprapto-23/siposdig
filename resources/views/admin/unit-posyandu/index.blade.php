@extends('layouts.app-admin')
@section('title', 'Kelola Unit Posyandu - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-8">
    <div class="flex items-center justify-between bg-white p-6 rounded-3xl border border-slate-200/60 shadow-[0_4px_24px_rgba(37,99,235,0.03)]">
        <div>
            <h1 class="font-display text-2xl font-extrabold text-slate-900">Unit Posyandu</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola data wilayah operasional dan posyandu aktif secara terpadu.</p>
        </div>
        <a href="{{ route('admin.unit-posyandu.create') }}" class="rounded-2xl bg-blue-600 px-5 py-3 text-xs font-bold text-white shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition-all">
            + Tambah Unit
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-2xl bg-emerald-50 border border-emerald-200 px-5 py-3 text-xs font-semibold text-emerald-700">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="rounded-2xl bg-red-50 border border-red-200 px-5 py-3 text-xs font-semibold text-red-700">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-3xl border border-slate-200/60 shadow-[0_4px_24px_rgba(37,99,235,0.03)] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                    <th class="py-4 px-6">Nama Posyandu</th>
                    <th class="py-4 px-6">Wilayah</th>
                    <th class="py-4 px-6">Penanggung Jawab</th>
                    <th class="py-4 px-6 text-center">Kader</th>
                    <th class="py-4 px-6 text-center">Warga</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                @forelse($units as $item)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-6 font-bold text-slate-900">
                        {{ $item->nama }}
                        @if($item->kode_posyandu)
                            <span class="block text-[10px] font-normal text-slate-400">{{ $item->kode_posyandu }}</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">{{ $item->wilayah }}</td>
                    <td class="py-4 px-6">{{ $item->penanggung_jawab }}</td>
                    <td class="py-4 px-6 text-center">{{ $item->kader_count }}</td>
                    <td class="py-4 px-6 text-center">{{ $item->warga_count }}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.unit-posyandu.edit', $item->id) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 text-[10px] font-bold">Edit</a>
                            <form method="POST" action="{{ route('admin.unit-posyandu.destroy', $item->id) }}" onsubmit="return confirm('Hapus unit posyandu ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-[10px] font-bold">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="py-10 text-center text-slate-400">Belum ada unit posyandu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $units->links() }}
</div>
@endsection