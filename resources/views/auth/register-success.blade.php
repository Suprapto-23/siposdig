<x-layouts.guest>
    <!-- Background Animasi Premium -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10 bg-[#F0F6FB]">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-gradient-to-br from-blue-300/40 to-sky-200/40 blur-[80px] mix-blend-multiply animate-[spin_15s_linear_infinite]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-gradient-to-bl from-sky-300/30 to-blue-200/40 blur-[100px] mix-blend-multiply animate-[spin_20s_linear_infinite_reverse]"></div>
    </div>

    <!-- Success Card -->
    <div class="w-full max-w-[460px] bg-white/80 backdrop-blur-2xl border border-white/90 rounded-[2.5rem] p-8 sm:p-12 shadow-[0_24px_60px_-15px_rgba(37,99,235,0.12)] relative overflow-hidden text-center text-slate-800">
        
        <!-- Aksen Bulatan Bercahaya -->
        <div class="absolute inset-0 bg-gradient-to-b from-sky-50/50 to-transparent pointer-events-none"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-48 h-48 bg-blue-300/20 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Ikon Sukses -->
        <div class="relative z-10 flex justify-center mb-8">
            <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-blue-100 to-sky-50 flex items-center justify-center shadow-inner border border-white relative">
                <!-- Lingkaran Luar Animasi -->
                <div class="absolute inset-0 rounded-full border-2 border-blue-400 border-dashed animate-[spin_8s_linear_infinite] opacity-50"></div>
                <!-- Ceklis -->
                <svg class="w-12 h-12 text-blue-500 animate-[bounce_2s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <div class="relative z-10 space-y-3">
            <h2 class="font-jakarta text-2xl font-extrabold tracking-tight">Pendaftaran Berhasil!</h2>
            <p class="text-[13.5px] text-slate-500 font-medium leading-relaxed">
                Data Anda telah masuk ke dalam antrean sistem. Silakan menunggu konfirmasi verifikasi dari <strong class="text-blue-600">Admin Posyandu</strong> wilayah Anda.
            </p>
        </div>

        <!-- Info Box Tambahan -->
        <div class="relative z-10 mt-8 p-4 rounded-2xl bg-sky-50/50 border border-sky-100 text-left flex items-start gap-3">
            <div class="mt-0.5 text-sky-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-[11px] font-bold text-sky-700 leading-snug">
                Persetujuan akun biasanya memakan waktu maksimal 1x24 jam kerja. Anda dapat mencoba Login menggunakan NIK secara berkala.
            </p>
        </div>

        <div class="relative z-10 mt-10">
            <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-bold text-sm py-3.5 px-4 rounded-2xl transition-colors focus:outline-none border border-slate-200 hover:border-blue-200">
                Kembali ke Halaman Login
            </a>
        </div>
    </div>
</x-layouts.guest>