<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineOptions({ layout: GuestLayout });

defineProps({
    canResetPassword: { type: Boolean, default: true },
    status: { type: String },
});

const form = useForm({ email: '', password: '', remember: false });
const showPassword = ref(false);

const submit = () => {
    form.post(route('login'), { onFinish: () => form.reset('password') });
};
</script>

<template>
    <Head title="Masuk" />

    <VCard width="100%" class="k-auth-card" elevation="0">
        <VCardText class="pa-8">
            <p class="k-eyebrow mb-3">SELAMAT DATANG KEMBALI</p>
            <h1 class="k-auth-title mb-2">Masuk ke Kynleenim</h1>
            <p class="k-auth-sub mb-6">Lanjutkan mantau anime dari watchlist kamu.</p>

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
                    class="mb-4"
                />
                <VTextField
                    v-model="form.password"
                    label="Kata Sandi"
                    :type="showPassword ? 'text' : 'password'"
                    variant="outlined"
                    prepend-inner-icon="mdi-lock-outline"
                    :append-inner-icon="showPassword ? 'mdi-eye-off-outline' : 'mdi-eye-outline'"
                    :error-messages="form.errors.password"
                    autocomplete="current-password"
                    class="mb-2"
                    @click:append-inner="showPassword = !showPassword"
                />

                <div class="d-flex align-center justify-space-between mb-6">
                    <VCheckbox v-model="form.remember" label="Ingat saya" density="compact" hide-details color="primary" />
                    <Link v-if="canResetPassword" :href="route('password.request')" class="k-link">Lupa kata sandi?</Link>
                </div>

                <VBtn type="submit" size="large" block class="k-btn-gradient" :loading="form.processing">
                    Masuk
                </VBtn>

                <p class="k-auth-footer mt-6">
                    Belum punya akun?
                    <Link :href="route('register')" class="k-link k-link--strong">Daftar sekarang</Link>
                </p>
            </VForm>
        </VCardText>
    </VCard>
</template>