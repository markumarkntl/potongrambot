<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const form = useForm({ password: '' });

const submit = () => {
    form.post(route('password.confirm'), { onFinish: () => form.reset() });
};
</script>

<template>
    <Head title="Konfirmasi Kata Sandi" />

    <VCard width="100%" class="k-auth-card" elevation="0">
        <VCardText class="pa-8">
            <p class="k-eyebrow mb-3">AREA AMAN</p>
            <h1 class="k-auth-title mb-2">Konfirmasi Kata Sandi</h1>
            <p class="k-auth-sub mb-6">
                Ini area yang lebih sensitif. Masukkan kata sandimu dulu sebelum lanjut.
            </p>

            <VForm @submit.prevent="submit">
                <VTextField
                    v-model="form.password"
                    label="Kata Sandi"
                    type="password"
                    variant="outlined"
                    prepend-inner-icon="mdi-lock-outline"
                    :error-messages="form.errors.password"
                    autocomplete="current-password"
                    autofocus
                    class="mb-6"
                />

                <VBtn type="submit" size="large" block class="k-btn-gradient" :loading="form.processing">
                    Konfirmasi
                </VBtn>
            </VForm>
        </VCardText>
    </VCard>
</template>