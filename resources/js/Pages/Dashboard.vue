<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import ProjectList from "@/Components/ProjectList.vue";
import { ref } from "vue";
import Pagination from '@/Components/Pagination.vue';

let dashboardViewToDisplay = ref(3);
let projectsToDisplay = ref(null)

const props = defineProps({
    projects: Object
})

const startedProjects = props.projects.data.filter(p => p.status === 1)
const completedProjects = props.projects.data.filter(p => p.status === 2)
</script>

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
                        <button @click="() => dashboardViewToDisplay = 1"
                            class="basis-1/4 hover:bg-indigo-300 hover:rounded-md">
                            Team Points
                        </button>
                        <button @click="() => dashboardViewToDisplay = 2"
                            class="basis-1/4 hover:bg-indigo-300 hover:rounded-md">
                            Your Points
                        </button>
                        <button @click="() => dashboardViewToDisplay = 3"
                            class="basis-1/4 hover:bg-indigo-300 hover:rounded-md">
                            Projects
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-if="dashboardViewToDisplay === 1" class="flex flex-col items-center gap-y-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                Team Points
                            </h2>
                        </div>
                        <div v-if="dashboardViewToDisplay === 2" class="flex flex-col items-center gap-y-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                Your Points
                            </h2>
                        </div>
                        <div v-if="dashboardViewToDisplay === 3" class="flex flex-col items-center gap-y-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                Your Projects
                            </h2>
                            <div class="flex flex-row justify-between gap-1">
                                <div @click="() => projectsToDisplay = null"
                                    class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                                    All
                                </div>
                                <div @click="() => projectsToDisplay = 1"
                                    class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                                    Started
                                </div>
                                <div @click="() => projectsToDisplay = 2"
                                    class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                                    Completed
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-end mb-3">
                                    <Link :href="route('projects.create')"
                                        class="p-3 px-6 text-white bg-indigo-400 rounded-full hover:bg-indigo-600 cursor-pointer block">
                                    Create Project
                                    </Link>
                                </div>

                                <div v-if="projectsToDisplay === 2" class="flex flex-col gap-y-3">
                                    <p class="font-semibold text-2xl">Completed Projects</p>
                                    <ProjectList :projects="completedProjects"></ProjectList>
                                    <Pagination :links="projects.links"></Pagination>
                                </div>
                                <div v-else-if="projectsToDisplay === 1" class="flex flex-col gap-y-3">
                                    <p class="font-semibold text-2xl">Started Projects</p>
                                    <ProjectList :projects="startedProjects"></ProjectList>
                                    <Pagination :links="projects.links"></Pagination>
                                </div>
                                <div v-else class="flex flex-col gap-y-3">
                                    <p class="font-semibold text-2xl">All Projects</p>
                                    <ProjectList :projects="projects.data"></ProjectList>
                                    <Pagination :links="projects.links"></Pagination>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
