<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-around p-6 space-x-3 bg-white border-b border-gray-200 text-white">
                        <div class="basis-3/4 p-5 dark:bg-gray-800 dark:border-gray-700 shadow-md rounded-lg">
                            <h2 class="underline">Your Points</h2>
                            <h3>Points {{ userPoints }}</h3>
                            <h3>Rank 10000</h3>
                        </div>
                        <div class="basis-3/4 p-5 dark:bg-gray-800 dark:border-gray-700 shadow-md rounded-lg">
                            <h2 class="underline">Project Points</h2>
                            <h3 class="mb-1">Your top projects: </h3>
                            <div v-for="project in userProjects">
                                <p>{{ project.title }}, Points: {{ project.points }}</p>
                            </div>
                            <div class="flex justify-end">
                                <Link
                                :href="route('dashboard.projects.team', {filter: STATUSES.DONE})"
                                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
                                See all projects
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-around p-6 bg-white border-b border-gray-200">
                        <Link :href="route('dashboard.projects')"
                            class="basis-1/4 text-center hover:bg-indigo-300 hover:rounded-md">
                        See Projects
                        </Link>
                        <Link :href="route('dashboard.applications')"
                            class="basis-1/4 text-center hover:bg-indigo-300 hover:rounded-md">
                        See Applications
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { STATUSES } from '@/Constants/Project';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    userPoints: Number, 
    userProjects: Object, 
})

console.log(props.userProjects)
</script>