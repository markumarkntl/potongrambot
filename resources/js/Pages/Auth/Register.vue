<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const form = useForm({ name: '', email: '', password: '', password_confirmation: '' });
const showPassword = ref(false);

const submit = () => {
    form.post(route('register'), { onFinish: () => form.reset('password', 'password_confirmation') });
};
</script>

<template>
    <Head title="Daftar" />

    <VCard width="100%" class="k-auth-card" elevation="0">
        <VCardText class="pa-8">
            <p class="k-eyebrow mb-3">GABUNG SEKARANG</p>
            <h1 class="k-auth-title mb-2">Buat Akun Baru</h1>
            <p class="k-auth-sub mb-6">Gratis, cuma butuh kurang dari semenit.</p>

            <VForm @submit.prevent="submit">
                <VTextField
                    v-model="form.name"
                    label="Nama"
                    variant="outlined"
                    prepend-inner-icon="mdi-account-outline"
                    :error-messages="form.errors.name"
                    autofocus
                    autocomplete="name"
                    class="mb-4"
                />
                <VTextField
                    v-model="form.email"
                    label="Email"
                    type="email"
                    variant="outlined"
                    prepend-inner-icon="mdi-email-outline"
                    :error-messages="form.errors.email"
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
                    autocomplete="new-password"
                    class="mb-4"
                    @click:append-inner="showPassword = !showPassword"
                />
                <VTextField
                    v-model="form.password_confirmation"
                    label="Konfirmasi Kata Sandi"
                    :type="showPassword ? 'text' : 'password'"
                    variant="outlined"
                    prepend-inner-icon="mdi-lock-check-outline"
                    :error-messages="form.errors.password_confirmation"
                    autocomplete="new-password"
                    class="mb-6"
                />

                <VBtn type="submit" size="large" block class="k-btn-gradient" :loading="form.processing">
                    Daftar
                </VBtn>

                <p class="k-auth-footer mt-6">
                    Sudah punya akun?
                    <Link :href="route('login')" class="k-link k-link--strong">Masuk di sini</Link>
                </p>
            </VForm>
        </VCardText>
    </VCard>
</template>