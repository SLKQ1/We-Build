<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import Card from "@/Components/Card.vue";
import ProjectList from "@/Components/ProjectList.vue";
import {ref} from "vue";

let dashboardViewToDisplay = ref(3);

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-around p-6 bg-white border-b border-gray-200">
                        <Card @card-clicked="(cardId) => dashboardViewToDisplay = cardId" class="basis-1/4" :project="{id: 1, title: 'Team Points: 100', description: 'Points you have earned from working on projects with a team.'}"></Card>
                        <Card @card-clicked="(cardId) => dashboardViewToDisplay = cardId" class="basis-1/4" :project="{id: 2, title: 'Your Points: 150', description: 'Points your team has given you.'}"></Card>
                        <Card @card-clicked="(cardId) => dashboardViewToDisplay = cardId" class="basis-1/4" :project="{id: 3, title: 'Projects: 3', description: 'Projects you are a part of or have applied to.'}"></Card>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-if="dashboardViewToDisplay === 1" class="flex flex-col items-center gap-y-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                Team Points
                            </h2>
                        </div>
                        <div v-if="dashboardViewToDisplay === 2" class="flex flex-col items-center gap-y-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                Your Points
                            </h2>
                        </div>
                        <div v-if="dashboardViewToDisplay === 3" class="flex flex-col items-center gap-y-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                Your Projects
                            </h2>
                            <ProjectList></ProjectList>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
