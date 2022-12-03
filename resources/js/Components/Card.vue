<template>
    <div class="flex flex-col max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 md:max-w-2xl">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{project.title}} </h5>
        </a>

        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"> {{description}}</p>

        <div class="mt-auto">
            <Link :href="route('projects.show', {id: project.id})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-400 rounded-lg hover:bg-indigo-600">
                Check it out!
            </Link>
        </div>
    </div>
</template>

<script setup>
import {useTruncate} from "@/Composables/truncateStrings";
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
    project: Object
})
const description = useTruncate(props.project.description, 200, '...')
</script>
