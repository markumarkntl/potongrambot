<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <VCard width="100%" title="Register">
        <VCardText>
            <VForm @submit.prevent="submit">
                <VTextField v-model="form.name" label="Name" :error-messages="form.errors.name" autofocus autocomplete="name" class="mb-2" />
                <VTextField v-model="form.email" label="Email" type="email" :error-messages="form.errors.email" autocomplete="username" class="mb-2" />
                <VTextField v-model="form.password" label="Password" type="password" :error-messages="form.errors.password" autocomplete="new-password" class="mb-2" />
                <VTextField v-model="form.password_confirmation" label="Confirm Password" type="password" :error-messages="form.errors.password_confirmation" autocomplete="new-password" class="mb-4" />

                <div class="d-flex align-center justify-space-between">
                    <Link :href="route('login')" class="text-caption">Already registered?</Link>
                    <VBtn type="submit" color="primary" :loading="form.processing">Register</VBtn>
                </div>
            </VForm>
        </VCardText>
    </VCard>
</template>