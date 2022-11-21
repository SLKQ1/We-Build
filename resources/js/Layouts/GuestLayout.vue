<script setup>
import GuestNavBar from '@/Layouts/GuestNavBar.vue'
</script>

<template>
    <GuestNavBar></GuestNavBar>
    <div class="min-h-screen bg-gray-100">
        <div class="flex flex-col items-center pt-6 sm:pt-0">
            <div v-if="$slots.authPages"
                 class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <slot name="authPages"/>
            </div>
        </div>

        <div>
            <slot />
        </div>
    </div>
</template>
