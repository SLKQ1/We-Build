<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Applications
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-around p-6 bg-white border-b border-gray-200">
                        <Link class="basis-1/4 text-center hover:bg-indigo-300 hover:rounded-md">
                        Your Applications
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-y-3">

                        <div class="flex flex-col items-center gap-y-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                Your Applications
                            </h2>
                            <div class="flex flex-row justify-between gap-1">
                                <div @click="() => filter = null"
                                    class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                                    All
                                </div>
                                <div @click="() => filter = 0"
                                    class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                                    Pending
                                </div>
                                <div @click="() => filter = 1"
                                    class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                                    Accepted
                                </div>
                                <div @click="() => filter = 3"
                                    class="basis-1/4 hover:bg-indigo-300 hover:rounded-md cursor-pointer px-5 underline">
                                    Rejected
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
import ApplicationList from '@/Components/ApplicationList.vue';
import Card from '@/Components/Card.vue';
const props = defineProps({
    applications: Object,
})
</script>