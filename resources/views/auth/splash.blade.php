<x-layouts.guest>
    <!-- Background Animasi Premium (Monochromatic Blue Mesh) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10 bg-[#F0F6FB]">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-gradient-to-br from-blue-300/40 to-sky-200/40 blur-[80px] mix-blend-multiply animate-[spin_15s_linear_infinite]"></div>
        <!-- Ubah ungu/hijau menjadi variasi biru muda dan cyan lembut -->
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-gradient-to-bl from-sky-300/30 to-blue-200/40 blur-[100px] mix-blend-multiply animate-[spin_20s_linear_infinite_reverse]"></div>
        <div class="absolute top-[20%] left-[60%] w-[400px] h-[400px] rounded-full bg-gradient-to-tr from-slate-200/50 to-sky-100/50 blur-[80px] mix-blend-multiply animate-[pulse_8s_ease-in-out_infinite]"></div>
    </div>

    <!-- Container Utama Onboarding -->
    <div class="relative w-full max-w-[420px] h-[620px] sm:h-[650px] bg-white/75 backdrop-blur-2xl border border-white/90 rounded-[3rem] overflow-hidden flex flex-col shadow-[0_24px_60px_-15px_rgba(37,99,235,0.12)]"
         x-data="{ step: 1, totalSteps: 3 }">

        <!-- Tombol Lewati -->
        <div class="absolute top-7 right-8 z-20 transition-all duration-500" 
             :class="step === totalSteps ? 'opacity-0 translate-x-4 pointer-events-none' : 'opacity-100 translate-x-0'">
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-full bg-white/60 text-[11px] font-extrabold tracking-widest text-slate-400 hover:text-blue-600 hover:bg-white hover:border-blue-100 shadow-sm border border-slate-100 transition-all uppercase">
                Lewati
            </a>
        </div>

        <!-- Slider Wrapper -->
        <div class="flex-1 overflow-hidden relative w-full mt-4">
            <div class="flex h-full w-full transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)]"
                 :style="`transform: translateX(-${(step - 1) * 100}%)`">

                <!-- Slide 1: Welcome -->
                <div class="w-full h-full shrink-0 flex flex-col items-center justify-start pt-12 px-8 text-center">
                    <div class="relative w-52 h-52 mb-10 flex items-center justify-center">
                        <div class="absolute inset-0 bg-blue-400/20 rounded-full blur-2xl animate-pulse" style="animation-duration: 4s;"></div>
                        <!-- Efek Float CSS Inline -->
                        <img src="{{ asset('assets/lottie/splash-screen.svg') }}" class="w-full h-full object-contain relative z-10 drop-shadow-xl" style="animation: float 6s ease-in-out infinite;" alt="Welcome">
                    </div>
                    <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 mb-3 tracking-tight leading-tight">Selamat Datang di <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-500">SIPOSDIG</span></h2>
                    <p class="text-[13px] text-slate-500 font-medium leading-relaxed max-w-[280px]">Sistem Informasi Posyandu Digital terpadu untuk kemudahan pemantauan kesehatan secara real-time.</p>
                </div>

                <!-- Slide 2: Edukasi Fitur -->
                <div class="w-full h-full shrink-0 flex flex-col items-center justify-start pt-12 px-8 text-center">
                    <div class="relative w-52 h-52 mb-10 flex items-center justify-center">
                        <div class="absolute inset-0 bg-sky-400/20 rounded-full blur-2xl animate-pulse" style="animation-duration: 4s;"></div>
                        <img src="{{ asset('assets/lottie/dashboard.svg') }}" class="w-full h-full object-contain relative z-10 drop-shadow-xl" style="animation: float 6s ease-in-out infinite 1s;" alt="Dashboard">
                    </div>
                    <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 mb-3 tracking-tight leading-tight">Pantau Tumbuh <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-blue-500">Kembang</span></h2>
                    <p class="text-[13px] text-slate-500 font-medium leading-relaxed max-w-[280px]">Rekam jejak kesehatan balita, remaja, hingga lansia terekam akurat oleh kader posyandu wilayah Anda.</p>
                </div>

                <!-- Slide 3: Keamanan & CTA -->
                <div class="w-full h-full shrink-0 flex flex-col items-center justify-start pt-12 px-8 text-center">
                    <div class="relative w-52 h-52 mb-10 flex items-center justify-center">
                        <div class="absolute inset-0 bg-blue-300/30 rounded-full blur-2xl animate-pulse" style="animation-duration: 4s;"></div>
                        <img src="{{ asset('assets/lottie/registrasi.svg') }}" class="w-full h-full object-contain relative z-10 drop-shadow-xl" style="animation: float 6s ease-in-out infinite 2s;" alt="Keamanan">
                    </div>
                    <h2 class="font-jakarta text-2xl font-extrabold text-slate-800 mb-3 tracking-tight leading-tight">Terintegrasi & <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-sky-400">Aman Terlindungi</span></h2>
                    <p class="text-[13px] text-slate-500 font-medium leading-relaxed max-w-[280px]">Data rekam medis tersimpan aman. Akses layanan posyandu kini menjadi lebih cepat dan transparan.</p>
                </div>

            </div>
        </div>

        <!-- Area Kontrol (Indikator & Tombol) -->
        <div class="px-8 pb-10 pt-4 flex flex-col items-center gap-8 relative z-10">
            
            <!-- Premium Pill Dots Indicator (Hardcoded anti-glitch) -->
            <div class="flex items-center gap-2.5">
                <button @click="step = 1" class="h-1.5 rounded-full transition-all duration-500 ease-out" :class="step === 1 ? 'w-8 bg-blue-600 shadow-[0_0_8px_rgba(37,99,235,0.4)]' : 'w-2 bg-blue-100 hover:bg-blue-300'"></button>
                <button @click="step = 2" class="h-1.5 rounded-full transition-all duration-500 ease-out" :class="step === 2 ? 'w-8 bg-blue-600 shadow-[0_0_8px_rgba(37,99,235,0.4)]' : 'w-2 bg-blue-100 hover:bg-blue-300'"></button>
                <button @click="step = 3" class="h-1.5 rounded-full transition-all duration-500 ease-out" :class="step === 3 ? 'w-8 bg-blue-600 shadow-[0_0_8px_rgba(37,99,235,0.4)]' : 'w-2 bg-blue-100 hover:bg-blue-300'"></button>
            </div>

            <!-- Tombol Aksi Dinamis (Vibrant No-Dark) -->
            <div class="w-full h-[56px] relative">
                <!-- Tombol Next -->
                <button x-show="step < totalSteps" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        @click="step++" 
                        class="absolute inset-0 w-full bg-gradient-to-r from-blue-500 to-sky-500 hover:from-blue-600 hover:to-sky-500 text-white font-bold text-sm rounded-2xl shadow-[0_8px_20px_-6px_rgba(14,165,233,0.4)] flex items-center justify-center gap-2 transition-transform hover:-translate-y-0.5 focus:outline-none">
                    Selanjutnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>

                <!-- Tombol Login -->
                <a href="{{ route('login') }}" 
                   x-show="step === totalSteps" 
                   x-cloak
                   x-transition:enter="transition ease-out duration-300 delay-100"
                   x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                   x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                   class="absolute inset-0 w-full bg-gradient-to-r from-blue-600 to-sky-600 hover:from-blue-700 hover:to-sky-600 text-white font-bold text-sm rounded-2xl shadow-[0_10px_25px_-6px_rgba(37,99,235,0.4)] flex items-center justify-center transition-all hover:-translate-y-1 focus:outline-none">
                    Masuk ke Sistem
                </a>
            </div>

        </div>
    </div>

    <!-- Animasi Float Khusus -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        [x-cloak] { display: none !important; }
    </style>
</x-layouts.guest>