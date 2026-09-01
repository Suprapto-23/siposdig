@extends('layouts.app-kader')
@section('title', 'Input Pengukuran Fisik - SIPOSDIG')

@section('content')
<!-- Memuat Library UI Premium (Flatpickr & TomSelect) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

<div class="w-full max-w-4xl mx-auto space-y-6 pb-12 animate-fade-in-up">

    <!-- Premium Header -->
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('kader.pengukuran.index') }}" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-200 transition-all shadow-sm focus:outline-none hover:-translate-x-1 group">
            <svg class="w-6 h-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h2 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight">Input Pengukuran</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-0.5">Catat hasil pemeriksaan fisik warga secara detail.</p>
        </div>
    </div>

    <!-- Main Container Glassmorphism -->
    <div x-data="pengukuranForm()" class="bg-white/70 backdrop-blur-2xl border border-white rounded-[2rem] p-2 shadow-[0_8px_30px_rgba(0,0,0,0.03)] relative z-10">
        <div class="bg-white rounded-[1.75rem] p-6 sm:p-10 border border-slate-100/50">

            <!-- Kategori Segmented Control -->
            <form id="kategoriForm" method="GET" action="{{ route('kader.pengukuran.create') }}" class="mb-10">
                <label class="block text-[11px] font-black text-slate-400 mb-3 tracking-widest uppercase text-center sm:text-left">Pilih Sasaran Siklus Hidup</label>
                <div class="flex p-1.5 bg-slate-100/80 border border-slate-200/60 rounded-2xl overflow-x-auto custom-scrollbar shadow-inner">
                    <label class="flex-1 min-w-[120px] cursor-pointer relative">
                        <input type="radio" name="kategori" value="Balita" class="peer sr-only" onchange="document.getElementById('kategoriForm').submit()" {{ $kategoriAktif == 'Balita' ? 'checked' : '' }}>
                        <div class="w-full text-center py-3 rounded-xl peer-checked:bg-white peer-checked:text-blue-700 peer-checked:shadow-[0_2px_10px_rgba(0,0,0,0.05)] text-slate-500 font-bold text-sm transition-all duration-300">👶 Balita</div>
                    </label>
                    <label class="flex-1 min-w-[120px] cursor-pointer relative">
                        <input type="radio" name="kategori" value="Remaja" class="peer sr-only" onchange="document.getElementById('kategoriForm').submit()" {{ $kategoriAktif == 'Remaja' ? 'checked' : '' }}>
                        <div class="w-full text-center py-3 rounded-xl peer-checked:bg-white peer-checked:text-blue-700 peer-checked:shadow-[0_2px_10px_rgba(0,0,0,0.05)] text-slate-500 font-bold text-sm transition-all duration-300">👧 Remaja</div>
                    </label>
                    <label class="flex-1 min-w-[120px] cursor-pointer relative">
                        <input type="radio" name="kategori" value="Lansia" class="peer sr-only" onchange="document.getElementById('kategoriForm').submit()" {{ $kategoriAktif == 'Lansia' ? 'checked' : '' }}>
                        <div class="w-full text-center py-3 rounded-xl peer-checked:bg-white peer-checked:text-blue-700 peer-checked:shadow-[0_2px_10px_rgba(0,0,0,0.05)] text-slate-500 font-bold text-sm transition-all duration-300">👴 Lansia</div>
                    </label>
                </div>
            </form>

            <form method="POST" action="{{ route('kader.pengukuran.store') }}" @submit="isSubmitting = true" class="space-y-10">
                @csrf
                <input type="hidden" name="kategori_saat_ukur" value="{{ $kategoriAktif }}" x-model="kategori">

                <!-- ROW 1: Tanggal & Warga (PREMIUM UI) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50/50 p-6 rounded-[1.5rem] border border-slate-100">
                    <div class="relative">
                        <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Tanggal Pengukuran <span class="text-rose-500">*</span></label>
                        <!-- Premium Date Picker (Flatpickr) -->
                        <div class="relative">
                            <input type="text" id="tanggal_ukur" name="tanggal_ukur" value="{{ date('Y-m-d') }}" required class="block w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl text-sm font-bold text-slate-800 transition-all shadow-sm outline-none cursor-pointer">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Pilih Warga Binaan <span class="text-rose-500">*</span></label>
                        <!-- Premium Searchable Select (TomSelect) -->
                        <select id="warga_id" name="warga_id" required placeholder="Ketik nama / NIK warga..." autocomplete="off">
                            <option value="">Ketik nama / NIK warga...</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->id }}">{{ $w->nama_lengkap }} ({{ $w->nik }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- SECTION 1: ANTROPOMETRI DASAR -->
                <div>
                    <h3 class="text-sm font-black text-slate-800 mb-5 flex items-center gap-2">
                        <span class="flex items-center justify-center w-6 h-6 rounded-lg bg-blue-100 text-blue-600 text-xs">1</span> 
                        Pengukuran Dasar
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="relative group">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Berat Badan (BB)</label>
                            <div class="relative flex items-center">
                                <input type="number" step="0.1" name="berat_badan" x-model="bb" placeholder="0.0" class="peer block w-full pl-4 pr-12 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                <span class="absolute right-4 text-xs font-black text-slate-400 peer-focus:text-blue-500 transition-colors">kg</span>
                            </div>
                        </div>
                        <div class="relative group">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Tinggi Badan (TB)</label>
                            <div class="relative flex items-center">
                                <input type="number" step="0.1" name="tinggi_badan" x-model="tb" placeholder="0.0" class="peer block w-full pl-4 pr-12 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                <span class="absolute right-4 text-xs font-black text-slate-400 peer-focus:text-blue-500 transition-colors">cm</span>
                            </div>
                        </div>
                    </div>

                    <template x-if="kategori !== 'Balita'">
                        <div class="mt-6 p-5 bg-gradient-to-r from-blue-50 to-sky-50 border border-blue-100/50 rounded-2xl flex items-center justify-between shadow-sm">
                            <div><div class="text-blue-700 font-black text-sm tracking-wide">Indeks Massa Tubuh (IMT)</div><div class="text-[11px] font-medium text-blue-500 mt-0.5">Dihitung otomatis dari BB & TB</div></div>
                            <div class="px-5 py-2 bg-white rounded-xl border border-blue-100 shadow-[0_2px_10px_rgba(37,99,235,0.06)]"><span class="text-xl font-black text-blue-600" x-text="calculateIMT()"></span></div>
                        </div>
                    </template>
                </div>

                <!-- SECTION 2: BALITA (PREMIUM STUNTING CARDS) -->
                <template x-if="kategori === 'Balita'">
                    <div x-transition.opacity.duration.300ms>
                        <h3 class="text-sm font-black text-slate-800 mb-5 flex items-center gap-2">
                            <span class="flex items-center justify-center w-6 h-6 rounded-lg bg-emerald-100 text-emerald-600 text-xs">2</span> 
                            Tumbuh Kembang Balita
                        </h3>
                        <div class="mb-6 w-full sm:w-1/2">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Lingkar Kepala</label>
                            <div class="relative flex items-center">
                                <input type="number" step="0.1" name="lingkar_kepala" placeholder="0.0" class="peer block w-full pl-4 pr-12 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                <span class="absolute right-4 text-xs font-black text-slate-400 peer-focus:text-emerald-500 transition-colors">cm</span>
                            </div>
                        </div>

                        <!-- PENGGANTI DROPDOWN STUNTING: INTERACTIVE RADIO CARDS -->
                        <label class="block text-[11px] font-extrabold text-slate-500 mb-3 tracking-widest uppercase">Status Stunting (Hasil Cek KMS)</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status_stunting" value="normal" class="peer sr-only">
                                <div class="w-full text-center px-2 py-4 border border-slate-200 rounded-2xl peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-700 text-slate-500 bg-white hover:bg-slate-50 transition-all shadow-sm">
                                    <span class="text-sm font-bold block">Normal</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status_stunting" value="pendek" class="peer sr-only">
                                <div class="w-full text-center px-2 py-4 border border-slate-200 rounded-2xl peer-checked:bg-amber-50 peer-checked:border-amber-500 peer-checked:text-amber-700 text-slate-500 bg-white hover:bg-slate-50 transition-all shadow-sm">
                                    <span class="text-sm font-bold block">Pendek</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status_stunting" value="sangat_pendek" class="peer sr-only">
                                <div class="w-full text-center px-2 py-4 border border-slate-200 rounded-2xl peer-checked:bg-rose-50 peer-checked:border-rose-500 peer-checked:text-rose-700 text-slate-500 bg-white hover:bg-slate-50 transition-all shadow-sm">
                                    <span class="text-sm font-bold block">Sangat Pendek</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status_stunting" value="tinggi" class="peer sr-only">
                                <div class="w-full text-center px-2 py-4 border border-slate-200 rounded-2xl peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-700 text-slate-500 bg-white hover:bg-slate-50 transition-all shadow-sm">
                                    <span class="text-sm font-bold block">Tinggi</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </template>

                <!-- SECTION 2: REMAJA & LANSIA UMUM -->
                <template x-if="kategori !== 'Balita'">
                    <div x-transition.opacity.duration.300ms>
                        <h3 class="text-sm font-black text-slate-800 mb-5 flex items-center gap-2">
                            <span class="flex items-center justify-center w-6 h-6 rounded-lg bg-rose-100 text-rose-600 text-xs">2</span> 
                            Pemeriksaan Fisik Lanjutan
                        </h3>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-5">
                            <div class="relative group"><label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Tensi Sistol</label><input type="number" name="sistol" placeholder="120" class="block w-full pl-4 pr-3 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-rose-400 focus:ring-4 focus:ring-rose-400/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none"><span class="absolute bottom-[35px] right-2 text-[9px] font-black text-slate-300">mmHg</span></div>
                            <div class="relative group"><label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Tensi Diastol</label><input type="number" name="diastol" placeholder="80" class="block w-full pl-4 pr-3 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-rose-400 focus:ring-4 focus:ring-rose-400/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none"><span class="absolute bottom-[35px] right-2 text-[9px] font-black text-slate-300">mmHg</span></div>
                            
                            <div class="relative group">
                                <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Lingkar Perut</label>
                                <div class="relative flex items-center">
                                    <input type="number" step="0.1" name="lingkar_perut" placeholder="0.0" class="peer block w-full pl-4 pr-10 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-rose-400 focus:ring-4 focus:ring-rose-400/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                    <span class="absolute right-4 text-xs font-black text-slate-400 peer-focus:text-rose-500 transition-colors">cm</span>
                                </div>
                            </div>
                            <div class="relative group">
                                <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">LILA</label>
                                <div class="relative flex items-center">
                                    <input type="number" step="0.1" name="lila" placeholder="0.0" class="peer block w-full pl-4 pr-10 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-rose-400 focus:ring-4 focus:ring-rose-400/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                    <span class="absolute right-4 text-xs font-black text-slate-400 peer-focus:text-rose-500 transition-colors">cm</span>
                                </div>
                            </div>
                        </div>

                        <div class="w-full sm:w-1/2 md:w-1/4 relative group">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Hemoglobin (HB)</label>
                            <div class="relative flex items-center">
                                <input type="number" step="0.1" name="hemoglobin" placeholder="0.0" class="peer block w-full pl-4 pr-12 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-rose-400 focus:ring-4 focus:ring-rose-400/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                <span class="absolute right-4 text-[10px] font-black text-slate-400 peer-focus:text-rose-500 transition-colors">g/dL</span>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- SECTION 3: KHUSUS LANSIA -->
                <template x-if="kategori === 'Lansia'">
                    <div x-transition.opacity.duration.300ms class="pt-4">
                        <h3 class="text-sm font-black text-slate-800 mb-5 flex items-center gap-2">
                            <span class="flex items-center justify-center w-6 h-6 rounded-lg bg-purple-100 text-purple-600 text-xs">3</span> 
                            Laboratorium & Kemandirian
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                            <div class="relative group">
                                <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Gula Darah</label>
                                <div class="relative flex items-center">
                                    <input type="number" name="gula_darah" placeholder="0" class="peer block w-full pl-4 pr-14 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                    <span class="absolute right-4 text-[10px] font-black text-slate-400 peer-focus:text-purple-500 transition-colors">mg/dL</span>
                                </div>
                            </div>
                            <div class="relative group">
                                <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Kolesterol</label>
                                <div class="relative flex items-center">
                                    <input type="number" name="kolesterol" placeholder="0" class="peer block w-full pl-4 pr-14 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                    <span class="absolute right-4 text-[10px] font-black text-slate-400 peer-focus:text-purple-500 transition-colors">mg/dL</span>
                                </div>
                            </div>
                            <div class="relative group">
                                <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Asam Urat</label>
                                <div class="relative flex items-center">
                                    <input type="number" step="0.1" name="asam_urat" placeholder="0.0" class="peer block w-full pl-4 pr-14 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 rounded-2xl text-sm font-black text-slate-800 transition-all outline-none">
                                    <span class="absolute right-4 text-[10px] font-black text-slate-400 peer-focus:text-purple-500 transition-colors">mg/dL</span>
                                </div>
                            </div>
                        </div>

                        <!-- INTERACTIVE RADIO CARDS UNTUK LANSIA -->
                        <label class="block text-[11px] font-extrabold text-slate-500 mb-3 tracking-widest uppercase">Status Kemandirian (ADL)</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status_kemandirian" value="mandiri" class="peer sr-only">
                                <div class="w-full text-center p-4 border border-slate-200 rounded-2xl peer-checked:bg-purple-50 peer-checked:border-purple-500 peer-checked:text-purple-700 peer-checked:shadow-[0_2px_15px_rgba(168,85,247,0.1)] text-slate-500 bg-slate-50/50 hover:bg-white transition-all duration-300">
                                    <span class="text-sm font-bold block mb-1">Mandiri</span>
                                    <span class="text-[10px] font-medium opacity-80">Melakukan aktivitas sendiri</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status_kemandirian" value="bantuan_ringan" class="peer sr-only">
                                <div class="w-full text-center p-4 border border-slate-200 rounded-2xl peer-checked:bg-amber-50 peer-checked:border-amber-500 peer-checked:text-amber-700 peer-checked:shadow-[0_2px_15px_rgba(245,158,11,0.1)] text-slate-500 bg-slate-50/50 hover:bg-white transition-all duration-300">
                                    <span class="text-sm font-bold block mb-1">Bantuan Ringan</span>
                                    <span class="text-[10px] font-medium opacity-80">Butuh bantuan sebagian</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status_kemandirian" value="bantuan_penuh" class="peer sr-only">
                                <div class="w-full text-center p-4 border border-slate-200 rounded-2xl peer-checked:bg-rose-50 peer-checked:border-rose-500 peer-checked:text-rose-700 peer-checked:shadow-[0_2px_15px_rgba(244,63,94,0.1)] text-slate-500 bg-slate-50/50 hover:bg-white transition-all duration-300">
                                    <span class="text-sm font-bold block mb-1">Bantuan Penuh</span>
                                    <span class="text-[10px] font-medium opacity-80">Ketergantungan total</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </template>

                <!-- CATATAN BEBAS -->
                <div class="pt-2">
                    <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" rows="3" placeholder="Tuliskan keluhan, observasi, atau tindakan yang diberikan..." class="block w-full p-5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl text-sm font-medium text-slate-800 transition-all outline-none resize-none"></textarea>
                </div>

                <!-- Footer Submit -->
                <div class="pt-8 border-t border-slate-100 flex justify-end">
                    <button type="submit" :disabled="isSubmitting" class="w-full sm:w-auto bg-gradient-to-br from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-600 text-white font-bold text-sm py-4 px-12 rounded-[1.25rem] shadow-[0_8px_20px_-6px_rgba(37,99,235,0.5)] flex justify-center items-center gap-2 transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-500/30 disabled:opacity-70 disabled:cursor-not-allowed">
                        <span x-show="!isSubmitting">Simpan Pengukuran Fisik</span>
                        <svg x-show="isSubmitting" style="display:none;" class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Menyisipkan Script & CSS Kustom untuk TomSelect dan Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<script>
    // 1. Inisialisasi Alpine.js Logic
    function pengukuranForm() {
        return {
            isSubmitting: false,
            kategori: '{{ $kategoriAktif }}',
            bb: '', tb: '',
            calculateIMT() {
                if (this.bb && this.tb && this.tb > 0) {
                    return (this.bb / ((this.tb / 100) ** 2)).toFixed(1);
                }
                return '-';
            }
        }
    }

    // 2. Eksekusi Library UI Premium setelah halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        // Flatpickr untuk Tanggal (Kalender Membulat & Bahasa Indonesia)
        flatpickr("#tanggal_ukur", {
            locale: "id",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "j F Y",
            disableMobile: true // Memaksa UI premium muncul di HP
        });

        // TomSelect untuk Dropdown Warga (Searchable & Membulat)
        new TomSelect("#warga_id", {
            create: false,
            sortField: { field: "text", direction: "asc" },
            placeholder: "-- Ketik nama / NIK untuk mencari --",
            maxOptions: 50
        });
    });
</script>

<style>
    /* CSS Override agar Plugin menyatu sempurna dengan Desain Tailwind Rounded-2xl */
    
    /* TomSelect Override */
    .ts-control {
        border-radius: 1rem !important;
        padding: 0.875rem 1rem 0.875rem 1rem !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #ffffff !important;
        font-size: 0.875rem !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        transition: all 0.2s ease-in-out !important;
    }
    .ts-control.focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }
    .ts-wrapper.single .ts-control:after {
        right: 1.5rem !important;
    }
    .ts-dropdown {
        border-radius: 1.25rem !important;
        border: 1px solid #f1f5f9 !important;
        box-shadow: 0 10px 40px -10px rgba(37,99,235,0.15) !important;
        overflow: hidden;
        margin-top: 0.5rem !important;
    }
    .ts-dropdown .option {
        padding: 0.75rem 1.25rem !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        color: #475569 !important;
    }
    .ts-dropdown .active {
        background-color: #eff6ff !important;
        color: #2563eb !important;
    }

    /* Flatpickr Override */
    .flatpickr-calendar {
        border-radius: 1.5rem !important;
        border: none !important;
        box-shadow: 0 20px 40px -10px rgba(15,23,42,0.1) !important;
        padding: 0.5rem !important;
    }
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay {
        background: #3b82f6 !important;
        border-color: #3b82f6 !important;
        border-radius: 0.5rem !important;
        font-weight: bold !important;
    }
    .flatpickr-day {
        border-radius: 0.5rem !important;
    }
</style>
@endsection