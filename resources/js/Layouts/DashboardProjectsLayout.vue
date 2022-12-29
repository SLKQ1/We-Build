<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-around p-6 bg-white border-b border-gray-200">
                        <Link :href="route('dashboard.team_points')"
                            class="basis-1/4 text-center hover:bg-indigo-300 hover:rounded-md">
                        Team Points
                        </Link>
                        <Link :href="route('dashboard.points')"
                            class="basis-1/4 text-center hover:bg-indigo-300 hover:rounded-md">
                        Your Points
                        </Link>
                        <Link :href="route('dashboard.projects')"
                            class="basis-1/4 text-center hover:bg-indigo-300 hover:rounded-md">
                        Your Projects
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <slot name="content" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>