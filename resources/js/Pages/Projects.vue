<template>
    <Head title="Projects"></Head>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col gap-y-3 items-center justify-center">
                            <ProjectList :projects="projects"></ProjectList>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <GuestLayout v-else>
        <div class="flex flex-col gap-y-3 items-center justify-center">
            <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">Projects</h1>
            <ProjectList :projects="projects"></ProjectList>
        </div>
    </GuestLayout>
</template>

<script setup>
import ProjectList from '@/Components/ProjectList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    projects: Object,
})
</script>
