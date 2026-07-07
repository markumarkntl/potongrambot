<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
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
    <Head title="Reset Password" />

    <VCard width="100%" title="Reset Password">
        <VCardText>
            <VForm @submit.prevent="submit">
                <VTextField v-model="form.email" label="Email" type="email" :error-messages="form.errors.email" autofocus autocomplete="username" class="mb-2" />
                <VTextField v-model="form.password" label="Password" type="password" :error-messages="form.errors.password" autocomplete="new-password" class="mb-2" />
                <VTextField v-model="form.password_confirmation" label="Confirm Password" type="password" :error-messages="form.errors.password_confirmation" autocomplete="new-password" class="mb-4" />

                <div class="d-flex justify-end">
                    <VBtn type="submit" color="primary" :loading="form.processing">Reset Password</VBtn>
                </div>
            </VForm>
        </VCardText>
    </VCard>
</template>