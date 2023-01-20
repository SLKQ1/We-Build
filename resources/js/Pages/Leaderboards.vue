<template>

    <Head title="Leaderboards"></Head>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Leaderboards
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col overflow-x-auto rounded-lg">
                            <table class="mx-5 text-lg text-left text-gray-800">
                                <thead
                                    class="text-xs text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Rank
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            User Name
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Points
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, i) in leaderboards" :key="i"
                                        class="border-b dark:border-gray-700 hover:bg-indigo-200">
                                        <th scope="row" class="py-3 px-6">{{ i + 1 }}</th>
                                        <th scope="row" class="py-3 px-6"> {{ row.name }}</th>
                                        <th scope="row" class="py-3 px-6"> {{ row.total_points }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <GuestLayout>
        <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">Leaderboards</h1>

        <div class="flex flex-col overflow-x-auto rounded-lg">
            <table class="mx-5 text-lg text-left text-gray-800">
                <thead class="text-xs text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Rank
                        </th>
                        <th scope="col" class="py-3 px-6">
                            User Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Points
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, i) in leaderboards" :key="i"
                        class="border-b dark:border-gray-700 hover:bg-indigo-200">
                        <th scope="row" class="py-3 px-6">{{ i + 1 }}</th>
                        <th scope="row" class="py-3 px-6"> {{ row.name }}</th>
                        <th scope="row" class="py-3 px-6"> {{ row.total_points }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    leaderboards: Object,
})

</script>
