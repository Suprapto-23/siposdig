@extends('layouts.app-admin')
@section('title', 'Kelola Unit Posyandu - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up">
    <div class="flex items-center justify-between bg-white p-6 rounded-3xl border border-slate-200/60 shadow-[0_4px_24px_rgba(37,99,235,0.03)]">
        <div>
            <h1 class="font-display text-2xl font-extrabold text-slate-900">Unit Posyandu</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola data wilayah operasional dan posyandu aktif secara terpadu.</p>
        </div>
        <a href="{{ route('admin.unit-posyandu.create') }}" class="rounded-2xl bg-blue-600 px-5 py-3 text-xs font-bold text-white shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition-all">
            + Tambah Unit
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200/60 shadow-[0_4px_24px_rgba(37,99,235,0.03)] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                    <th class="py-4 px-6">Nama Posyandu</th>
                    <th class="py-4 px-6">Wilayah (RW/RT)</th>
                    <th class="py-4 px-6">Alamat</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                @forelse($unitPosyandus as $item)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-6 font-bold text-slate-900">{{ $item->nama_posyandu }}</td>
                    <td class="py-4 px-6">RW {{ $item->rw }} / RT {{ $item->rt ?? '-' }}</td>
                    <td class="py-4 px-6 text-slate-500">{{ Str::limit($item->alamat, 40) }}</td>
                    <td class="py-4 px-6 text-center space-x-2">
                        <a href="{{ route('admin.unit-posyandu.show', $item->id) }}" class="text-blue-600 font-bold hover:underline">Detail</a>
                        <a href="{{ route('admin.unit-posyandu.edit', $item->id) }}" class="text-sky-600 font-bold hover:underline">Edit</a>
                        <form action="{{ route('admin.unit-posyandu.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data unit ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-bold hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-slate-400">Belum ada data unit posyandu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-slate-100">
            {{ $unitPosyandus->links() }}
        </div>
    </div>
</div>
@endsection