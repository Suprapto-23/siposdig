@extends('layouts.app-admin')

@section('title', 'Verifikasi Akun - SIPOSDIG')

@section('content')
<!-- Memuat SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Komponen Utama dikelola oleh Alpine.js -->
<div x-data="verifikasiAkun()" x-init="init()" class="w-full max-w-7xl mx-auto space-y-6">

    <!-- Header & Filter Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-200/60 shadow-sm relative z-20">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900 tracking-tight">Verifikasi Akun Warga</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola dan verifikasi pendaftaran akun warga baru sebelum diberikan akses sistem.</p>
        </div>
        
        <!-- Filter/Search (Anti Reload) -->
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
            
            <!-- Custom Search Input -->
            <div class="relative w-full sm:w-64 group">
                <svg class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" 
                       x-model="search" 
                       @input.debounce.500ms="fetchData()" 
                       placeholder="Cari NIK atau Nama..." 
                       class="pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none w-full transition-all text-slate-700 placeholder-slate-400">
                
                <!-- Loading Spinner Search -->
                <svg x-show="isLoading" class="animate-spin absolute right-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            </div>

            <!-- Custom Premium Dropdown Alpine.js -->
            <div class="relative w-full sm:w-56" x-data="{ dropdownOpen: false }">
                <button @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false" type="button" class="w-full flex items-center justify-between py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 hover:bg-slate-100 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all text-left">
                    <span class="flex items-center gap-2 font-medium">
                        <span class="w-2 h-2 rounded-full" 
                              :class="{'bg-amber-500': status === 'pending', 'bg-emerald-500': status === 'aktif', 'bg-rose-500': status === 'ditolak'}"></span>
                        <span x-text="statusLabel"></span>
                    </span>
                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="dropdownOpen" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-2"
                     class="absolute top-full mt-2 w-full bg-white border border-slate-100 rounded-2xl shadow-xl overflow-hidden z-50 p-1" style="display: none;">
                    
                    <button @click="setStatus('pending', 'Menunggu (Pending)'); dropdownOpen = false" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors" :class="status === 'pending' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-50'">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span> Menunggu (Pending)
                    </button>
                    <button @click="setStatus('aktif', 'Disetujui (Aktif)'); dropdownOpen = false" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors mt-1" :class="status === 'aktif' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-50'">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Disetujui (Aktif)
                    </button>
                    <button @click="setStatus('ditolak', 'Ditolak'); dropdownOpen = false" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors mt-1" :class="status === 'ditolak' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-50'">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span> Ditolak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Wrapper Tabel Anti-Reload -->
    <div class="relative bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden z-10" id="table-wrapper">
        
        <!-- Overlay Loading saat Ajax -->
        <div x-show="isLoading" class="absolute inset-0 bg-white/60 backdrop-blur-[2px] z-20 flex items-center justify-center" style="display: none;">
            <div class="px-4 py-2 bg-white rounded-xl shadow-lg border border-slate-100 flex items-center gap-3 text-sm font-bold text-slate-600">
                <svg class="animate-spin w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Memuat data...
            </div>
        </div>

        <div id="table-content">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-[11px] uppercase tracking-widest text-slate-500 font-bold">
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">NIK</th>
                            <th class="px-6 py-4">Informasi Tambahan</th>
                            <th class="px-6 py-4">Tanggal Daftar</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        
                        @forelse($antreanWarga ?? [] as $warga)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <!-- Nama -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $warga->nama_lengkap }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }} • {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->age }} Tahun</div>
                            </td>
                            <!-- NIK (Tabular Nums) -->
                            <td class="px-6 py-4">
                                <span class="font-mono text-slate-700 tabular-nums tracking-tight bg-slate-100 px-2 py-1 rounded-md text-xs border border-slate-200/60">{{ $warga->nik }}</span>
                            </td>
                            <!-- Posyandu & Alamat -->
                            <td class="px-6 py-4">
                                <div class="text-slate-900 font-medium line-clamp-1">{{ $warga->unitPosyandu->nama ?? '-' }}</div>
                                <div class="text-xs text-slate-500 mt-0.5 line-clamp-1" title="{{ $warga->alamat }}">{{ $warga->alamat }}</div>
                            </td>
                            <!-- Tanggal -->
                            <td class="px-6 py-4 text-slate-600 tabular-nums text-xs">
                                {{ $warga->created_at->format('d M Y, H:i') }}
                            </td>
                            <!-- Status -->
                            <td class="px-6 py-4">
                                @if($warga->status == 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-amber-50 text-amber-600 border border-amber-200/50">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu
                                    </span>
                                @elseif($warga->status == 'aktif')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200/50">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg> Ditolak
                                    </span>
                                @endif
                            </td>
                            <!-- Aksi -->
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    @if($warga->status == 'pending')
                                        <form id="form-approve-{{ $warga->id }}" action="{{ route('admin.verifikasi.approve', $warga->id) }}" method="POST" class="inline-block">
                                            @csrf @method('PATCH')
                                            <!-- Tombol panggil fungsi di luar Alpine -->
                                            <button type="button" onclick="window.confirmApprove('{{ $warga->id }}', '{{ $warga->nama_lengkap }}')" title="Setujui Akun" class="p-2 text-emerald-600 bg-emerald-50 hover:bg-emerald-100 rounded-xl transition-colors border border-emerald-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </form>

                                        <form id="form-reject-{{ $warga->id }}" action="{{ route('admin.verifikasi.reject', $warga->id) }}" method="POST" class="inline-block">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="catatan_admin" id="catatan-{{ $warga->id }}">
                                            <button type="button" onclick="window.confirmReject('{{ $warga->id }}', '{{ $warga->nama_lengkap }}')" title="Tolak Pendaftaran" class="p-2 text-rose-500 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors border border-rose-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <button type="button" title="Lihat Detail" class="p-2 text-slate-500 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors border border-slate-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-3 border border-slate-100">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <p class="font-bold text-slate-600">Tidak ada antrean</p>
                                    <p class="text-sm text-slate-400 mt-1">Belum ada data warga dengan status tersebut.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            @if(isset($antreanWarga) && $antreanWarga->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-between">
                {{ $antreanWarga->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- SCRIPT: LOGIKA AJAX & ALERT PREMIUM        -->
<!-- ========================================== -->
<script>
    // 1. Konfigurasi SweetAlert2 "FULL SELAYAR" Premium
    const swalPremium = Swal.mixin({
        backdrop: `rgba(15, 23, 42, 0.85)`, // Dark slate background overlay (layar penuh gelap)
        buttonsStyling: false,
        customClass: {
            popup: 'bg-white rounded-3xl shadow-2xl p-6 sm:p-8',
            title: 'font-display text-2xl font-bold text-slate-900',
            htmlContainer: 'text-slate-600 text-sm mt-3',
            confirmButton: 'rounded-xl px-6 py-3 font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors w-full sm:w-auto',
            cancelButton: 'rounded-xl px-6 py-3 font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors mt-3 sm:mt-0 sm:ml-3 w-full sm:w-auto',
            actions: 'w-full flex-col sm:flex-row mt-8',
            input: 'w-full rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 text-sm p-4 mt-4 outline-none transition-all shadow-sm'
        }
    });

    // 2. Logika Component Alpine.js (AJAX Anti-Reload)
    function verifikasiAkun() {
        return {
            search: '{{ request('search') }}',
            status: '{{ request('status', 'pending') }}',
            statusLabel: 'Menunggu (Pending)',
            isLoading: false,

            init() {
                // Set label awal sesuai parameter URL
                if (this.status === 'aktif') this.statusLabel = 'Disetujui (Aktif)';
                if (this.status === 'ditolak') this.statusLabel = 'Ditolak';
            },

            setStatus(val, label) {
                this.status = val;
                this.statusLabel = label;
                this.fetchData();
            },

            // Fungsi inti anti-reload (Mengambil halaman lalu memotong bagian tabelnya saja)
            fetchData() {
                this.isLoading = true;
                const url = new URL(window.location.origin + window.location.pathname);
                if (this.search) url.searchParams.set('search', this.search);
                url.searchParams.set('status', this.status);

                // Update URL browser diam-diam tanpa reload
                window.history.pushState({}, '', url);

                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        // Timpa isi tabel lama dengan tabel hasil fetch
                        document.getElementById('table-content').innerHTML = doc.getElementById('table-content').innerHTML;
                    })
                    .catch(err => console.error('Gagal mengambil data', err))
                    .finally(() => { this.isLoading = false; });
            }
        }
    }

    // 3. Panggilan Alert Konfirmasi (Setujui / Tolak)
    window.confirmApprove = function(id, nama) {
        swalPremium.fire({
            title: 'Setujui Akun Warga?',
            html: `Memberikan akses login untuk <b class="text-slate-900">${nama}</b>.<br>Sistem akan membuatkan password otomatis secara acak.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Setujui Sekarang',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#2563EB'
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('form-approve-' + id).submit();
        });
    }

    window.confirmReject = function(id, nama) {
        swalPremium.fire({
            title: 'Tolak Pendaftaran?',
            html: `Berikan alasan mengapa pendaftaran <b class="text-slate-900">${nama}</b> ditolak. Alasan ini akan tercatat dalam sistem.`,
            input: 'textarea', // Textarea agar lebih premium dan luas
            inputPlaceholder: 'Ketik alasan penolakan di sini...',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tolak Pendaftaran',
            cancelButtonText: 'Batal',
            customClass: {
                ...swalPremium.params.customClass,
                confirmButton: 'rounded-xl px-6 py-3 font-bold bg-rose-500 hover:bg-rose-600 text-white transition-colors w-full sm:w-auto',
                input: 'w-full rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500 text-sm p-4 mt-4 h-24 resize-none'
            },
            inputValidator: (value) => {
                if (!value) return 'Alasan penolakan tidak boleh kosong!'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('catatan-' + id).value = result.value;
                document.getElementById('form-reject-' + id).submit();
            }
        });
    }

    // 4. Alert Sukses / Password Muncul Setelah Halaman Ter-refresh (Submit Form)
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('generated_password'))
            swalPremium.fire({
                icon: 'success',
                title: 'Verifikasi Berhasil!',
                html: `
                    <p class="text-slate-600 mb-5">Pendaftaran warga disetujui. Berikan password ini kepada warga yang bersangkutan secara aman.</p>
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 text-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-50 bg-[radial-gradient(circle_at_20%_20%,_#DBEAFE_0%,_transparent_50%)]"></div>
                        <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-2 relative z-10">Kredensial Sekali Pakai</p>
                        <p class="text-4xl font-mono font-bold text-slate-900 tracking-wider relative z-10" id="genPassword">{{ session('generated_password') }}</p>
                    </div>
                    <p class="text-xs text-rose-500 mt-4 font-bold flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Pastikan Anda menyalinnya sekarang!
                    </p>
                `,
                confirmButtonText: 'Salin Password & Selesai',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.clipboard.writeText("{{ session('generated_password') }}");
                    Swal.fire({
                        toast: true, position: 'top-end', showConfirmButton: false, timer: 3000,
                        icon: 'success', title: 'Tersalin ke clipboard!', customClass: { popup: 'rounded-xl shadow-lg border border-slate-100' }
                    });
                }
            });
        @elseif(session('success'))
            Swal.fire({
                toast: true, position: 'top-end', showConfirmButton: false, timer: 3000,
                icon: 'success', title: '{{ session('success') }}', customClass: { popup: 'rounded-xl shadow-lg border border-slate-100' }
            });
        @elseif(session('error'))
            Swal.fire({
                toast: true, position: 'top-end', showConfirmButton: false, timer: 4000,
                icon: 'error', title: '{{ session('error') }}', customClass: { popup: 'rounded-xl shadow-lg border border-slate-100' }
            });
        @endif
    });
</script>
@endsection