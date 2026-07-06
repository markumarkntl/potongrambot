<script setup>
import { useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineOptions({ layout: GuestLayout });

const form = useForm({ email: '', password: '', remember: false });

const submit = () => {
    form.post(route('login'), { onFinish: () => form.reset('password') });
};
</script>

<template>
    <VCard class="mx-auto my-16" max-width="420" title="Login">
        <VCardText>
            <VForm @submit.prevent="submit">
                <VTextField v-model="form.email" label="Email" type="email" :error-messages="form.errors.email" class="mb-2" />
                <VTextField v-model="form.password" label="Password" type="password" :error-messages="form.errors.password" class="mb-2" />
                <VCheckbox v-model="form.remember" label="Remember me" />
                <VBtn type="submit" color="primary" block :loading="form.processing">Log in</VBtn>
            </VForm>
        </VCardText>
    </VCard>
</template>