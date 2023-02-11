<template>

    <Head title="Projects"></Head>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.props.auth.user.name }}'s Projects
            </h2>
        </template>

        <div v-if="route().current('dashboard.projects') || route().current('dashboard.projects.team')" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-around p-6 bg-white border-b border-gray-200">
                        <div @click="() => getUserProjects()">
                            <NavLink class="text-center hover:bg-indigo-300 hover:rounded-md"
                                :active="route().current('dashboard.projects')">
                                Your Projects
                            </NavLink>
                        </div>
                        <div @click="() => getTeamProjects()">
                            <NavLink class="text-center hover:bg-indigo-300 hover:rounded-md"
                                :active="route().current('dashboard.projects.team')">
                                Team Projects
                            </NavLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col gap-y-3">
                            <div class="flex flex-col items-center gap-y-3">
                                <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                </h2>
                                <div class="flex flex-row justify-between gap-5">
                                    <div @click="() => filter = null">
                                        <NavLink :href="route('dashboard.projects', {user: $page.props.auth.user.name})" :active="filter === null"
                                            class="text-center hover:bg-indigo-300 hover:rounded-md">
                                            All
                                        </NavLink>
                                    </div>
                                    <div @click="() => filter = STATUSES.OPEN">
                                        <NavLink :href="route('dashboard.projects', {user: $page.props.auth.user.name})" :active="filter == STATUSES.OPEN"
                                            class="text-center hover:bg-indigo-300 hover:rounded-md">
                                            Open
                                        </NavLink>
                                    </div>
                                    <div @click="() => filter = STATUSES.IN_PROGRESS">
                                        <NavLink :href="route('dashboard.projects', {user: $page.props.auth.user.name})"
                                            :active="filter == STATUSES.IN_PROGRESS"
                                            class="text-center hover:bg-indigo-300 hover:rounded-md">
                                            Started
                                        </NavLink>
                                    </div>
                                    <div @click="() => filter = STATUSES.DONE">
                                        <NavLink :href="route('dashboard.projects', {user: $page.props.auth.user.name})" :active="filter == STATUSES.DONE"
                                            class="text-center hover:bg-indigo-300 hover:rounded-md">
                                            Completed
                                        </NavLink>
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
                                        <div v-if="filter == STATUSES.OPEN" 
                                            class="items-center space-y-3">
                                            <p class="font-semibold text-2xl">Open Projects</p>
                                            <ProjectList :projects="projects.data"></ProjectList>
                                            <Pagination :links="projects.links"></Pagination>
                                        </div>
                                        <div v-else-if="filter == STATUSES.IN_PROGRESS"
                                            class="items-center space-y-3">
                                            <p class="font-semibold text-2xl">Started Projects</p>
                                            <ProjectList :projects="projects.data"></ProjectList>
                                            <Pagination :links="projects.links"></Pagination>
                                        </div>
                                        <div v-else-if="filter == STATUSES.DONE"
                                            class="items-center space-y-3">
                                            <p class="font-semibold text-2xl">Completed Projects</p>
                                            <ProjectList :projects="projects.data"></ProjectList>
                                            <Pagination :links="projects.links"></Pagination>
                                        </div>
                                        <div v-else class="items-center space-y-3">
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
            </div>
        </div>
    </AuthenticatedLayout>
    <GuestLayout v-else>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col gap-y-3">
                            <div class="flex flex-col items-center gap-y-3">
                                <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                </h2>
                                <div class="flex flex-row justify-between gap-5">
                                    <div @click="() => filter = null">
                                        <NavLink :href="route('dashboard.projects', {user: $page.props.auth.user.name})" :active="filter === null"
                                            class="text-center hover:bg-indigo-300 hover:rounded-md">
                                            All
                                        </NavLink>
                                    </div>
                                    <div @click="() => filter = STATUSES.OPEN">
                                        <NavLink :href="route('dashboard.projects', {user: $page.props.auth.user.name})" :active="filter == STATUSES.OPEN"
                                            class="text-center hover:bg-indigo-300 hover:rounded-md">
                                            Open
                                        </NavLink>
                                    </div>
                                    <div @click="() => filter = STATUSES.IN_PROGRESS">
                                        <NavLink :href="route('dashboard.projects', {user: $page.props.auth.user.name})"
                                            :active="filter == STATUSES.IN_PROGRESS"
                                            class="text-center hover:bg-indigo-300 hover:rounded-md">
                                            Started
                                        </NavLink>
                                    </div>
                                    <div @click="() => filter = STATUSES.DONE">
                                        <NavLink :href="route('dashboard.projects', {user: $page.props.auth.user.name})" :active="filter == STATUSES.DONE"
                                            class="text-center hover:bg-indigo-300 hover:rounded-md">
                                            Completed
                                        </NavLink>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <div v-if="filter == STATUSES.OPEN" class="flex flex-col gap-y-3 items-center">
                                            <p class="font-semibold text-2xl">Open Projects</p>
                                            <ProjectList :projects="projects.data"></ProjectList>
                                            <Pagination :links="projects.links"></Pagination>
                                        </div>
                                        <div v-else-if="filter == STATUSES.IN_PROGRESS"
                                            class="flex flex-col gap-y-3 items-center">
                                            <p class="font-semibold text-2xl">Started Projects</p>
                                            <ProjectList :projects="projects.data"></ProjectList>
                                            <Pagination :links="projects.links"></Pagination>
                                        </div>
                                        <div v-else-if="filter == STATUSES.DONE"
                                            class="flex flex-col gap-y-3 items-center">
                                            <p class="font-semibold text-2xl">Completed Projects</p>
                                            <ProjectList :projects="projects.data"></ProjectList>
                                            <Pagination :links="projects.links"></Pagination>
                                        </div>
                                        <div v-else class="flex flex-col gap-y-3 items-center">
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
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { Head, Link, usePage } from '@inertiajs/inertia-vue3';
import NavLink from '@/Components/NavLink.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { watch } from 'vue';
import ProjectList from '@/Components/ProjectList.vue';
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { STATUSES } from '@/Constants/Project'
import GuestLayout from '@/Layouts/GuestLayout.vue';

const props = defineProps({
    projects: Object,
    filter: String,
})

let filter = ref(props.filter)

watch(filter, value => {
    Inertia.get('',
        { filter: value },
        { preserveState: true }
    )
})

function getTeamProjects() {
    Inertia.get(route('dashboard.projects.team', {user: usePage().props.value.auth.user.name}))
}

function getUserProjects() {
    Inertia.get(route('dashboard.projects', {user: usePage().props.value.auth.user.name}))
}
</script>

