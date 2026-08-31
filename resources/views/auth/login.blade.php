<x-layouts.guest title="Masuk — SIPOSDIG">
<div class="siposdig-auth relative flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-[#F7FAFC] overflow-hidden" style="min-height:100vh;min-height:100dvh;">

    <!-- Data-grid backdrop: motif titik netral, sangat halus -->
    <div class="pointer-events-none absolute inset-0 -z-10" style="background-image:radial-gradient(circle,#64748B16 1px,transparent 1px); background-size:26px 26px; mask-image:radial-gradient(ellipse 70% 60% at 50% 40%, black 40%, transparent 100%);"></div>

    <div class="w-full max-w-[1060px] my-auto rounded-[28px] flex overflow-hidden relative z-10 border border-slate-100 bg-white shadow-[inset_0_1px_0_rgba(255,255,255,0.8),0_1px_2px_rgba(16,24,40,0.04),0_24px_54px_-24px_rgba(15,23,42,0.14)]"
         x-data="{ loading: false, showPassword: false }">

        <!-- ================= LEFT: Panel Identitas ================= -->
        <div class="hidden md:flex w-[46%] relative flex-col justify-between p-12 lg:p-14 bg-white md:border-r md:border-slate-100 overflow-hidden">

            <div class="relative z-10 flex items-center gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl" style="background:linear-gradient(135deg,#00B4D8,#0077B6);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12h3.5l2-6 4 13 3-10 1.8 3h5.7"/></svg>
                </div>
                <div>
                    <p class="font-display text-lg font-bold leading-none text-[#03045E] tracking-tight">SIPOSDIG</p>
                    <p class="text-[13px] font-medium text-[#0077B6] mt-1">Posyandu Digital Terpadu</p>
                </div>
            </div>

            <div class="relative z-10 mt-10 flex-1 flex flex-col justify-center max-w-[340px]">
                <h1 class="font-display text-[32px] lg:text-[34px] font-bold leading-[1.15] text-[#03045E]">Selamat datang kembali</h1>
                <p class="mt-3 text-[15px] leading-relaxed text-slate-500">Masuk untuk melanjutkan pemantauan tumbuh kembang balita, remaja, dan lansia di posyandu Anda.</p>

                <!-- Ilustrasi brand — konsisten dengan halaman publik lain -->
                <div class="mt-8 relative flex justify-center siposdig-hero-in">
                    <div class="pointer-events-none absolute h-64 w-64 rounded-full" style="background:radial-gradient(circle,rgba(0,180,216,0.10),transparent 70%);"></div>
                    <img src="{{ asset('assets/lottie/login.svg') }}"
                         alt="Ilustrasi kesehatan"
                         class="relative w-full max-w-[240px] h-auto object-contain"
                         style="filter:drop-shadow(0 16px 28px rgba(15,23,42,0.12));">
                </div>

                <div class="mt-8 flex flex-wrap gap-2.5">
                    <span class="rounded-full border border-[#D6EEF6] bg-[#EAF6FB] px-3.5 py-1.5 text-[12.5px] font-medium text-[#075985]">128 posyandu aktif</span>
                    <span class="rounded-full border border-[#D6EEF6] bg-[#EAF6FB] px-3.5 py-1.5 text-[12.5px] font-medium text-[#075985]">24.500+ warga terpantau</span>
                </div>
            </div>

            <div class="relative z-10 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500 siposdig-pulse"></span>
                <span class="text-xs font-medium text-slate-500">Layanan kesehatan posyandu terintegrasi</span>
            </div>
        </div>

        <!-- ================= RIGHT: Form ================= -->
        <div class="w-full md:w-[54%] p-8 sm:p-12 lg:p-16 flex flex-col justify-center bg-white relative">

            <div x-cloak x-show="loading" x-transition.opacity class="absolute inset-0 z-20 flex flex-col items-center justify-center gap-3 bg-white/80 backdrop-blur-sm">
                <svg class="h-8 w-8 animate-spin" viewBox="0 0 24 24" fill="none" stroke="#0077B6" stroke-width="2.5"><circle cx="12" cy="12" r="9" class="opacity-20"/><path d="M21 12a9 9 0 0 0-9-9" stroke-linecap="round"/></svg>
                <span class="text-sm font-medium text-slate-500">Memeriksa kredensial…</span>
            </div>

            <div class="md:hidden flex items-center justify-center gap-2.5 mb-8">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl" style="background:linear-gradient(135deg,#00B4D8,#0077B6);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12h3.5l2-6 4 13 3-10 1.8 3h5.7"/></svg>
                </div>
                <p class="font-display text-base font-bold text-[#03045E] tracking-tight">SIPOSDIG</p>
            </div>

            <div class="mb-8 text-center md:text-left">
                <h2 class="font-display text-2xl font-bold text-[#03045E] tracking-tight">Masuk ke akun Anda</h2>
                <p class="mt-1.5 text-sm text-slate-500">Gunakan kredensial akun yang telah terdaftar</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5" @submit="loading = true">
                @csrf

                <div class="space-y-1.5">
                    <label for="identity" class="block text-sm font-medium text-slate-700">Email atau NIK</label>
                    <div class="group relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 transition-colors group-focus-within:text-[#0077B6]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <input type="text" id="identity" name="identity" required autofocus
                            class="block w-full rounded-2xl border border-slate-200 bg-[#F7FAFC] py-3.5 pl-11 pr-4 text-[#03045E] placeholder:text-slate-400 focus:border-[#0077B6] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#0077B6]/10 transition-colors duration-150"
                            placeholder="nama@siposdig.go.id atau NIK">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="block text-sm font-medium text-slate-700">Kata sandi</label>
                    <div class="group relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 transition-colors group-focus-within:text-[#0077B6]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                            class="block w-full rounded-2xl border border-slate-200 bg-[#F7FAFC] py-3.5 pl-11 pr-12 text-[#03045E] placeholder:text-slate-400 focus:border-[#0077B6] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#0077B6]/10 transition-colors duration-150"
                            placeholder="••••••••••">
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-[#0077B6] transition-colors focus:outline-none focus-visible:text-[#0077B6]" aria-label="Tampilkan kata sandi">
                            <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showPassword" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="remember" class="peer h-4 w-4 cursor-pointer appearance-none rounded-[5px] border border-slate-300 bg-white checked:border-[#0077B6] checked:bg-[#0077B6] transition-colors">
                            <svg class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-3 w-3 pointer-events-none opacity-0 peer-checked:opacity-100 text-white transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-500 group-hover:text-slate-700 transition-colors">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm font-semibold text-[#0077B6] hover:text-[#03045E] transition-colors focus-visible:outline-none focus-visible:underline">Lupa kata sandi?</a>
                </div>

                <button type="submit" :disabled="loading"
                    class="w-full rounded-2xl py-3.5 mt-2 font-display font-semibold text-white transition-all active:scale-[0.98] disabled:opacity-70 disabled:cursor-not-allowed flex items-center justify-center gap-2 shadow-[0_16px_32px_-12px_rgba(0,119,182,0.35)] hover:shadow-[0_20px_36px_-12px_rgba(0,119,182,0.45)]"
                    style="background:linear-gradient(135deg,#0077B6,#00B4D8);">
                    <span x-show="!loading">Masuk</span>
                    <span x-show="loading" x-cloak class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Memproses…
                    </span>
                </button>
            </form>

            <p class="mt-8 text-center text-sm font-medium text-slate-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-[#0077B6] hover:text-[#03045E] hover:underline transition-colors">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap');

    .siposdig-auth { font-family:'Inter',ui-sans-serif,system-ui,sans-serif; }
    .siposdig-auth .font-display { font-family:'Plus Jakarta Sans','Inter',sans-serif; }

    .siposdig-hero-in {
        opacity: 0;
        transform: translateY(10px) scale(.97);
        animation: siposdig-hero-in .7s cubic-bezier(.22,1,.36,1) .15s forwards;
    }
    .siposdig-pulse { animation: siposdig-pulse 2s ease-in-out infinite; }

    @keyframes siposdig-hero-in { to { opacity: 1; transform: translateY(0) scale(1); } }
    @keyframes siposdig-pulse { 0%,100% { opacity:1; } 50% { opacity:.35; } }

    [x-cloak] { display: none !important; }

    @media (prefers-reduced-motion: reduce) {
        .siposdig-hero-in, .siposdig-pulse { animation: none !important; opacity: 1 !important; transform: none !important; }
    }
</style>
</x-layouts.guest>