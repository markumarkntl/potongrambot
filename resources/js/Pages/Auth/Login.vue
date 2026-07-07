<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
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
    <VCard width="100%" max-width="440" elevation="6" rounded="lg">
        <VCardText class="pa-8">
            <div class="text-center mb-6">
                <h4 class="text-h4 font-weight-bold mb-1">Selamat Datang 👋</h4>
                <p class="text-body-2 text-medium-emphasis">Silakan login ke akun kamu untuk melanjutkan</p>
            </div>

            <VAlert v-if="status" type="success" variant="tonal" class="mb-4">{{ status }}</VAlert>

            <VForm @submit.prevent="submit">
                <VTextField v-model="form.email" label="Email" type="email" prepend-inner-icon="mdi-email-outline" :error-messages="form.errors.email" autofocus autocomplete="username" class="mb-3" />
                <VTextField
                    v-model="form.password"
                    label="Password"
                    :type="showPassword ? 'text' : 'password'"
                    prepend-inner-icon="mdi-lock-outline"
                    :append-inner-icon="showPassword ? 'mdi-eye-off-outline' : 'mdi-eye-outline'"
                    :error-messages="form.errors.password"
                    autocomplete="current-password"
                    class="mb-1"
                    @click:append-inner="showPassword = !showPassword"
                />

                <div class="d-flex align-center justify-space-between mb-4">
                    <VCheckbox v-model="form.remember" label="Remember me" density="compact" hide-details />
                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-caption text-decoration-none">Lupa password?</Link>
                </div>

                <VBtn type="submit" color="primary" size="large" block rounded="lg" :loading="form.processing">Log in</VBtn>

                <p class="text-center text-body-2 mt-6">
                    Belum punya akun?
                    <Link :href="route('register')" class="text-decoration-none font-weight-medium">Daftar di sini</Link>
                </p>
            </VForm>
        </VCardText>
    </VCard>
</template>