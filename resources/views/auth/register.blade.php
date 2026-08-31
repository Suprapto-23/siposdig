<x-layouts.guest title="Daftar Warga — SIPOSDIG">
<div x-data="{ nik: '', captcha: '', genCaptcha() {
        const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        this.captcha = Array.from({length: 5}, () => chars[Math.floor(Math.random()*chars.length)]).join('');
    } }" x-init="genCaptcha()" class="relative min-h-screen overflow-hidden px-6 py-10">

    <div class="pointer-events-none absolute inset-0 -z-10">
        <div class="animate-drift absolute -left-24 -top-24 h-96 w-96 rounded-full bg-primary-light/70 blur-3xl"></div>
        <div class="animate-drift absolute -bottom-32 -right-16 h-[28rem] w-[28rem] rounded-full bg-accent-teal/20 blur-3xl" style="animation-delay:-6s"></div>
    </div>

    <div class="mx-auto max-w-md">
        <a href="{{ route('login') }}" class="inline-flex items-center gap-1 text-sm text-muted hover:text-primary">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
            Kembali
        </a>

        <div class="soft-card mt-4 rounded-3xl p-8 sm:p-10">
            <div class="flex items-center gap-2">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-accent-teal shadow-sm shadow-primary/30">
                    <svg viewBox="0 0 24 24" class="h-5 w-5">
                        <path fill="#ffffff" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        <polyline points="5.5,10.2 8.3,10.2 9.6,7 11.6,13.6 13,9.4 14.2,10.2 18.5,10.2" fill="none" class="text-primary" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <p class="font-display text-sm font-bold leading-none text-ink">SIPOSDIG</p>
                    <p class="text-[11px] text-muted">Platform Posyandu</p>
                </div>
            </div>

            <h1 class="mt-6 font-display text-2xl font-bold text-ink">Buat Akun Baru</h1>
            <p class="mt-1 text-sm text-muted">Lengkapi data di bawah ini sesuai KTP untuk mendaftar</p>

            <form method="POST" action="{{ route('register.store') }}" class="mt-6 space-y-4">
                @csrf

                <div class="relative">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    <input type="text" name="nama" required placeholder="Nama Lengkap"
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-ink placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/25">
                </div>

                <div>
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.25 8.25h19.5M4.5 5.25h15A2.25 2.25 0 0121.75 7.5v9a2.25 2.25 0 01-2.25 2.25h-15A2.25 2.25 0 012.25 16.5v-9A2.25 2.25 0 014.5 5.25zM6 15h3"/></svg>
                        <input type="text" name="nik" x-model="nik" maxlength="16" inputmode="numeric" required placeholder="16 digit NIK"
                            class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-ink placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/25">
                    </div>
                    <p class="mt-1.5 text-xs text-muted" x-text="nik.length + ' / 16 digit'"></p>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <input type="date" name="tanggal_lahir" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-ink focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/25">
                    <select name="jenis_kelamin" required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-ink focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/25">
                        <option value="" disabled selected>Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="relative">
                    <svg class="pointer-events-none absolute left-4 top-4 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    <textarea name="alamat" rows="2" required placeholder="Alamat sesuai domisili"
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-ink placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/25"></textarea>
                </div>

                <div class="relative">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a2.25 2.25 0 00-2.238.734l-.909 1.09a11.25 11.25 0 01-6.033-6.033l1.09-.91a2.25 2.25 0 00.734-2.237L7.964 3.102a1.125 1.125 0 00-1.091-.852H5.25A2.25 2.25 0 003 4.5v2.25z"/></svg>
                    <input type="tel" name="no_hp" required placeholder="Nomor HP"
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-ink placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/25">
                </div>

                <select name="unit_posyandu_id" required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-ink focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/25">
                    <option value="" disabled selected>Unit Posyandu Terdekat</option>
                    <option value="1">Posyandu Melati Indah I</option>
                    <option value="2">Posyandu Mawar Sehat</option>
                </select>

                <div class="flex items-center gap-3">
                    <div class="flex h-12 flex-1 select-none items-center justify-center rounded-xl bg-gradient-to-r from-primary-light/70 to-accent-teal/20 font-display text-lg font-bold tracking-[0.3em] text-primary-dark" x-text="captcha"></div>
                    <button type="button" @click="genCaptcha()" class="group flex h-12 w-12 items-center justify-center rounded-xl border border-slate-200 text-muted transition-colors hover:border-primary/40 hover:text-primary" aria-label="Muat ulang kode keamanan">
                        <svg class="h-5 w-5 transition-transform duration-500 group-active:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                    </button>
                </div>
                <input type="text" name="captcha_input" required placeholder="Masukkan kode keamanan"
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-ink placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/25">

                <label class="flex items-start gap-2 text-sm text-muted">
                    <input type="checkbox" required class="mt-0.5 rounded border-slate-300 text-primary focus:ring-primary/40">
                    Saya setuju dengan Syarat & Ketentuan
                </label>

                <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-primary to-primary-dark py-3.5 font-display font-semibold text-white shadow-lg shadow-primary/25 transition-all hover:shadow-xl hover:shadow-primary/30 active:scale-[0.99]">
                    Daftar
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-muted">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-dark">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
</x-layouts.guest>