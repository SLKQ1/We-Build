<template>
    <div
        class="flex flex-col m-auto max-w-xs p-6 border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 md:max-w-2xl">
        <a href="#">
            <slot name="title" />
        </a>
        <div>
            <slot name="description" />
        </div>
        <div class="mt-auto">
            <slot name="button" />
        </div>
    </div>
</template>

<script setup>
import { useTruncate } from "@/Composables/truncateStrings";
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
    item: Object,
})

if (props.item.description) {
    const description = useTruncate(props.item.description, 200, '...')
}
</script>

