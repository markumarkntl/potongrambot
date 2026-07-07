<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <p class="text-body-2 mb-4">
        Update your account's profile information and email address.
    </p>

    <VForm @submit.prevent="form.patch(route('profile.update'))">
        <VTextField v-model="form.name" label="Name" :error-messages="form.errors.name" autofocus autocomplete="name" class="mb-2" />
        <VTextField v-model="form.email" label="Email" type="email" :error-messages="form.errors.email" autocomplete="username" class="mb-2" />

        <VAlert
            v-if="mustVerifyEmail && user.email_verified_at === null"
            type="warning"
            variant="tonal"
            class="mb-4"
        >
            Your email address is unverified.
            <Link :href="route('verification.send')" method="post" as="button" class="text-decoration-underline">
                Click here to re-send the verification email.
            </Link>
            <div v-show="status === 'verification-link-sent'" class="text-success mt-2">
                A new verification link has been sent to your email address.
            </div>
        </VAlert>

        <div class="d-flex align-center ga-4">
            <VBtn type="submit" color="primary" :disabled="form.processing">Save</VBtn>
            <Transition enter-active-class="transition-in" leave-active-class="transition-out">
                <span v-if="form.recentlySuccessful" class="text-body-2 text-medium-emphasis">Saved.</span>
            </Transition>
        </div>
    </VForm>
</template>