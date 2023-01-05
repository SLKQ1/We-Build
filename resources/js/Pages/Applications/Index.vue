<template>

    <Head title="Applications"></Head>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Applications for {{ project.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">        
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-3">
                            <h2 class="mb-0 underline">Current Team:</h2>
                            <p> <strong>Size:</strong> {{ team.length }} / {{ project.team_size }}</p>
                        </div>
                        <div v-for="member in team">
                            <div class="border-b-2 border-b-gray-800">
                                <p>Name: {{ member.name }}</p>
                                <p>Email: {{ member.email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">        
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col items-center my-10">
                            <div class="flex flex-row justify-between gap-5 mb-4">
                                <div @click="() => filter = null">
                                    <NavLink :href="route('projects.applications.index', { project: project.id })"
                                        :active="filter == null"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        All
                                    </NavLink>
                                </div>
                                <div @click="() => filter = STATUSES.PENDING">
                                    <NavLink :href="route('projects.applications.index', { project: project.id })"
                                        :active="filter == STATUSES.PENDING"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        Not Viewed
                                    </NavLink>
                                </div>
                                <div @click="() => filter = STATUSES.VIEWED">
                                    <NavLink :href="route('projects.applications.index', { project: project.id })"
                                        :active="filter == STATUSES.VIEWED"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        Viewed
                                    </NavLink>
                                </div>
                                <div @click="() => filter = STATUSES.ACCEPTED">
                                    <NavLink :href="route('projects.applications.index', { project: project.id })"
                                        :active="filter == STATUSES.ACCEPTED"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        Accepted
                                    </NavLink>
                                </div>
                                <div @click="() => filter = STATUSES.REJECTED">
                                    <NavLink :href="route('projects.applications.index', { project: project.id })"
                                        :active="filter == STATUSES.REJECTED"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        Rejected
                                    </NavLink>
                                </div>
                            </div>
                        </div>
                        <div v-if="applications.data.length" class="flex flex-col gap-y-3">
                            <ApplicationList :applications="applications.data" :project="project"></ApplicationList>
                            <Pagination class="m-auto mt-10" :links="applications.links"></Pagination>
                        </div>
                        <div v-else class="flex flex-col gap-y-3">
                            <p>No applications</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import ApplicationList from '@/Components/ApplicationList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { watch, ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';
import { Inertia } from '@inertiajs/inertia';
import { STATUSES } from '@/Constants/Application';

const props = defineProps({
    project: Object,
    applications: Object,
    team: Object,
    filter: String
})

let filter = ref(props.filter)

watch(filter, value => {
    Inertia.get('',
        { filter: value },
        { preserveState: true }
    )
})
</script>