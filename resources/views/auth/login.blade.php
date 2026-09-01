<x-layouts.guest>
    <!-- Card Utama Login -->
    <div class="w-full max-w-[420px] bg-white/75 backdrop-blur-2xl border border-white/90 rounded-[2.5rem] p-8 sm:p-10 shadow-[0_24px_60px_-15px_rgba(37,99,235,0.12)] relative overflow-hidden">
        
        <!-- Ornamen Halus di Sudut Card -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-100/50 rounded-full blur-2xl pointer-events-none"></div>

        <div class="text-center mb-8 relative z-10">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-sky-50 border border-blue-100 shadow-sm text-blue-600 mb-5">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            </div>
            <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 tracking-tight">Selamat Datang</h2>
            <p class="text-[13px] text-slate-500 font-medium mt-1.5">Silakan masuk menggunakan Email atau NIK</p>
        </div>

        <!-- Form (Dilengkapi Alpine.js untuk Loading State & Show Password) -->
        <form method="POST" action="{{ route('login.submit') }}" class="space-y-5 relative z-10" 
              x-data="{ showPassword: false, isSubmitting: false }" 
              @submit="isSubmitting = true">
            @csrf

            <!-- Input Email / NIK -->
            <div>
                <label for="login_id" class="block text-[13px] font-bold text-slate-700 mb-1.5 tracking-wide">ID Pengguna</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-blue-500 text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <input id="login_id" type="text" name="login_id" value="{{ old('login_id') }}" required autofocus
                        class="block w-full pl-11 pr-4 py-3.5 bg-white/90 border @error('login_id') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 placeholder-slate-400 transition-all shadow-sm outline-none" 
                        placeholder="Email atau NIK (16 Digit)">
                </div>
                @error('login_id')
                    <p class="mt-2 text-xs text-red-500 font-semibold flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Input Password -->
            <div>
                <label for="password" class="block text-[13px] font-bold text-slate-700 mb-1.5 tracking-wide">Kata Sandi</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-blue-500 text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <input id="password" x-bind:type="showPassword ? 'text' : 'password'" name="password" required
                        class="block w-full pl-11 pr-12 py-3.5 bg-white/90 border @error('password') border-red-300 ring-4 ring-red-50 @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 @enderror rounded-2xl text-sm font-medium text-slate-800 placeholder-slate-400 transition-all shadow-sm outline-none" 
                        placeholder="••••••••">
                    
                    <!-- Toggle Mata (Show/Hide) -->
                    <button type="button" @click="showPassword = !showPassword" tabindex="-1" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 focus:outline-none transition-colors">
                        <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="showPassword" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
            </div>

            <!-- Opsi Tambahan -->
            <div class="flex items-center justify-between mt-2 pb-2">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <div class="relative flex items-center justify-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500/30 transition-shadow peer appearance-none checked:bg-blue-600">
                        <svg class="absolute w-3 h-3 text-white opacity-0 peer-checked:opacity-100 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-xs text-slate-500 font-semibold group-hover:text-slate-700 transition-colors">Ingat Saya</span>
                </label>
                <!-- Menampilkan Alert Info menggunakan konfigurasi SweetAlert -->
                <button type="button" class="text-xs font-extrabold text-blue-600 hover:text-sky-500 transition-colors focus:outline-none" 
                        onclick="Swal.fire({title: 'Lupa Password?', text: 'Hubungi Kader Posyandu atau Administrator sistem di unit terdekat Anda untuk melakukan reset kata sandi.', icon: 'info', confirmButtonColor: '#2563EB', customClass: { popup: 'rounded-3xl' }})">
                    Lupa sandi?
                </button>
            </div>

            <!-- Tombol Submit (Vibrant Blue + Smart Loading) -->
            <button type="submit" 
                    :disabled="isSubmitting"
                    class="w-full bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-500 text-white font-bold text-sm py-3.5 px-4 rounded-2xl shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] flex items-center justify-center gap-2 transition-all hover:-translate-y-0.5 focus:outline-none disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none">
                
                <!-- Teks Normal -->
                <span x-show="!isSubmitting">Masuk ke Sistem</span>
                
                <!-- Loading State -->
                <svg x-show="isSubmitting" style="display: none;" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span x-show="isSubmitting" style="display: none;">Memverifikasi...</span>
            </button>
        </form>

        <div class="mt-8 text-center relative z-10">
            <p class="text-[13px] text-slate-500 font-medium">
                Belum terdaftar di posyandu? 
                <a href="{{ route('register') }}" class="font-extrabold text-blue-600 hover:text-sky-500 transition-colors ml-1">Registrasi Warga</a>
            </p>
        </div>
    </div>
</x-layouts.guest>