<template>
    <div v-for="application in applications" :key="application.id">
        <Card :item="application">
            <template v-slot:title>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ application.user.name }} </h5>
            </template>
            <template v-slot:description>
                <p class="mb-3 font-normal dark:text-gray-400"> {{ application.user.name }} applied to your project! </p>
            </template>
            <template v-slot:button>
                <Link :href="route('projects.applications.show', { application: application.id, project: project.id })"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-400 rounded-lg hover:bg-indigo-600">
                Check it out!
                </Link>
            </template>
        </Card>
    </div>
</template>

<script setup>
import Card from "@/Components/Card.vue";
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
    applications: Object, 
    project: Object, 
})
</script>
