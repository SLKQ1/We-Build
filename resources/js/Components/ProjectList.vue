<template>
    <div v-for="project in projects" :key="project.id">
        <Card :project="project"></Card>
    </div>
</template>

<script setup>
import Card from "@/Components/Card.vue";

const props = defineProps({
    projects: Object
})
</script>
