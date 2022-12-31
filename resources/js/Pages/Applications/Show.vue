<template>

    <Head title="View Application"></Head>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Application for {{ project.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col justify-around p-6 bg-white border-b border-gray-200">

                        <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">{{ user }}'s Application</h1>

                        <div>
                            <h2 class="underline">Description</h2>
                            <div v-if="application.description">
                                <html lang="en" class="list-disc">
                                <p v-html="application.description"></p>

                                </html>
                            </div>
                            <p v-else> No Description</p>
                        </div>
                        <div>
                            <h2 class="underline">Resume</h2>
                            <div>
                                <a
                                    :href="route('projects.applications.downloadResume', { project: project.id, application: application.id })">
                                    <font-awesome-icon icon="fa-download" />
                                    Download Resume
                                </a>
                            </div>
                        </div>
                        <div v-if="isProjectOwner()" class="flex flex-row mx-auto gap-4">
                            <div @click="acceptApplication"
                                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 hover:cursor-pointer rounded-lg">
                                Accept
                            </div>
                            <div @click="rejectApplication"
                                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-red-600 hover:bg-red-800 hover:cursor-pointer rounded-lg">
                                Reject
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    application: Object,
    project: Object,
    user: String,
})

const form = useForm({
    status: 0, 
})

function acceptApplication() {
    form.status = 1
    Inertia.put(route("projects.applications.accept", { project: props.project.id, application: props.application.id}));
}

function rejectApplication() {
    form.status = 1
}

function isProjectOwner() {
    return usePage().props.value.auth.user.id === props.project.user_id
}
</script>