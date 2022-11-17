<template>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">Projects</h1>
        <ProjectList></ProjectList>
    </AuthenticatedLayout>

    <GuestLayout v-else>
        <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">Projects</h1>
        <ProjectList></ProjectList>
    </GuestLayout>
</template>

<script setup>
import ProjectList from '@/Components/ProjectList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>
