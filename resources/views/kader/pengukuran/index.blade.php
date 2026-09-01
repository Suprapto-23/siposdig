@extends('layouts.app-kader')
@section('title', 'Riwayat Pengukuran Fisik - SIPOSDIG')
@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/60 backdrop-blur-xl border border-white/80 p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
        <div>
            <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 tracking-tight">Riwayat Pengukuran</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-1">Daftar rekam jejak pertumbuhan dan kesehatan warga binaan.</p>
        </div>
        <a href="{{ route('kader.pengukuran.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-500 text-white font-bold text-sm rounded-2xl shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] transition-all hover:-translate-y-0.5 w-full sm:w-auto focus:outline-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Input Pengukuran
        </a>
    </div>

    <!-- Filter & Search Panel -->
    <form method="GET" action="{{ route('kader.pengukuran.index') }}" class="flex flex-col sm:flex-row gap-4 items-center w-full relative z-40">
        
        <!-- Dropdown Native Vanilla JS -->
        <div class="relative w-full sm:w-56" id="dropdownKategoriUkur">
            <button type="button" onclick="toggleDropdownUkur()" class="flex items-center justify-between w-full pl-5 pr-4 py-3.5 bg-white/80 backdrop-blur-md border border-slate-200 hover:border-blue-300 focus:ring-4 focus:ring-blue-50 rounded-2xl text-sm font-bold text-slate-700 transition-all shadow-sm outline-none cursor-pointer">
                <div class="flex items-center gap-2.5 text-blue-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>{{ request('kategori') ? 'Kategori: ' . request('kategori') : 'Semua Kategori' }}</span>
                </div>
                <svg id="iconUkur" class="w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            
            <div id="menuUkur" class="hidden absolute top-full left-0 mt-2 w-full bg-white border border-slate-100 rounded-[1.25rem] shadow-[0_10px_40px_-10px_rgba(37,99,235,0.15)] py-2 flex flex-col z-50 overflow-hidden transform transition-all duration-200">
                @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                <button type="submit" name="kategori" value="" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors {{ request('kategori') == '' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Semua Kategori</button>
                <button type="submit" name="kategori" value="Balita" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('kategori') == 'Balita' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Balita</button>
                <button type="submit" name="kategori" value="Remaja" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('kategori') == 'Remaja' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Remaja</button>
                <button type="submit" name="kategori" value="Lansia" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('kategori') == 'Lansia' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Lansia</button>
            </div>
        </div>

        <div class="flex w-full sm:max-w-md relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau NIK warga..." 
                   class="block w-full pl-11 pr-4 py-3.5 bg-white/80 backdrop-blur-md border border-slate-200 focus:border-blue-500 rounded-2xl text-sm font-medium text-slate-800 transition-all shadow-sm outline-none">
        </div>
    </form>

    <!-- Data Tabel -->
    <div class="bg-white/80 backdrop-blur-xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] overflow-hidden relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-widest font-bold text-slate-400">
                        <th class="px-6 py-4 whitespace-nowrap">Tgl Ukur</th>
                        <th class="px-6 py-4 whitespace-nowrap">Profil Warga</th>
                        <th class="px-6 py-4 whitespace-nowrap">Kategori</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">BB / TB</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">Kondisi (IMT/Stunting)</th>
                        <th class="px-6 py-4 whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($pengukuran as $item)
                    <tr class="hover:bg-blue-50/30 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($item->tanggal_ukur)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50 to-sky-50 border border-blue-100 flex items-center justify-center text-blue-600 font-extrabold shrink-0 shadow-sm text-lg">
                                    {{ substr($item->warga->nama_lengkap ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">{{ $item->warga->nama_lengkap }}</p>
                                    <p class="text-[11px] font-semibold text-slate-400 font-mono mt-0.5">{{ $item->warga->nik }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-lg text-xs font-bold uppercase tracking-wider">{{ $item->kategori_saat_ukur }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-sm font-black text-slate-700">{{ $item->berat_badan ?? '-' }} <span class="text-[10px] font-bold text-slate-400">kg</span></span>
                                <span class="text-xs font-bold text-slate-500">{{ $item->tinggi_badan ?? '-' }} <span class="text-[10px] font-bold text-slate-400">cm</span></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($item->kategori_saat_ukur === 'Balita' && $item->status_stunting)
                                <span class="px-3 py-1.5 rounded-xl border text-xs font-bold 
                                    {{ $item->status_stunting == 'normal' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-rose-50 text-rose-600 border-rose-200' }}">
                                    Stunting: {{ ucfirst(str_replace('_', ' ', $item->status_stunting)) }}
                                </span>
                            @elseif(in_array($item->kategori_saat_ukur, ['Remaja', 'Lansia']) && $item->imt)
                                <span class="px-3 py-1.5 rounded-xl border bg-blue-50 text-blue-700 border-blue-200 text-xs font-bold">
                                    IMT: {{ $item->imt }}
                                </span>
                            @else
                                <span class="text-xs text-slate-400 font-medium">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('kader.pengukuran.show', $item->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-blue-600 hover:bg-blue-50 transition-colors focus:outline-none" title="Lihat Rekam Medis">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4"><svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                                <p class="text-sm font-bold text-slate-600">Belum Ada Data Pengukuran.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengukuran->hasPages()) 
        <div class="px-6 py-4 border-t border-slate-100 bg-white premium-pagination">{{ $pengukuran->links() }}</div> 
        @endif
    </div>
</div>

<script>
    function toggleDropdownUkur() {
        const menu = document.getElementById('menuUkur');
        const icon = document.getElementById('iconUkur');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            menu.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('dropdownKategoriUkur');
        const menu = document.getElementById('menuUkur');
        const icon = document.getElementById('iconUkur');
        if (dropdown && !dropdown.contains(event.target)) {
            menu.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    });
</script>

<style>
    .premium-pagination nav p { display: none; }
    .premium-pagination nav div.hidden.sm\:flex-1 { display: flex !important; justify-content: center !important; }
    .premium-pagination nav span.relative.inline-flex.items-center { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .premium-pagination nav a, .premium-pagination nav span[aria-disabled] { padding: 10px 16px !important; font-size: 13px !important; font-weight: 700 !important; color: #64748b; background-color: #ffffff; border-color: #f1f5f9; transition: all 0.2s; }
    .premium-pagination nav a:hover { background-color: #eff6ff; color: #2563eb; }
    .premium-pagination nav span[aria-current="page"] span { background-color: #3b82f6 !important; color: #ffffff !important; border-color: #3b82f6 !important; }
</style>
@endsection