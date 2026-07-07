<script setup>
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value?.focus?.());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus?.(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <p class="text-body-2 mb-4">
        Once your account is deleted, all of its resources and data will be
        permanently deleted. Before deleting your account, please download
        any data or information that you wish to retain.
    </p>

    <VBtn color="error" @click="confirmUserDeletion">Delete Account</VBtn>

    <VDialog v-model="confirmingUserDeletion" max-width="480">
        <VCard title="Are you sure you want to delete your account?">
            <VCardText>
                <p class="text-body-2 mb-4">
                    Once your account is deleted, all of its resources and
                    data will be permanently deleted. Please enter your
                    password to confirm you would like to permanently delete
                    your account.
                </p>

                <VTextField
                    ref="passwordInput"
                    v-model="form.password"
                    label="Password"
                    type="password"
                    :error-messages="form.errors.password"
                    @keyup.enter="deleteUser"
                />
            </VCardText>
            <VCardActions class="justify-end">
                <VBtn variant="text" @click="closeModal">Cancel</VBtn>
                <VBtn color="error" :disabled="form.processing" @click="deleteUser">
                    Delete Account
                </VBtn>
            </VCardActions>
        </VCard>
    </VDialog>
</template>