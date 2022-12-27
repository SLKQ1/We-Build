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
                        <div class="flex flex-col gap-y-3">
                            <ApplicationList :applications="applications.data" :project="project"></ApplicationList>
                            <Pagination class="m-auto mt-10" :links="applications.links"></Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import ProjectList from '@/Components/ProjectList.vue';
import ApplicationList from '@/Components/ApplicationList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
    project: Object,
    applications: Object,
})
</script>