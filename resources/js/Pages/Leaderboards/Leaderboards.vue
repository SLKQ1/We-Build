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
                            <slot />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <GuestLayout v-else>
        <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">Leaderboards</h1>

        <div class="flex flex-col overflow-x-auto rounded-lg">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-col overflow-x-auto rounded-lg">
                                <slot />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
