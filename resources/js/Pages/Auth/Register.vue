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
    <Head title="Register" />

    <VCard width="100%" max-width="440" elevation="6" rounded="lg">
        <VCardText class="pa-8">
            <div class="text-center mb-6">
                <h4 class="text-h4 font-weight-bold mb-1">Buat Akun 🚀</h4>
                <p class="text-body-2 text-medium-emphasis">Isi data di bawah untuk membuat akun baru</p>
            </div>

            <VForm @submit.prevent="submit">
                <VTextField v-model="form.name" label="Nama" prepend-inner-icon="mdi-account-outline" :error-messages="form.errors.name" autofocus autocomplete="name" class="mb-3" />
                <VTextField v-model="form.email" label="Email" type="email" prepend-inner-icon="mdi-email-outline" :error-messages="form.errors.email" autocomplete="username" class="mb-3" />
                <VTextField
                    v-model="form.password"
                    label="Password"
                    :type="showPassword ? 'text' : 'password'"
                    prepend-inner-icon="mdi-lock-outline"
                    :append-inner-icon="showPassword ? 'mdi-eye-off-outline' : 'mdi-eye-outline'"
                    :error-messages="form.errors.password"
                    autocomplete="new-password"
                    class="mb-3"
                    @click:append-inner="showPassword = !showPassword"
                />
                <VTextField v-model="form.password_confirmation" label="Konfirmasi Password" :type="showPassword ? 'text' : 'password'" prepend-inner-icon="mdi-lock-check-outline" :error-messages="form.errors.password_confirmation" autocomplete="new-password" class="mb-5" />

                <VBtn type="submit" color="primary" size="large" block rounded="lg" :loading="form.processing">Register</VBtn>

                <p class="text-center text-body-2 mt-6">
                    Sudah punya akun?
                    <Link :href="route('login')" class="text-decoration-none font-weight-medium">Login di sini</Link>
                </p>
            </VForm>
        </VCardText>
    </VCard>
</template>