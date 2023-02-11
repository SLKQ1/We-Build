<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.props.auth.user.name }}'s Applications
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-around p-6 bg-white border-b border-gray-200">
                        <NavLink class="text-center hover:bg-indigo-300 hover:rounded-md">
                            Your Applications
                        </NavLink>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-y-3">

                        <div class="flex flex-col items-center gap-y-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                Your Applications
                            </h2>
                            <div class="flex flex-row justify-between gap-5 mb-4">
                                <div @click="() => filter = null">
                                    <NavLink :href="route('dashboard.applications', {user: $page.props.auth.user.name})" :active="filter == null"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        All
                                    </NavLink>
                                </div>
                                <div @click="() => filter = STATUSES.PENDING">
                                    <NavLink :href="route('dashboard.applications', {user: $page.props.auth.user.name})" :active="filter == STATUSES.PENDING"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        Pending
                                    </NavLink>
                                </div>
                                <div @click="() => filter = STATUSES.ACCEPTED">
                                    <NavLink :href="route('dashboard.applications', {user: $page.props.auth.user.name})" :active="filter == STATUSES.ACCEPTED"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        Accepted
                                    </NavLink>
                                </div>
                                <div @click="() => filter = STATUSES.REJECTED">
                                    <NavLink :href="route('dashboard.applications', {user: $page.props.auth.user.name})" :active="filter == STATUSES.REJECTED"
                                        class="text-center hover:bg-indigo-300 hover:rounded-md">
                                        Rejected
                                    </NavLink>
                                </div>
                            </div>
                        </div>


                        <div v-for="application in applications.data" :key="application.id">
                            <Card :item="application">
                                <template v-slot:title>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ application.project.title }}
                                    </h5>
                                </template>
                                <template v-slot:description>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        You applied to this project.
                                    </p>
                                </template>
                                <template v-slot:button>
                                    <Link
                                        :href="route('projects.applications.show', { application: application.id, project: application.project.id })"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-400 rounded-lg hover:bg-indigo-600">
                                    Check it out!
                                    </Link>
                                </template>
                            </Card>
                        </div>
                        <div v-if="!applications.data.length" class="text-center text-2xl mb-4">
                            <p>No Applications</p>
                        </div>
                        <Pagination :links="applications.links" class="flex flex-col gap-y-3 items-center"></Pagination>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
import Card from '@/Components/Card.vue';
import { ref } from 'vue';
import { watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import NavLink from '@/Components/NavLink.vue';
import { STATUSES } from '@/Constants/Application';

const props = defineProps({
    applications: Object,
    filter: String, 
})

let filter = ref(props.filter)

watch(filter, value => {
    Inertia.get('',
        { filter: value },
        { preserveState: true }
    )
})
</script>