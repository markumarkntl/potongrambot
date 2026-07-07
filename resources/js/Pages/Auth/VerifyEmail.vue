<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <Head title="Email Verification" />

    <VCard width="100%" title="Email Verification">
        <VCardText>
            <p class="text-body-2 mb-4">
                Thanks for signing up! Before getting started, could you verify
                your email address by clicking on the link we just emailed to
                you? If you didn't receive the email, we will gladly send you
                another.
            </p>

            <VAlert v-if="verificationLinkSent" type="success" variant="tonal" class="mb-4">
                A new verification link has been sent to the email address you
                provided during registration.
            </VAlert>

            <VForm @submit.prevent="submit" class="d-flex align-center justify-space-between">
                <VBtn type="submit" color="primary" :loading="form.processing">
                    Resend Verification Email
                </VBtn>

                <Link :href="route('logout')" method="post" as="button" class="text-caption">
                    Log Out
                </Link>
            </VForm>
        </VCardText>
    </VCard>
</template>