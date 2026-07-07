<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <h4 class="text-h4 mb-4">Profile</h4>

    <VRow>
        <VCol cols="12">
            <VCard title="Profile Information">
                <VCardText>
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
                </VCardText>
            </VCard>
        </VCol>

        <VCol cols="12">
            <VCard title="Update Password">
                <VCardText>
                    <UpdatePasswordForm />
                </VCardText>
            </VCard>
        </VCol>

        <VCol cols="12">
            <VCard title="Delete Account">
                <VCardText>
                    <DeleteUserForm />
                </VCardText>
            </VCard>
        </VCol>
    </VRow>
</template>