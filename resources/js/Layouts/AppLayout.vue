<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const drawer = ref(true);
const page = usePage();
</script>

<template>
    <VApp>
        <VNavigationDrawer v-model="drawer" app>
            <VList>
                <VListItem
                    title="Dashboard"
                    prepend-icon="mdi-view-dashboard-outline"
                    :active="route().current('dashboard')"
                    :href="route('dashboard')"
                    :as="Link"
                />
                <VListItem
                    title="Profile"
                    prepend-icon="mdi-account-outline"
                    :href="route('profile.edit')"
                    :as="Link"
                />
            </VList>
        </VNavigationDrawer>

        <VAppBar app>
            <VAppBarNavIcon @click="drawer = !drawer" />
            <VToolbarTitle>{{ $page.props.app?.name ?? 'App' }}</VToolbarTitle>
            <VSpacer />
            <VMenu>
                <template #activator="{ props }">
                    <VBtn v-bind="props" variant="text">
                        {{ page.props.auth.user.name }}
                    </VBtn>
                </template>
                <VList>
                    <VListItem :href="route('logout')" method="post" :as="Link" title="Log Out" />
                </VList>
            </VMenu>
        </VAppBar>

        <VMain>
            <VContainer fluid>
                <slot />
            </VContainer>
        </VMain>
    </VApp>
</template>