<script setup>
import { Link } from '@inertiajs/vue3';

const petals = Array.from({ length: 5 }).map((_, i) => ({
    left: `${i * 19 + 3}%`,
    duration: `${10 + i * 1.6}s`,
    delay: `${i * -1.2}s`,
}));
</script>

<template>
    <VApp theme="dark">
        <div class="k-scope k-auth-shell">
            <div class="k-bg-layer">
                <div class="k-halftone" />
                <div class="k-glow k-glow--pink k-glow--auth-1" />
                <div class="k-glow k-glow--violet k-glow--auth-2" />
                <span
                    v-for="(p, i) in petals"
                    :key="i"
                    class="k-petal"
                    :style="{ left: p.left, animationDuration: p.duration, animationDelay: p.delay }"
                />
            </div>

            <VMain class="k-auth-main">
                <VContainer class="d-flex flex-column align-center k-auth-container">
                    <Link href="/" class="k-auth-logo mb-8">
                        <div class="k-logo-mark k-logo-mark--lg">
                            <VIcon icon="mdi-television-play" size="26" />
                        </div>
                        <span class="k-brand">Kynleenim</span>
                    </Link>

                    <!-- Halaman di dalam slot ini (Login.vue, Register.vue, dst)
                         sudah membungkus kontennya sendiri dengan <VCard class="k-auth-card">. -->
                    <slot />

                    <Link href="/" class="k-back-home mt-6">
                        <VIcon icon="mdi-arrow-left" size="16" class="mr-1" />
                        Kembali ke beranda
                    </Link>
                </VContainer>
            </VMain>
        </div>
    </VApp>
</template>

<style scoped>
.k-auth-shell {
    position: relative;
    min-height: 100vh;
    background: var(--k-bg);
    overflow: hidden;
}
.k-bg-layer {
    position: absolute;
    inset: 0;
    z-index: 0;
    overflow: hidden;
    pointer-events: none;
}
.k-glow--auth-1 { width: 380px; height: 380px; top: -120px; left: -100px; }
.k-glow--auth-2 { width: 340px; height: 340px; bottom: -140px; right: -100px; }

.k-auth-main {
    position: relative;
    z-index: 1;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.k-auth-container { max-width: 460px; padding-top: 48px; padding-bottom: 48px; }

.k-auth-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }

.k-back-home {
    color: var(--k-text-dim);
    text-decoration: none;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    transition: color 0.2s;
}
.k-back-home:hover { color: var(--k-text); }
</style>