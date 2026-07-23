<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const props = defineProps({
    status: { type: String },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Verifikasi Email" />

    <VCard width="100%" class="k-auth-card" elevation="0">
        <VCardText class="pa-8">
            <p class="k-eyebrow mb-3">SATU LANGKAH LAGI</p>
            <h1 class="k-auth-title mb-2">Verifikasi Email Kamu</h1>
            <p class="k-auth-sub mb-6">
                Makasih udah daftar! Sebelum lanjut, klik tautan verifikasi yang sudah kami kirim
                ke emailmu. Belum dapat emailnya? Kami kirim ulang, tinggal klik tombol di bawah.
            </p>

            <VAlert v-if="verificationLinkSent" type="success" variant="tonal" class="mb-5" density="comfortable">
                Tautan verifikasi baru sudah dikirim ke email yang kamu daftarkan.
            </VAlert>

            <VForm @submit.prevent="submit" class="d-flex flex-column ga-4">
                <VBtn type="submit" size="large" block class="k-btn-gradient" :loading="form.processing">
                    Kirim Ulang Email Verifikasi
                </VBtn>

                <Link :href="route('logout')" method="post" as="button" class="k-link text-center">
                    Keluar
                </Link>
            </VForm>
        </VCardText>
    </VCard>
</template>