@extends('layouts.app-kader')
@section('title', 'Kelola Warga Binaan - SIPOSDIG')

@section('content')
<div class="space-y-6 pb-8 animate-fade-in-up">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/60 backdrop-blur-xl border border-white/80 p-6 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
        <div>
            <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 tracking-tight">Warga Binaan</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-1">Kelola data induk, profil, dan status keaktifan warga di Unit Posyandu Anda.</p>
        </div>
        <a href="{{ route('kader.warga.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-500 text-white font-bold text-sm rounded-2xl shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] transition-all hover:-translate-y-0.5 w-full sm:w-auto focus:outline-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Tambah Warga Baru
        </a>
    </div>

    <!-- Handle Notifikasi Sukses -->
    @if(session('success'))
    <div class="px-5 py-4 bg-emerald-50 border border-emerald-200 text-emerald-600 font-bold rounded-2xl flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Filter & Search Panel -->
    <form method="GET" action="{{ route('kader.warga.index') }}" class="flex flex-col sm:flex-row gap-4 items-center w-full relative z-40">
        
        <!-- Filter Kategori (Native JS) -->
        <div class="relative w-full sm:w-48" id="dropdownKategoriWarga">
            <button type="button" onclick="toggleKategori()" class="flex items-center justify-between w-full pl-5 pr-4 py-3.5 bg-white/80 backdrop-blur-md border border-slate-200 hover:border-blue-300 rounded-2xl text-sm font-bold text-slate-700 transition-all shadow-sm outline-none cursor-pointer">
                <span>{{ request('kategori') ?: 'Semua Kategori' }}</span>
                <svg id="iconKategori" class="w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div id="menuKategoriWarga" class="hidden absolute top-full left-0 mt-2 w-full bg-white border border-slate-100 rounded-[1.25rem] shadow-[0_10px_40px_-10px_rgba(37,99,235,0.15)] py-2 flex flex-col z-50 overflow-hidden transform transition-all duration-200">
                @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                <button type="submit" name="kategori" value="" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors {{ request('kategori') == '' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Semua Kategori</button>
                <button type="submit" name="kategori" value="Balita" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('kategori') == 'Balita' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Balita</button>
                <button type="submit" name="kategori" value="Remaja" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('kategori') == 'Remaja' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Remaja</button>
                <button type="submit" name="kategori" value="Lansia" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('kategori') == 'Lansia' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Lansia</button>
            </div>
        </div>

        <!-- Filter Status (Native JS) -->
        <div class="relative w-full sm:w-48" id="dropdownStatusWarga">
            <button type="button" onclick="toggleStatus()" class="flex items-center justify-between w-full pl-5 pr-4 py-3.5 bg-white/80 backdrop-blur-md border border-slate-200 hover:border-blue-300 rounded-2xl text-sm font-bold text-slate-700 transition-all shadow-sm outline-none cursor-pointer">
                <span>{{ request('status') ? ucfirst(request('status')) : 'Semua Status' }}</span>
                <svg id="iconStatus" class="w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div id="menuStatusWarga" class="hidden absolute top-full left-0 mt-2 w-full bg-white border border-slate-100 rounded-[1.25rem] shadow-[0_10px_40px_-10px_rgba(37,99,235,0.15)] py-2 flex flex-col z-50 overflow-hidden transform transition-all duration-200">
                <button type="submit" name="status" value="" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors {{ request('status') == '' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Semua Status</button>
                <button type="submit" name="status" value="aktif" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('status') == 'aktif' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Aktif</button>
                <button type="submit" name="status" value="pending" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('status') == 'pending' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Pending</button>
                <button type="submit" name="status" value="nonaktif" class="w-full text-left px-5 py-3 text-sm font-semibold transition-colors border-t border-slate-50 {{ request('status') == 'nonaktif' ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">Nonaktif</button>
            </div>
        </div>

        <div class="flex w-full sm:max-w-md relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau NIK warga..." class="block w-full pl-11 pr-4 py-3.5 bg-white/80 backdrop-blur-md border border-slate-200 focus:border-blue-500 rounded-2xl text-sm font-medium text-slate-800 transition-all shadow-sm outline-none">
        </div>
    </form>

    <!-- Data Tabel -->
    <div class="bg-white/80 backdrop-blur-xl border border-slate-100 rounded-[2rem] shadow-[0_8px_30px_rgba(37,99,235,0.04)] overflow-hidden relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse min-w-[950px]">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-widest font-bold text-slate-400">
                        <th class="px-6 py-4 whitespace-nowrap">Profil Warga</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">Kategori</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">L/P</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">Umur Aktual</th>
                        <th class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="group relative inline-flex items-center justify-center cursor-help">
                                Status Layanan
                                <svg class="w-3 h-3 ml-1 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 9a1 1 0 012 0v4a1 1 0 11-2 0V9zm1-4a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/></svg>
                                <div class="absolute bottom-full mb-2 hidden group-hover:block w-48 p-2 bg-slate-800 text-white text-[10px] rounded-lg shadow-lg z-50 text-left normal-case tracking-normal">
                                    <b>Aktif:</b> Menerima layanan.<br><b>Pending:</b> Belum diverifikasi.<br><b>Nonaktif:</b> Pindah/Meninggal.
                                </div>
                            </div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap text-right">Aksi Kelola</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($warga as $item)
                        @php
                            $tglLahir = \Carbon\Carbon::parse($item->tanggal_lahir);
                            $umurBulan = intval($tglLahir->diffInMonths(now()));
                            $umurTahun = intval($tglLahir->age);
                            $teksUmur = $item->kategori == 'Balita' ? $umurBulan . ' Bulan' : $umurTahun . ' Tahun';
                        @endphp
                    <tr class="hover:bg-blue-50/30 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-extrabold shrink-0 shadow-sm text-lg">
                                    {{ substr($item->nama_lengkap ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">{{ $item->nama_lengkap }}</p>
                                    <p class="text-[11px] font-semibold text-slate-400 font-mono mt-0.5">NIK: {{ $item->nik }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-lg text-xs font-bold uppercase tracking-wider">{{ $item->kategori }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-black {{ $item->jenis_kelamin == 'L' ? 'text-blue-500' : 'text-rose-500' }}">{{ $item->jenis_kelamin }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-black text-slate-700">{{ $teksUmur }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($item->status === 'aktif')
                                <span class="px-3 py-1.5 rounded-xl border bg-emerald-50 text-emerald-600 border-emerald-200 text-xs font-bold">Aktif</span>
                            @elseif($item->status === 'pending')
                                <span class="px-3 py-1.5 rounded-xl border bg-amber-50 text-amber-600 border-amber-200 text-xs font-bold">Pending</span>
                            @else
                                <span class="px-3 py-1.5 rounded-xl border bg-slate-50 text-slate-500 border-slate-200 text-xs font-bold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('kader.warga.show', $item->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors" title="Lihat Profil">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('kader.warga.edit', $item->id) }}" class="p-2 text-amber-500 hover:bg-amber-50 hover:text-amber-700 rounded-lg transition-colors" title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('kader.warga.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('PERINGATAN KRITIS!\n\nMenghapus data ini akan menghapus seluruh:\n- Riwayat Absensi Kehadiran\n- Riwayat Pengukuran Fisik\n\nTetap hapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-rose-400 hover:bg-rose-50 hover:text-rose-600 rounded-lg transition-colors" title="Hapus Permanen">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4"><svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg></div>
                                <p class="text-sm font-bold text-slate-600">Tidak ada data warga ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION PREMIUM MODERN MEMBULAT -->
        @if($warga->hasPages()) 
        <div class="px-6 py-5 border-t border-slate-100 bg-white flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs font-bold text-slate-500">
                Menampilkan <span class="text-blue-600">{{ $warga->firstItem() }}</span> - <span class="text-blue-600">{{ $warga->lastItem() }}</span> dari <span class="text-slate-800">{{ $warga->total() }}</span> warga
            </div>
            <div class="premium-pagination">
                {{ $warga->onEachSide(1)->links() }}
            </div>
        </div> 
        @endif
    </div>
</div>

<script>
    function toggleKategori() {
        document.getElementById('menuKategoriWarga').classList.toggle('hidden');
        document.getElementById('iconKategori').classList.toggle('rotate-180');
        document.getElementById('menuStatusWarga').classList.add('hidden'); 
    }
    function toggleStatus() {
        document.getElementById('menuStatusWarga').classList.toggle('hidden');
        document.getElementById('iconStatus').classList.toggle('rotate-180');
        document.getElementById('menuKategoriWarga').classList.add('hidden'); 
    }
    document.addEventListener('click', function(event) {
        if (!document.getElementById('dropdownKategoriWarga').contains(event.target)) {
            document.getElementById('menuKategoriWarga').classList.add('hidden');
            document.getElementById('iconKategori').classList.remove('rotate-180');
        }
        if (!document.getElementById('dropdownStatusWarga').contains(event.target)) {
            document.getElementById('menuStatusWarga').classList.add('hidden');
            document.getElementById('iconStatus').classList.remove('rotate-180');
        }
    });
</script>

<!-- STYLING CSS UNTUK OVERRIDE PAGINATION (PERFECT CIRCLE PREMIUM) -->
<style>
    /* 1. Sembunyikan elemen mobile bawaan Laravel */
    .premium-pagination > nav > div:first-child { display: none !important; }

    /* 2. Tata letak kontainer desktop ke kanan */
    .premium-pagination > nav > div:last-child { display: flex !important; justify-content: flex-end !important; width: 100%; }

    /* 3. Sembunyikan teks "Showing X to Y" bawaan laravel di dalam nav */
    .premium-pagination > nav > div:last-child > div:first-child { display: none !important; }

    /* 4. Bersihkan kotak pembungkus angka */
    .premium-pagination nav span.relative.z-0.inline-flex {
        box-shadow: none !important;
        border: none !important;
        gap: 0.5rem !important; /* Jarak antar tombol */
    }

    /* 5. LINGKARAN SEMPURNA: Angka & Tombol Prev/Next */
    .premium-pagination nav a, 
    .premium-pagination nav span[aria-disabled],
    .premium-pagination nav span[aria-current="page"] > span {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important; /* Membulat Sempurna */
        font-size: 14px !important;
        font-weight: 800 !important;
        color: #64748b !important;
        background-color: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        padding: 0 !important;
        margin: 0 !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02) !important;
        transition: all 0.2s ease !important;
    }

    /* 6. MUSNAHKAN KOTAK INTERNAL (Solusi untuk gambar Anda) */
    .premium-pagination nav a > span, 
    .premium-pagination nav span[aria-disabled] > span {
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 100% !important;
    }

    /* Efek Hover */
    .premium-pagination nav a:hover {
        background-color: #eff6ff !important;
        color: #2563eb !important;
        border-color: #bfdbfe !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(37,99,235,0.1) !important;
    }

    /* State Aktif (Current Page) */
    .premium-pagination nav span[aria-current="page"] > span {
        background: linear-gradient(135deg, #3b82f6, #0ea5e9) !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.4) !important;
    }

    /* Disabled state (Panah saat mentok) */
    .premium-pagination nav span[aria-disabled] {
        opacity: 0.5 !important;
        cursor: not-allowed !important;
        background-color: #f8fafc !important;
    }

    /* Memastikan Icon SVG panah proporsional */
    .premium-pagination nav svg {
        width: 20px !important;
        height: 20px !important;
        margin: 0 !important;
    }
</style>
@endsection