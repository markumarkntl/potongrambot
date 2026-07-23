<script setup>
import { Head, router, usePage } from '@inertiajs/vue3';

defineProps({
    canLogin: { type: Boolean },
    canRegister: { type: Boolean },
    laravelVersion: { type: String, required: true },
    phpVersion: { type: String, required: true },
});

const page = usePage();

const petals = Array.from({ length: 7 }).map((_, i) => ({
    left: `${(i * 13 + 5) % 100}%`,
    duration: `${9 + (i % 4) * 2}s`,
    delay: `${i * -1.4}s`,
    size: `${8 + (i % 3) * 4}px`,
}));

const features = [
    {
        icon: 'mdi-database-search-outline',
        title: 'Data Langsung dari AniList',
        desc: 'Trending, skor, sampai studio produksi ditarik real-time lewat AniList GraphQL API.',
    },
    {
        icon: 'mdi-view-dashboard-outline',
        title: 'Dashboard Personal',
        desc: 'Semua anime yang kamu ikuti tertata rapi dalam satu tampilan, tanpa buka banyak tab.',
    },
    {
        icon: 'mdi-lightning-bolt-outline',
        title: 'Ringan & Cepat',
        desc: 'Dibangun pakai Laravel + Inertia + Vue biar navigasi terasa instan tanpa reload halaman.',
    },
];

const goLogin = () => router.get(route('login'));
const goRegister = () => router.get(route('register'));
const goDashboard = () => router.get(route('dashboard'));
</script>

<template>
    <Head title="Kynleenim — Rapikan Tontonan Anime-mu" />

    <VApp theme="dark">
        <div class="k-scope k-page">
            <div class="k-hero-region">
                <div class="k-hero-bg">
                    <div class="k-halftone" />
                    <div class="k-glow k-glow--pink k-glow--w1" />
                    <div class="k-glow k-glow--violet k-glow--w2" />
                    <span
                        v-for="(p, i) in petals"
                        :key="i"
                        class="k-petal"
                        :style="{
                            left: p.left,
                            width: p.size,
                            height: p.size,
                            animationDuration: p.duration,
                            animationDelay: p.delay,
                        }"
                    />
                </div>

                <VContainer class="k-nav">
                    <div class="d-flex align-center justify-space-between py-4">
                        <div class="d-flex align-center ga-2">
                            <div class="k-logo-mark">
                                <VIcon icon="mdi-television-play" size="20" />
                            </div>
                            <span class="k-brand">Kynleenim</span>
                        </div>

                        <div class="d-flex align-center ga-2">
                            <a href="#fitur" class="k-nav-link d-none d-sm-inline mr-2">Fitur</a>
                            <template v-if="canLogin">
                                <VBtn v-if="page.props.auth.user" class="k-btn-gradient" @click="goDashboard">
                                    Dashboard
                                </VBtn>
                                <template v-else>
                                    <VBtn variant="text" class="k-text-btn" @click="goLogin">Masuk</VBtn>
                                    <VBtn v-if="canRegister" class="k-btn-gradient" @click="goRegister">Daftar</VBtn>
                                </template>
                            </template>
                        </div>
                    </div>
                </VContainer>

                <VContainer class="k-hero">
                    <VRow align="center">
                        <VCol cols="12" md="7">
                            <p class="k-eyebrow mb-4">SATU DASHBOARD • RIBUAN ANIME</p>
                            <h1 class="k-h1 mb-4">
                                Rapikan Tontonan Anime-mu,
                                <span class="k-gradient-text">Tanpa Drama</span>
                            </h1>
                            <p class="k-lead mb-8">
                                Kynleenim menarik data trending, jadwal rilis, dan detail anime langsung
                                dari AniList, lalu menatanya rapi dalam satu dashboard biar kamu nggak
                                lupa lanjut nonton di episode berapa.
                            </p>

                            <div class="d-flex flex-wrap ga-3 mb-8">
                                <template v-if="canLogin && !page.props.auth.user">
                                    <VBtn size="large" class="k-btn-gradient" append-icon="mdi-arrow-right" @click="goRegister">
                                        Mulai Gratis
                                    </VBtn>
                                    <VBtn size="large" variant="outlined" class="k-btn-outline" @click="goLogin">
                                        Sudah Punya Akun
                                    </VBtn>
                                </template>
                                <VBtn v-else size="large" class="k-btn-gradient" append-icon="mdi-arrow-right" @click="goDashboard">
                                    Buka Dashboard
                                </VBtn>
                            </div>

                            <div class="d-flex flex-wrap ga-8 k-stats">
                                <div>
                                    <p class="k-stat-num">Real-time</p>
                                    <p class="k-stat-label">Data trending AniList</p>
                                </div>
                                <div>
                                    <p class="k-stat-num">100%</p>
                                    <p class="k-stat-label">Gratis dipakai</p>
                                </div>
                                <div>
                                    <p class="k-stat-num">&lt; 1 mnt</p>
                                    <p class="k-stat-label">Daftar & langsung pantau</p>
                                </div>
                            </div>
                        </VCol>

                        <VCol cols="12" md="5" class="d-none d-md-block">
                            <div class="k-stack">
                                <div class="k-poster k-poster--1 k-float-card" style="--rot: -8deg">
                                    <VIcon icon="mdi-fire" size="18" class="mb-2" color="primary" />
                                    <p class="k-poster-title">Trending</p>
                                    <p class="k-poster-sub">Musim ini</p>
                                </div>
                                <div class="k-poster k-poster--2 k-float-card" style="--rot: 6deg; animation-delay: -2s;">
                                    <VIcon icon="mdi-clock-outline" size="18" class="mb-2" />
                                    <p class="k-poster-title">Sedang Tayang</p>
                                    <p class="k-poster-sub">Jadwal mingguan</p>
                                </div>
                                <div class="k-poster k-poster--3 k-float-card" style="--rot: -3deg; animation-delay: -4s;">
                                    <VIcon icon="mdi-bookmark-check-outline" size="18" class="mb-2" />
                                    <p class="k-poster-title">Watchlist-mu</p>
                                    <p class="k-poster-sub">Tersimpan rapi</p>
                                </div>
                            </div>
                        </VCol>
                    </VRow>
                </VContainer>
            </div>

            <VContainer id="fitur" class="k-section">
                <div class="text-center mb-10">
                    <p class="k-eyebrow mb-2">KENAPA KYNLEENIM</p>
                    <h2 class="k-h2">Semua yang kamu butuh buat mantau anime</h2>
                </div>

                <VRow>
                    <VCol cols="12" sm="6" md="4" v-for="f in features" :key="f.title">
                        <div class="k-feature-card">
                            <div class="k-feature-icon">
                                <VIcon :icon="f.icon" size="24" />
                            </div>
                            <h3 class="k-feature-title">{{ f.title }}</h3>
                            <p class="k-feature-desc">{{ f.desc }}</p>
                        </div>
                    </VCol>
                </VRow>
            </VContainer>

            <VContainer class="k-section">
                <div class="k-cta">
                    <div class="k-cta-glow" />
                    <h2 class="k-h2 mb-2">Yuk, rapikan list anime-mu sekarang</h2>
                    <p class="k-lead mb-6 mx-auto">Gratis, cepat, dan datanya selalu update dari AniList.</p>
                    <VBtn
                        v-if="!page.props.auth.user"
                        size="large"
                        class="k-btn-gradient"
                        append-icon="mdi-arrow-right"
                        @click="canRegister ? goRegister() : goLogin()"
                    >
                        Daftar Sekarang
                    </VBtn>
                    <VBtn v-else size="large" class="k-btn-gradient" append-icon="mdi-arrow-right" @click="goDashboard">
                        Buka Dashboard
                    </VBtn>
                </div>
            </VContainer>

            <VContainer>
                <div class="k-footer">
                    <span class="k-brand k-brand--sm">Kynleenim</span>
                    <p class="k-footer-text">Data anime disediakan oleh AniList API. Dibuat oleh peepzy.</p>
                </div>
            </VContainer>
        </div>
    </VApp>
</template>

<style scoped>
.k-page {
    position: relative;
    min-height: 100vh;
    background: var(--k-bg);
    overflow: hidden;
}

.k-hero-region {
    position: relative;
    overflow: hidden;
}
.k-hero-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
    overflow: hidden;
    pointer-events: none;
}
.k-glow--w1 { width: 520px; height: 520px; top: -180px; left: -140px; }
.k-glow--w2 { width: 460px; height: 460px; top: 60px; right: -160px; }

.k-nav { position: relative; z-index: 1; }
.k-hero { position: relative; z-index: 1; padding-top: 24px; padding-bottom: 96px; }

.k-h1 {
    font-weight: 700;
    font-size: clamp(2.2rem, 4.2vw, 3.4rem);
    line-height: 1.08;
    letter-spacing: -0.01em;
    color: var(--k-text);
}
.k-lead {
    color: var(--k-text-dim);
    font-size: 1.05rem;
    line-height: 1.7;
    max-width: 520px;
}

.k-stats { border-top: 1px solid var(--k-border); padding-top: 20px; }
.k-stat-num {
    font-family: var(--k-font-display);
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--k-text);
    margin-bottom: 2px;
}
.k-stat-label { color: var(--k-text-dim); font-size: 0.78rem; }

.k-stack { position: relative; height: 420px; }
.k-poster {
    position: absolute;
    width: 200px;
    padding: 20px;
    border-radius: 18px;
    background: var(--k-surface);
    border: 1px solid var(--k-border);
    box-shadow: 0 20px 50px -20px rgba(0, 0, 0, 0.6);
    transform: rotate(var(--rot, 0deg));
}
.k-poster--1 { top: 0; right: 40px; background: linear-gradient(160deg, rgba(255, 79, 129, 0.18), var(--k-surface)); }
.k-poster--2 { top: 130px; right: 150px; z-index: 2; background: linear-gradient(160deg, rgba(139, 92, 246, 0.2), var(--k-surface)); }
.k-poster--3 { top: 260px; right: 30px; background: linear-gradient(160deg, rgba(69, 232, 198, 0.16), var(--k-surface)); }
.k-poster-title { font-weight: 700; color: var(--k-text); font-size: 0.95rem; }
.k-poster-sub { color: var(--k-text-dim); font-size: 0.78rem; margin-top: 2px; }

.k-section { padding-top: 64px; padding-bottom: 64px; position: relative; z-index: 1; }
.k-h2 {
    font-weight: 700;
    font-size: clamp(1.6rem, 2.6vw, 2.1rem);
    color: var(--k-text);
}

.k-feature-card {
    background: var(--k-surface);
    border: 1px solid var(--k-border);
    border-radius: 18px;
    padding: 28px;
    height: 100%;
    transition: transform 0.25s, border-color 0.25s;
}
.k-feature-card:hover { transform: translateY(-4px); border-color: rgba(255, 79, 129, 0.4); }
.k-feature-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: rgba(255, 79, 129, 0.12);
    color: var(--k-primary-soft);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}
.k-feature-title { font-weight: 700; color: var(--k-text); margin-bottom: 8px; font-size: 1.05rem; }
.k-feature-desc { color: var(--k-text-dim); font-size: 0.9rem; line-height: 1.6; }

.k-cta {
    position: relative;
    overflow: hidden;
    border-radius: 24px;
    padding: 56px 32px;
    text-align: center;
    background: var(--k-surface);
    border: 1px solid var(--k-border);
}
.k-cta-glow {
    position: absolute;
    inset: -40%;
    z-index: -1;
    background: var(--k-gradient);
    opacity: 0.18;
    filter: blur(60px);
}

.k-footer {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 40px 0 56px;
    position: relative;
    z-index: 1;
    text-align: center;
}
.k-footer-text { color: var(--k-text-dim); font-size: 0.82rem; }
</style>