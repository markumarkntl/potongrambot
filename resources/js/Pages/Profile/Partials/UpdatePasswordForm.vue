<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value?.focus?.();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value?.focus?.();
            }
        },
    });
};
</script>

<template>
    <p class="text-body-2 mb-4">
        Ensure your account is using a long, random password to stay secure.
    </p>

    <VForm @submit.prevent="updatePassword">
        <VTextField
            ref="currentPasswordInput"
            v-model="form.current_password"
            label="Current Password"
            type="password"
            :error-messages="form.errors.current_password"
            autocomplete="current-password"
            class="mb-2"
        />
        <VTextField
            ref="passwordInput"
            v-model="form.password"
            label="New Password"
            type="password"
            :error-messages="form.errors.password"
            autocomplete="new-password"
            class="mb-2"
        />
        <VTextField
            v-model="form.password_confirmation"
            label="Confirm Password"
            type="password"
            :error-messages="form.errors.password_confirmation"
            autocomplete="new-password"
            class="mb-4"
        />

        <div class="d-flex align-center ga-4">
            <VBtn type="submit" color="primary" :disabled="form.processing">Save</VBtn>
            <Transition enter-active-class="transition-in" leave-active-class="transition-out">
                <span v-if="form.recentlySuccessful" class="text-body-2 text-medium-emphasis">Saved.</span>
            </Transition>
        </div>
    </VForm>
</template>