<template>
    <DashboardProjectsLayout>
        <template #content>
            <div class="flex flex-col items-center gap-y-3">
                <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                    Your Projects
                </h2>
                <div class="flex flex-row justify-between gap-1">
                    <div @click="() => filter = null"
                        class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                        All
                    </div>
                    <div @click="() => filter = 1"
                        class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                        Started
                    </div>
                    <div @click="() => filter = 2"
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
                    <div>
                        <div v-if="filter === 1" class="flex flex-col gap-y-3 items-center">
                            <p class="font-semibold text-2xl">Started Projects</p>
                            <ProjectList :projects="projects.data"></ProjectList>
                            <Pagination :links="projects.links"></Pagination>
                        </div>
                        <div v-else-if="filter === 2" class="flex flex-col gap-y-3 items-center">
                            <p class="font-semibold text-2xl">Completed Projects</p>
                            <ProjectList :projects="projects.data"></ProjectList>
                            <Pagination :links="projects.links"></Pagination>
                        </div>
                        <div v-else class="flex flex-col gap-y-3 items-center">
                            <p class="font-semibold text-2xl">Completed Projects</p>
                            <ProjectList :projects="projects.data"></ProjectList>
                            <Pagination :links="projects.links"></Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DashboardProjectsLayout>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { watch } from 'vue';
import ProjectList from '@/Components/ProjectList.vue';
import Pagination from '@/Components/Pagination.vue';
import DashboardProjectsLayout from '@/Layouts/DashboardProjectsLayout.vue';

const props = defineProps({
    projects: Object,
})

let filter = ref('')

watch(filter, value => {
    Inertia.get('',
        { filter: value },
        { preserveState: true }
    )
})

</script>
