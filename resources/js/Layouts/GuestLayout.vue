<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <VApp>
        <VMain class="d-flex align-center justify-center" style="min-height: 100vh; background-color: #f5f5f5;">
            <VContainer class="d-flex flex-column align-center" style="max-width: 480px;">
                <Link href="/" class="mb-6">
                    <ApplicationLogo style="height: 48px; width: 48px; fill: #616161;" />
                </Link>

                <!-- Halaman di dalam slot ini (Login.vue, Register.vue, dst)
                     sudah membungkus kontennya sendiri dengan <VCard>. -->
                <slot />
            </VContainer>
        </VMain>
    </VApp>
</template>