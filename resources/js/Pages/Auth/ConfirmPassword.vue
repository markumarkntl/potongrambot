<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Confirm Password" />

    <VCard width="100%" title="Confirm Password">
        <VCardText>
            <p class="text-body-2 mb-4">
                This is a secure area of the application. Please confirm your
                password before continuing.
            </p>

            <VForm @submit.prevent="submit">
                <VTextField
                    v-model="form.password"
                    label="Password"
                    type="password"
                    :error-messages="form.errors.password"
                    autocomplete="current-password"
                    autofocus
                    class="mb-4"
                />

                <div class="d-flex justify-end">
                    <VBtn type="submit" color="primary" :loading="form.processing">Confirm</VBtn>
                </div>
            </VForm>
        </VCardText>
    </VCard>
</template>