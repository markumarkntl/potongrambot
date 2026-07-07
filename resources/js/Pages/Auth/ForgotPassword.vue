<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

    <VCard width="100%" title="Forgot Password">
        <VCardText>
            <p class="text-body-2 mb-4">
                Forgot your password? No problem. Just let us know your email
                address and we will email you a password reset link that will
                allow you to choose a new one.
            </p>

            <VAlert v-if="status" type="success" variant="tonal" class="mb-4">
                {{ status }}
            </VAlert>

            <VForm @submit.prevent="submit">
                <VTextField
                    v-model="form.email"
                    label="Email"
                    type="email"
                    :error-messages="form.errors.email"
                    autofocus
                    autocomplete="username"
                    class="mb-4"
                />

                <div class="d-flex justify-end">
                    <VBtn type="submit" color="primary" :loading="form.processing">
                        Email Password Reset Link
                    </VBtn>
                </div>
            </VForm>
        </VCardText>
    </VCard>
</template>