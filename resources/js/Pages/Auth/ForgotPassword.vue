<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

defineProps({
    status: { type: String },
});

const form = useForm({ email: '' });

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Lupa Kata Sandi" />

    <VCard width="100%" class="k-auth-card" elevation="0">
        <VCardText class="pa-8">
            <p class="k-eyebrow mb-3">RESET AKSES</p>
            <h1 class="k-auth-title mb-2">Lupa Kata Sandi?</h1>
            <p class="k-auth-sub mb-6">
                Nggak masalah. Masukkan email akunmu, nanti kami kirim tautan buat bikin kata sandi baru.
            </p>

            <VAlert v-if="status" type="success" variant="tonal" class="mb-5" density="comfortable">
                {{ status }}
            </VAlert>

            <VForm @submit.prevent="submit">
                <VTextField
                    v-model="form.email"
                    label="Email"
                    type="email"
                    variant="outlined"
                    prepend-inner-icon="mdi-email-outline"
                    :error-messages="form.errors.email"
                    autofocus
                    autocomplete="username"
                    class="mb-6"
                />

                <VBtn type="submit" size="large" block class="k-btn-gradient" :loading="form.processing">
                    Kirim Tautan Reset
                </VBtn>
            </VForm>
        </VCardText>
    </VCard>
</template>