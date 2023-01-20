<template>
    <Leaderboards>

        <div class="flex justify-center pb-5">
            <NavLink :href="route('userLeaderboards')" :active="route().current('userLeaderboards')"
                class="text-center hover:bg-indigo-300 hover:rounded-md mx-10">
                View User Leaderboards
            </NavLink>
            <NavLink :href="route('teamLeaderboards')" :active="route().current('teamLeaderboards')"
                class="text-center hover:bg-indigo-300 hover:rounded-md mx-10">
                View Team Leaderboards
            </NavLink>
        </div>

        <table class="mx-5 text-lg text-left text-gray-800">
            <thead class="text-xs text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Rank
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Project Title
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Team Size
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Points
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, i) in leaderboards" :key="i" @click="goToProject(row.id)" class="border-b dark:border-gray-700 hover:bg-indigo-200">
                    <th scope="row" class="py-3 px-6">{{ i + 1 }}</th>
                    <th scope="row" class="py-3 px-6"> {{ row.title }}</th>
                    <th scope="row" class="py-3 px-6"> {{ row.team_size }}</th>
                    <th scope="row" class="py-3 px-6"> {{ row.points }}</th>
                </tr>
            </tbody>
        </table>
    </Leaderboards>
</template>

<script setup>
import Leaderboards from "./Leaderboards.vue";
import NavLink from "@/Components/NavLink.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    leaderboards: Object,
})

function goToProject(id) {
    Inertia.get(`/projects/${id}`)
}
</script>