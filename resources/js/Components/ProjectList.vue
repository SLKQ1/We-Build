<template>
    <div v-for="project in projects" :key="project.id">
        <Card :item="project">
            <template v-slot:title>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ project.title }} </h5>
                <h3 v-if="project.status == STATUSES.DONE" class="text-white">Points {{ project.points }}</h3>
            </template>
            <template v-slot:description>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" v-html="useTruncate(project.description, 200, '...')"> </p>
            </template>
            <template v-slot:button>
                <Link :href="route('projects.show', { id: project.id })"
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
import { useTruncate } from "@/Composables/truncateStrings";
import { STATUSES } from "@/Constants/Project";

const props = defineProps({
    projects: Object
})
</script>
