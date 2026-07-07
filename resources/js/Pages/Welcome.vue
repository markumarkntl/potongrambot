<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const page = usePage();
</script>

<template>
    <Head title="Welcome" />

    <VApp>
        <VMain class="d-flex align-center justify-center" style="min-height: 100vh; background-color: #f5f5f5;">
            <VContainer class="text-center" style="max-width: 640px;">
                <h1 class="text-h3 font-weight-bold mb-2">🚀 Aplikasi Kamu</h1>
                <p class="text-body-1 text-medium-emphasis mb-8">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </p>

                <div v-if="canLogin" class="d-flex align-center justify-center ga-4">
                    <VBtn v-if="page.props.auth.user" :href="route('dashboard')" color="primary" size="large" :as="Link">
                        Dashboard
                    </VBtn>
                    <template v-else>
                        <VBtn :href="route('login')" color="primary" size="large" variant="tonal" :as="Link">
                            Log in
                        </VBtn>
                        <VBtn v-if="canRegister" :href="route('register')" color="primary" size="large" :as="Link">
                            Register
                        </VBtn>
                    </template>
                </div>
            </VContainer>
        </VMain>
    </VApp>
</template>