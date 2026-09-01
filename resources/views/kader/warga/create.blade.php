@extends('layouts.app-kader')
@section('title', 'Tambah Warga Binaan - SIPOSDIG')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="w-full max-w-3xl mx-auto space-y-6 pb-12 animate-fade-in-up">

    <div class="flex items-center gap-4 mb-4">
        <a href="{{ route('kader.warga.index') }}" class="w-12 h-12 flex items-center justify-center bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all shadow-sm focus:outline-none hover:-translate-x-1"><svg class="w-6 h-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg></a>
        <div>
            <h2 class="font-jakarta text-2xl font-black text-slate-800 tracking-tight">Daftarkan Warga Baru</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-0.5">Lengkapi identitas warga sesuai dengan Kartu Keluarga (KK).</p>
        </div>
    </div>

    <!-- Handle Error Validasi Laravel -->
    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl">
            <div class="flex items-center gap-2 mb-2 text-rose-600 font-bold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pendaftaran Gagal
            </div>
            <ul class="list-disc list-inside pl-5 text-sm text-rose-500 font-medium">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white/70 backdrop-blur-2xl border border-white rounded-[2rem] p-2 shadow-[0_8px_30px_rgba(0,0,0,0.03)]">
        <div class="bg-white rounded-[1.75rem] p-6 sm:p-10 border border-slate-100/50">

            <form method="POST" action="{{ route('kader.warga.store') }}" class="space-y-8" onsubmit="document.getElementById('btnSubmit').disabled=true; document.getElementById('btnText').innerHTML='Menyimpan...';">
                @csrf

                <!-- SECTION 1: Identitas Inti -->
                <div>
                    <h3 class="text-sm font-black text-slate-800 mb-5 border-b border-slate-100 pb-3">Informasi Identitas</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="relative">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Nomor Induk Kependudukan (NIK) <span class="text-rose-500">*</span></label>
                            <input type="text" name="nik" value="{{ old('nik') }}" required placeholder="16 Digit NIK" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').substring(0, 16);" class="block w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl text-base font-black text-slate-800 transition-all outline-none font-mono tracking-widest">
                            <p class="text-[10px] text-slate-400 mt-1.5 font-semibold">Sistem akan menolak pendaftaran jika NIK kurang atau lebih dari 16 angka.</p>
                        </div>
                        <div class="relative">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Nama Lengkap Sesuai KK <span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Contoh: Ahmad Hidayatullah" class="block w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl text-sm font-bold text-slate-800 transition-all outline-none">
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Demografi -->
                <div>
                    <h3 class="text-sm font-black text-slate-800 mb-5 border-b border-slate-100 pb-3 mt-8">Demografi & Klasifikasi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Tanggal Lahir <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <input type="text" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="block w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl text-sm font-bold text-slate-800 transition-all shadow-sm outline-none cursor-pointer">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-blue-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Jenis Kelamin <span class="text-rose-500">*</span></label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="jenis_kelamin" value="L" class="peer sr-only" required {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                    <div class="w-full text-center py-3 border border-slate-200 rounded-2xl peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-700 text-slate-500 bg-slate-50/50 hover:bg-white transition-all"><span class="text-sm font-bold">👨 Laki-Laki</span></div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="jenis_kelamin" value="P" class="peer sr-only" required {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                    <div class="w-full text-center py-3 border border-slate-200 rounded-2xl peer-checked:bg-rose-50 peer-checked:border-rose-500 peer-checked:text-rose-700 text-slate-500 bg-slate-50/50 hover:bg-white transition-all"><span class="text-sm font-bold">👩 Perempuan</span></div>
                                </label>
                            </div>
                        </div>

                        <div class="relative md:col-span-2">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Klasifikasi Umur (Kategori Posyandu) <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="kategori" required class="block w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 rounded-2xl text-sm font-bold text-slate-800 transition-all outline-none appearance-none cursor-pointer">
                                    <option value="" disabled selected>-- Sesuaikan dengan rentang umur warga --</option>
                                    <option value="Balita" {{ old('kategori') == 'Balita' ? 'selected' : '' }}>Bayi & Balita (0 - 59 Bulan)</option>
                                    <option value="Remaja" {{ old('kategori') == 'Remaja' ? 'selected' : '' }}>Remaja (10 - 18 Tahun)</option>
                                    <option value="Lansia" {{ old('kategori') == 'Lansia' ? 'selected' : '' }}>Lansia (Di atas 60 Tahun)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: Kontak & Status -->
                <div>
                    <h3 class="text-sm font-black text-slate-800 mb-5 border-b border-slate-100 pb-3 mt-8">Kontak & Status Binaan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative md:col-span-2">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Alamat Domisili <span class="text-rose-500">*</span></label>
                            <textarea name="alamat" required rows="2" placeholder="Nama Jalan, RT/RW, Dusun..." class="block w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 rounded-2xl text-sm font-bold text-slate-800 transition-all outline-none resize-none">{{ old('alamat') }}</textarea>
                        </div>
                        
                        <div class="relative">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Nomor WhatsApp Aktif</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 08123456789" class="block w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 rounded-2xl text-sm font-bold text-slate-800 transition-all outline-none">
                        </div>

                        <div class="relative">
                            <label class="block text-[11px] font-extrabold text-slate-500 mb-2 tracking-widest uppercase">Status Layanan <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="status" required class="block w-full px-4 py-3.5 bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-blue-500 rounded-2xl text-sm font-bold text-slate-800 transition-all outline-none appearance-none cursor-pointer">
                                    <option value="aktif" selected>Aktif (Siap Menerima Pelayanan)</option>
                                    <option value="pending">Pending (Menunggu Konfirmasi/Pindah)</option>
                                    <option value="nonaktif">Nonaktif (Meninggal/Pindah Keluar)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-100 flex justify-end">
                    <button type="submit" id="btnSubmit" class="w-full sm:w-auto bg-gradient-to-br from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-600 text-white font-bold text-sm py-4 px-12 rounded-[1.25rem] shadow-[0_8px_20px_-6px_rgba(37,99,235,0.5)] transition-all hover:-translate-y-0.5 focus:outline-none">
                        <span id="btnText">Simpan & Daftarkan Warga</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#tanggal_lahir", {
            locale: "id",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "j F Y",
            maxDate: "today",
            disableMobile: true
        });
    });
</script>
<style>
    .flatpickr-calendar { border-radius: 1.5rem !important; border: none !important; box-shadow: 0 20px 40px -10px rgba(15,23,42,0.1) !important; padding: 0.5rem !important; }
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay { background: #3b82f6 !important; border-color: #3b82f6 !important; border-radius: 0.5rem !important; font-weight: bold !important; }
    .flatpickr-day { border-radius: 0.5rem !important; }
</style>
@endsection