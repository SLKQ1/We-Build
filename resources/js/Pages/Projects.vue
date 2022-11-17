<template>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <div class="flex flex-col gap-y-3 items-center justify-center">
            <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">Projects</h1>
            <ProjectList></ProjectList>
        </div>
    </AuthenticatedLayout>

    <GuestLayout v-else>
        <div class="flex flex-col gap-y-3 items-center justify-center">
            <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">Projects</h1>
            <ProjectList></ProjectList>
        </div>
    </GuestLayout>
</template>

<script setup>
import ProjectList from '@/Components/ProjectList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>
