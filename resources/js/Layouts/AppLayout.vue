<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const drawer = ref(true);
const page = usePage();

const goTo = (routeName) => router.get(route(routeName));
const logout = () => router.post(route('logout'));
</script>

<template>
    <VApp>
        <VNavigationDrawer v-model="drawer" app>
            <VList>
                <VListItem
                    title="Dashboard"
                    prepend-icon="mdi-view-dashboard-outline"
                    :active="route().current('dashboard')"
                    @click="goTo('dashboard')"
                />
                <VListItem
                    title="Profile"
                    prepend-icon="mdi-account-outline"
                    :active="route().current('profile.edit')"
                    @click="goTo('profile.edit')"
                />
            </VList>
        </VNavigationDrawer>

        <VAppBar app>
            <VAppBarNavIcon @click="drawer = !drawer" />
            <VToolbarTitle>{{ page.props.app?.name ?? 'App' }}</VToolbarTitle>
            <VSpacer />
            <VMenu>
                <template #activator="{ props }">
                    <VBtn v-bind="props" variant="text">
                        {{ page.props.auth.user.name }}
                    </VBtn>
                </template>
                <VList>
                    <VListItem title="Profile" prepend-icon="mdi-account-outline" @click="goTo('profile.edit')" />
                    <VListItem title="Log Out" prepend-icon="mdi-logout" @click="logout" />
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