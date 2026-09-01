<x-layouts.guest>
    <!-- Background Animasi Premium (Monochromatic Blue Mesh) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10 bg-[#F0F6FB]">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-gradient-to-br from-blue-300/40 to-sky-200/40 blur-[80px] mix-blend-multiply animate-[spin_15s_linear_infinite]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-gradient-to-bl from-sky-300/30 to-blue-200/40 blur-[100px] mix-blend-multiply animate-[spin_20s_linear_infinite_reverse]"></div>
        <div class="absolute top-[20%] left-[60%] w-[400px] h-[400px] rounded-full bg-gradient-to-tr from-slate-200/50 to-sky-100/50 blur-[80px] mix-blend-multiply animate-[pulse_8s_ease-in-out_infinite]"></div>
    </div>

    <!-- Form Card -->
    <div class="w-full max-w-[760px] bg-white/75 backdrop-blur-2xl border border-white/90 rounded-[2.5rem] p-8 sm:p-10 shadow-[0_24px_60px_-15px_rgba(37,99,235,0.12)] relative overflow-hidden my-8 sm:my-12">
        
        <!-- Ornamen -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-sky-100/60 rounded-full blur-3xl pointer-events-none"></div>

        <div class="text-center mb-8 relative z-10">
            <h2 class="font-jakarta text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight mb-2">Pendaftaran Warga</h2>
            <p class="text-[13px] text-slate-500 font-medium">Lengkapi data diri di bawah ini untuk mendapatkan akses ke SIPOSDIG.</p>
        </div>

        <form method="POST" action="{{ route('register.store') }}" 
              x-data="{ isSubmitting: false }" 
              @submit="isSubmitting = true" 
              class="relative z-10">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                <!-- NIK -->
                <div>
                    <label class="block text-[12px] font-extrabold text-slate-700 mb-1.5 tracking-wide uppercase">NIK (16 Digit) <span class="text-blue-500">*</span></label>
                    <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16" pattern="[0-9]{16}"
                        class="block w-full px-4 py-3.5 bg-white/90 border @error('nik') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 placeholder-slate-400 transition-all shadow-sm outline-none" 
                        placeholder="Contoh: 33250...">
                    @error('nik')<span class="text-xs text-red-500 font-semibold mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Nama -->
                <div>
                    <label class="block text-[12px] font-extrabold text-slate-700 mb-1.5 tracking-wide uppercase">Nama Lengkap <span class="text-blue-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="block w-full px-4 py-3.5 bg-white/90 border @error('nama') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 placeholder-slate-400 transition-all shadow-sm outline-none" 
                        placeholder="Sesuai KTP / KIA">
                    @error('nama')<span class="text-xs text-red-500 font-semibold mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-[12px] font-extrabold text-slate-700 mb-1.5 tracking-wide uppercase">Tanggal Lahir <span class="text-blue-500">*</span></label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                        class="block w-full px-4 py-3.5 bg-white/90 border @error('tanggal_lahir') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 placeholder-slate-400 transition-all shadow-sm outline-none">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-[12px] font-extrabold text-slate-700 mb-1.5 tracking-wide uppercase">Jenis Kelamin <span class="text-blue-500">*</span></label>
                    <select name="jenis_kelamin" required class="block w-full px-4 py-3.5 bg-white/90 border @error('jenis_kelamin') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 transition-all shadow-sm outline-none appearance-none">
                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Nomor HP -->
                <div>
                    <label class="block text-[12px] font-extrabold text-slate-700 mb-1.5 tracking-wide uppercase">Nomor HP / WA</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                        class="block w-full px-4 py-3.5 bg-white/90 border @error('no_hp') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 placeholder-slate-400 transition-all shadow-sm outline-none" 
                        placeholder="Opsional (Misal: 0812...)">
                </div>

                <!-- Unit Posyandu -->
                <div>
                    <label class="block text-[12px] font-extrabold text-slate-700 mb-1.5 tracking-wide uppercase">Unit Posyandu <span class="text-blue-500">*</span></label>
                    <select name="unit_posyandu_id" required class="block w-full px-4 py-3.5 bg-white/90 border @error('unit_posyandu_id') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 transition-all shadow-sm outline-none appearance-none">
                        <option value="" disabled selected>-- Pilih Posyandu Terdekat --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_posyandu_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->nama }} ({{ $unit->wilayah }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Alamat (Full Width) -->
                <div class="md:col-span-2">
                    <label class="block text-[12px] font-extrabold text-slate-700 mb-1.5 tracking-wide uppercase">Alamat Lengkap <span class="text-blue-500">*</span></label>
                    <textarea name="alamat" required rows="2"
                        class="block w-full px-4 py-3.5 bg-white/90 border @error('alamat') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 placeholder-slate-400 transition-all shadow-sm outline-none resize-none" 
                        placeholder="Tuliskan nama jalan, RT/RW, dan patokan rumah...">{{ old('alamat') }}</textarea>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="mt-8 pt-6 border-t border-slate-100/80 flex flex-col-reverse sm:flex-row gap-4 items-center justify-between">
                <a href="{{ route('login') }}" class="text-[13px] font-extrabold text-slate-400 hover:text-blue-600 transition-colors uppercase tracking-widest w-full sm:w-auto text-center py-2">
                    &larr; Kembali
                </a>
                
                <button type="submit" 
                        :disabled="isSubmitting"
                        class="w-full sm:w-auto bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-500 text-white font-bold text-sm py-3.5 px-8 rounded-2xl shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] flex items-center justify-center gap-2 transition-all hover:-translate-y-0.5 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none">
                    
                    <span x-show="!isSubmitting">Kirim Pendaftaran</span>
                    
                    <!-- Loading Spinner -->
                    <svg x-show="isSubmitting" style="display: none;" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-show="isSubmitting" style="display: none;">Memproses...</span>
                </button>
            </div>
        </form>
    </div>
</x-layouts.guest>