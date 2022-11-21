<template>
    <!-- Navbar -->
    <nav class="relative container mx-auto p-6">
        <!-- Flex container -->
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div>
                <Link href="/">
                    <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                </Link>
            </div>
            <!-- Nav menu items -->
            <div class="hidden space-x-6 md:flex">
                <a class="hover:text-gray-400 cursor-pointer">About Us</a>
                <a :href="route('projects')" class="hover:text-gray-400 cursor-pointer">Projects</a>
                <a :href="route('leaderboards')" class="hover:text-gray-400 cursor-pointer">Leaderboards</a>
            </div>
            <!-- Get started -->
            <Link
                :href="route('register')"
                class="hidden p-3 px-6 text-white bg-indigo-400 rounded-full hover:bg-indigo-600 cursor-pointer md:block">
                Get Started
            </Link>

            <!-- Hamburger Icon -->
            <button id="menu-btn" @click="toggleHamburger" :class="{open: isHamburgerToggled}"
                    class="block hamburger md:hidden focus:outline-none">
                <span class="hamburger-top"></span>
                <span class="hamburger-middle"></span>
                <span class="hamburger-bottom"></span>
            </button>
        </div>

        <!-- Mobile Manu -->
        <div class="md:hidden">
            <div id="menu"
                 :class="{hidden: !isHamburgerToggled, flex: isHamburgerToggled}"
                 class="absolute flex-col items-center self-end py-8 mt-10 space-y-6 font-bold bg-white sm:w-auto sm:self-center left-6 right-6 drop-shadow-md">
                <a href="#">About Us</a>
                <a :href="route('projects')">Projects</a>
                <a :href="route('leaderboards')">Leaderboards</a>
                <a :href="route('register')">Get Started</a>
            </div>
        </div>
    </nav>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import {ref} from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const isHamburgerToggled = ref(false)

function toggleHamburger() {
    isHamburgerToggled.value = !isHamburgerToggled.value
}
</script>

