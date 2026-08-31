<x-layouts.guest title="Pendaftaran Terkirim — SIPOSDIG">
<div class="relative flex items-center justify-center overflow-hidden px-6 py-12" style="min-height:100vh;min-height:100dvh;">

    <div class="pointer-events-none absolute inset-0 -z-10">
        <div class="animate-drift absolute -left-24 -top-24 h-96 w-96 rounded-full bg-primary-light/70 blur-3xl"></div>
        <div class="animate-drift absolute -bottom-32 -right-16 h-[28rem] w-[28rem] rounded-full bg-accent-teal/20 blur-3xl" style="animation-delay:-6s"></div>
    </div>

    <div class="soft-card w-full max-w-md rounded-3xl p-8 text-center sm:p-10">

        <div class="mb-8 flex items-center justify-center gap-2.5">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-accent-teal shadow-sm shadow-primary/30">
                <svg viewBox="0 0 24 24" class="h-5 w-5">
                    <path fill="#ffffff" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    <polyline points="5.5,10.2 8.3,10.2 9.6,7 11.6,13.6 13,9.4 14.2,10.2 18.5,10.2" fill="none" class="text-primary" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <p class="font-display text-base font-bold text-ink">SIPOSDIG</p>
        </div>

        <div class="siposdig-hero-in relative mx-auto flex w-fit justify-center">
            <div class="pointer-events-none absolute inset-0 m-auto h-52 w-52 rounded-full bg-primary-light/40 blur-2xl"></div>
            <img src="{{ asset('assets/lottie/registrasi.svg') }}" alt="Ilustrasi pendaftaran"
                 class="relative h-auto w-full max-w-[180px] object-contain"
                 style="filter:drop-shadow(0 16px 28px rgba(15,23,42,0.12));">
            <div class="siposdig-badge-in absolute -bottom-1 -right-1 flex h-10 w-10 items-center justify-center rounded-full bg-emerald-500 ring-4 ring-white">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
            </div>
        </div>

        <span class="mt-7 inline-flex items-center gap-1.5 rounded-full border border-amber-100 bg-amber-50 px-3 py-1 text-[12.5px] font-medium text-amber-700">
            <span class="siposdig-pulse h-1.5 w-1.5 rounded-full bg-amber-500"></span>
            Menunggu verifikasi Admin
        </span>

        <h1 class="mt-4 font-display text-2xl font-bold text-ink">Pendaftaran berhasil dikirim</h1>
        <p class="mt-3 text-sm leading-relaxed text-muted">
            NIK Anda akan diperiksa oleh Admin. Setelah disetujui, akun dan kata sandi akan disampaikan
            langsung oleh Admin atau Kader di posyandu Anda.
        </p>

        <a href="{{ route('login') }}"
            class="mt-8 inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-primary to-primary-dark py-3.5 font-display font-semibold text-white shadow-lg shadow-primary/30 transition-all hover:shadow-xl hover:shadow-primary/40 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-primary/25">
            Kembali ke halaman masuk
        </a>
    </div>
</div>

<style>
    .siposdig-hero-in { opacity:0; transform:translateY(10px) scale(.97); animation: siposdig-hero-in .7s cubic-bezier(.22,1,.36,1) .15s forwards; }
    .siposdig-badge-in { opacity:0; transform:scale(0); animation: siposdig-badge-in .45s cubic-bezier(.34,1.56,.64,1) .55s forwards; }
    .siposdig-pulse { animation: siposdig-pulse 2s ease-in-out infinite; }

    @keyframes siposdig-hero-in { to { opacity:1; transform:translateY(0) scale(1); } }
    @keyframes siposdig-badge-in { to { opacity:1; transform:scale(1); } }
    @keyframes siposdig-pulse { 0%,100% { opacity:1; } 50% { opacity:.35; } }

    @media (prefers-reduced-motion: reduce) {
        .siposdig-hero-in, .siposdig-badge-in, .siposdig-pulse { animation:none !important; opacity:1 !important; transform:none !important; }
    }
</style>
</x-layouts.guest>