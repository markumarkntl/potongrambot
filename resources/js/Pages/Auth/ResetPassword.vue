<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const props = defineProps({
    email: { type: String, required: true },
    token: { type: String, required: true },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Kata Sandi" />

    <VCard width="100%" class="k-auth-card" elevation="0">
        <VCardText class="pa-8">
            <p class="k-eyebrow mb-3">HAMPIR SELESAI</p>
            <h1 class="k-auth-title mb-2">Buat Kata Sandi Baru</h1>
            <p class="k-auth-sub mb-6">Pilih kata sandi baru yang kuat untuk akunmu.</p>

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
                    class="mb-4"
                />
                <VTextField
                    v-model="form.password"
                    label="Kata Sandi Baru"
                    type="password"
                    variant="outlined"
                    prepend-inner-icon="mdi-lock-outline"
                    :error-messages="form.errors.password"
                    autocomplete="new-password"
                    class="mb-4"
                />
                <VTextField
                    v-model="form.password_confirmation"
                    label="Konfirmasi Kata Sandi"
                    type="password"
                    variant="outlined"
                    prepend-inner-icon="mdi-lock-check-outline"
                    :error-messages="form.errors.password_confirmation"
                    autocomplete="new-password"
                    class="mb-6"
                />

                <VBtn type="submit" size="large" block class="k-btn-gradient" :loading="form.processing">
                    Simpan Kata Sandi
                </VBtn>
            </VForm>
        </VCardText>
    </VCard>
</template>