<x-layouts.guest title="SIPOSDIG — Platform Posyandu">
<div class="relative flex min-h-screen flex-col items-center overflow-hidden bg-gradient-to-b from-primary-light/30 via-white to-white px-6 text-center">

    {{-- Ambient background --}}
    <div class="pointer-events-none absolute inset-0 -z-10">
        <div class="animate-drift absolute -left-24 -top-24 h-96 w-96 rounded-full bg-primary-light/70 blur-3xl"></div>
        <div class="animate-drift absolute -bottom-32 -right-16 h-[28rem] w-[28rem] rounded-full bg-accent-teal/20 blur-3xl" style="animation-delay:-6s"></div>
    </div>

   

    <div class="flex w-full flex-1 flex-col items-center justify-center">


        {{-- Slide track --}}
        <div class="relative w-full max-w-sm overflow-hidden" style="touch-action: pan-y;">
            <div id="onboarding-track" class="flex select-none" style="transition: transform .45s cubic-bezier(.4,0,.2,1);">

                {{-- Slide 1 --}}
                <div class="flex w-full shrink-0 flex-col items-center px-2">
                    <div class="relative mb-6 flex h-52 w-72 items-center justify-center">
                        <div class="absolute inset-6 rounded-full bg-primary-light/40 blur-2xl"></div>
                        {{-- Ganti <svg> ini dengan <dotlottie-wc src="..."> bila animasi Lottie asli sudah tersedia --}}
                        <svg viewBox="0 0 300 220" class="relative h-full w-full">
                            <ellipse cx="150" cy="196" rx="120" ry="14" class="text-primary-light" fill="currentColor" opacity="0.6"/>
                            <path d="M215 108 L250 82 L285 108 Z" class="text-accent-teal" fill="currentColor"/>
                            <rect x="222" y="108" width="56" height="66" rx="6" class="text-primary-light" fill="currentColor" opacity="0.7"/>
                            <rect x="244" y="138" width="16" height="36" rx="3" fill="#ffffff"/>
                            <rect x="230" y="118" width="14" height="14" rx="2" fill="#ffffff" opacity="0.85"/>
                            <path d="M48 190 Q48 148 76 148 Q104 148 104 190 Z" fill="#ffffff" stroke="#DCEAFB" stroke-width="2"/>
                            <rect x="70" y="160" width="12" height="4" class="text-primary" fill="currentColor"/>
                            <rect x="74" y="156" width="4" height="12" class="text-primary" fill="currentColor"/>
                            <circle cx="76" cy="122" r="20" fill="#F4C7A1"/>
                            <path d="M56 118 Q76 96 96 118 Q96 104 76 100 Q56 104 56 118 Z" fill="#4A3728"/>
                            <path d="M100 158 Q118 140 116 118" stroke="#F4C7A1" stroke-width="9" stroke-linecap="round" fill="none"/>
                            <path d="M122 196 Q118 148 150 144 Q182 148 178 196 Z" class="text-primary" fill="currentColor"/>
                            <circle cx="150" cy="118" r="22" fill="#F7CDA4"/>
                            <path d="M128 112 Q150 86 172 112 Q172 96 150 92 Q128 96 128 112 Z" fill="#3B2A20"/>
                            <rect x="138" y="150" width="28" height="32" rx="14" class="text-accent-teal" fill="currentColor"/>
                            <circle cx="152" cy="148" r="9" fill="#FBE0C2"/>
                            <path d="M196 196 Q193 164 214 162 Q235 164 232 196 Z" class="text-accent-teal" fill="currentColor" opacity="0.9"/>
                            <circle cx="214" cy="150" r="15" fill="#F7CDA4"/>
                            <path d="M200 146 Q214 130 228 146 Q228 137 214 133 Q200 137 200 146 Z" fill="#4A3728"/>
                            <line x1="196" y1="182" x2="180" y2="188" stroke="#F7CDA4" stroke-width="7" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-xl font-bold leading-snug text-ink">Bersama Posyandu, Sehatkan Keluarga</h2>
                    <p class="mt-3 max-w-xs text-sm leading-relaxed text-muted">Bangun generasi berkualitas lewat pemantauan kesehatan ibu dan anak yang mudah dan terintegrasi.</p>
                </div>

                {{-- Slide 2 --}}
                <div class="flex w-full shrink-0 flex-col items-center px-2">
                    <div class="relative mb-6 flex h-52 w-72 items-center justify-center">
                        <div class="absolute inset-6 rounded-full bg-accent-teal/30 blur-2xl"></div>
                        {{-- Ganti <svg> ini dengan <dotlottie-wc src="..."> bila animasi Lottie asli sudah tersedia --}}
                        <svg viewBox="0 0 300 220" class="relative h-full w-full">
                            <ellipse cx="150" cy="196" rx="120" ry="14" class="text-primary-light" fill="currentColor" opacity="0.6"/>
                            <rect x="90" y="140" width="34" height="56" rx="8" class="text-primary-light" fill="currentColor"/>
                            <rect x="134" y="112" width="34" height="84" rx="8" class="text-accent-teal" fill="currentColor"/>
                            <rect x="178" y="84" width="34" height="112" rx="8" class="text-primary" fill="currentColor"/>
                            <path d="M90 100 L215 60" stroke-dasharray="6 6" class="text-muted" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M204 53 L217 58 L211 71" class="text-muted" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="195" cy="72" r="14" fill="#F7CDA4"/>
                            <path d="M183 70 Q195 54 207 70 Q207 60 195 57 Q183 60 183 70 Z" fill="#4A3728"/>
                            <rect x="184" y="82" width="22" height="18" rx="9" fill="#ffffff"/>
                            <circle cx="245" cy="70" r="22" fill="#ffffff" class="text-primary" stroke="currentColor" stroke-width="2"/>
                            <path d="M235 70 L242 78 L256 62" class="text-primary" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-xl font-bold leading-snug text-ink">Pantau Tumbuh Kembang Balita</h2>
                    <p class="mt-3 max-w-xs text-sm leading-relaxed text-muted">Catat berat, tinggi, dan imunisasi si kecil secara digital, kapan saja dan di mana saja.</p>
                </div>

                {{-- Slide 3 --}}
                <div class="flex w-full shrink-0 flex-col items-center px-2">
                    <div class="relative mb-6 flex h-52 w-72 items-center justify-center">
                        <div class="absolute inset-6 rounded-full bg-primary-light/40 blur-2xl"></div>
                        {{-- Ganti <svg> ini dengan <dotlottie-wc src="..."> bila animasi Lottie asli sudah tersedia --}}
                        <svg viewBox="0 0 300 220" class="relative h-full w-full">
                            <ellipse cx="150" cy="196" rx="120" ry="14" class="text-primary-light" fill="currentColor" opacity="0.6"/>
                            <rect x="90" y="60" width="140" height="130" rx="18" fill="#ffffff" stroke="#DCEAFB" stroke-width="2"/>
                            <rect x="90" y="60" width="140" height="36" rx="18" class="text-primary" fill="currentColor"/>
                            <rect x="90" y="78" width="140" height="18" class="text-primary" fill="currentColor"/>
                            <rect x="118" y="48" width="10" height="20" rx="4" class="text-primary-dark" fill="currentColor"/>
                            <rect x="192" y="48" width="10" height="20" rx="4" class="text-primary-dark" fill="currentColor"/>
                            <g class="text-muted" fill="currentColor" opacity="0.35">
                                <circle cx="112" cy="118" r="6"/><circle cx="136" cy="118" r="6"/><circle cx="160" cy="118" r="6"/><circle cx="184" cy="118" r="6"/><circle cx="208" cy="118" r="6"/>
                                <circle cx="112" cy="142" r="6"/><circle cx="136" cy="142" r="6"/><circle cx="184" cy="142" r="6"/><circle cx="208" cy="142" r="6"/>
                                <circle cx="112" cy="166" r="6"/><circle cx="136" cy="166" r="6"/><circle cx="160" cy="166" r="6"/><circle cx="208" cy="166" r="6"/>
                            </g>
                            <circle cx="160" cy="142" r="11" class="text-accent-teal" fill="currentColor"/>
                            <path d="M245 60 a16 16 0 0 1 16 16 v10 l7 9 h-46 l7 -9 v-10 a16 16 0 0 1 16 -16 Z" class="text-primary" fill="currentColor"/>
                            <rect x="239" y="96" width="12" height="6" rx="3" class="text-primary" fill="currentColor"/>
                            <circle cx="266" cy="62" r="6" class="text-accent-teal" fill="currentColor"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-xl font-bold leading-snug text-ink">Jadwal Posyandu di Genggaman</h2>
                    <p class="mt-3 max-w-xs text-sm leading-relaxed text-muted">Dapatkan pengingat jadwal posyandu terdekat agar tidak ada lagi jadwal yang terlewat.</p>
                </div>

            </div>
        </div>

        {{-- Dots --}}
        <div class="mt-8 flex items-center justify-center gap-2" id="onboarding-dots">
            <button type="button" class="onboarding-dot h-2 w-6 rounded-full bg-primary transition-all duration-300" data-index="0" aria-label="Ke slide 1"></button>
            <button type="button" class="onboarding-dot h-2 w-2 rounded-full bg-primary/30 transition-all duration-300" data-index="1" aria-label="Ke slide 2"></button>
            <button type="button" class="onboarding-dot h-2 w-2 rounded-full bg-primary/30 transition-all duration-300" data-index="2" aria-label="Ke slide 3"></button>
        </div>
    </div>

    {{-- Next / CTA arrow --}}
    <div class="mb-10 mt-6 flex flex-col items-center gap-2">
        <button
            id="onboarding-next"
            type="button"
            onclick="siposdigHandleNext()"
            aria-label="Lanjut"
            class="flex h-14 w-14 items-center justify-center rounded-full bg-primary text-white shadow-xl shadow-primary/40 transition-transform duration-200 active:scale-90"
        >
            <svg id="onboarding-next-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"></path>
                <path d="M13 6l6 6-6 6"></path>
            </svg>
        </button>
        <span id="onboarding-next-label" class="text-xs font-medium text-muted">Lanjut</span>
    </div>
</div>

<script>
    (function () {
        const track = document.getElementById('onboarding-track');
        const dots = Array.from(document.querySelectorAll('.onboarding-dot'));
        const nextBtn = document.getElementById('onboarding-next');
        const nextLabel = document.getElementById('onboarding-next-label');
        const totalSlides = dots.length;
        const loginUrl = "{{ route('login') }}";

        let current = 0;
        let isDragging = false;
        let startX = 0;
        let deltaX = 0;

        function render() {
            track.style.transform = `translateX(calc(-${current * 100}% + ${deltaX}px))`;
        }

        function updateUI() {
            track.style.transform = `translateX(-${current * 100}%)`;

            dots.forEach((dot, i) => {
                const active = i === current;
                dot.classList.toggle('w-6', active);
                dot.classList.toggle('w-2', !active);
                dot.classList.toggle('bg-primary', active);
                dot.classList.toggle('bg-primary/30', !active);
            });

            const isLast = current === totalSlides - 1;
            nextLabel.textContent = isLast ? 'Mulai Sekarang' : 'Lanjut';
            nextBtn.setAttribute('aria-label', isLast ? 'Masuk ke halaman login' : 'Lanjut ke slide berikutnya');
        }

        function goTo(index) {
            current = Math.max(0, Math.min(totalSlides - 1, index));
            updateUI();
        }

        window.siposdigHandleNext = function () {
            if (current === totalSlides - 1) {
                window.location.href = loginUrl;
            } else {
                goTo(current + 1);
            }
        };

        window.siposdigGoToLogin = function () {
            window.location.href = loginUrl;
        };

        dots.forEach((dot) => {
            dot.addEventListener('click', () => goTo(Number(dot.dataset.index)));
        });

        // Swipe / drag support (touch + mouse via Pointer Events)
        track.addEventListener('pointerdown', (e) => {
            isDragging = true;
            startX = e.clientX;
            deltaX = 0;
            track.style.transition = 'none';
            track.setPointerCapture(e.pointerId);
        });

        track.addEventListener('pointermove', (e) => {
            if (!isDragging) return;
            deltaX = e.clientX - startX;
            render();
        });

        function endDrag() {
            if (!isDragging) return;
            isDragging = false;
            track.style.transition = 'transform .45s cubic-bezier(.4,0,.2,1)';

            const threshold = track.clientWidth * 0.18;
            if (deltaX < -threshold) {
                goTo(current + 1);
            } else if (deltaX > threshold) {
                goTo(current - 1);
            } else {
                updateUI();
            }
            deltaX = 0;
        }

        track.addEventListener('pointerup', endDrag);
        track.addEventListener('pointercancel', endDrag);
        track.addEventListener('pointerleave', () => { if (isDragging) endDrag(); });

        updateUI();
    })();
</script>
</x-layouts.guest>