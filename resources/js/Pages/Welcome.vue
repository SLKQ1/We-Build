<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import NavBar from '@/Layouts/GuestNavBar.vue';

</script>

<template>
    <Head>
        <title>We Build</title>
    </Head>
    <!-- Navbar -->
    <NavBar></NavBar>
    <!-- Hero section -->
    <section id="hero">
        <!-- Flex Container -->
        <div class="container flex flex-col-reverse items-center px-6 mx-auto mt-10 space-y-0 md:flex-row md:space-y-0">
            <!-- left item -->
            <div class="flex flex-col mb-32 space-y-12 md:w-1/2">
                <h1 class="max-w-md text-4xl font-bold text-center md:text-5xl md:text-left">
                    Bring everyone together and build the projects you want to build
                </h1>
                <p class="max-w-sm text-center text-gray-700 md:text-left">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur cum debitis dicta doloribus eos
                    ex ipsa ipsam laboriosam libero magnam minima, neque omnis porro provident quae quaerat quia
                    quisquam quod!
                </p>
                <!-- Get started -->
                <div class="flex justify-center md:justify-start">
                    <Link
                        :href="route('register')"
                        class="hidden p-3 px-6 text-white bg-indigo-400 rounded-full hover:bg-indigo-600 cursor-pointer md:block">
                        Get Started
                    </Link>
                </div>
            </div>
            <!-- Image -->
            <div class="md:w-1/2">
                <img alt="People building with blocks" :src="'/images/building-image.jpg'">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features">
        <!-- Flex Container -->
        <div class="container flex flex-col px-4 py-4 mx-auto mt-10 space-y-12 md:space-y-0 md:flex-row">
            <!-- Features -->
            <div class="flex flex-col space-y-12 md:w-1/2">
                <h2 class="max-w-md text-4xl font-bold text-center md:text-left">
                    What does We Build offer you?
                </h2>
                <p class="max-w-sm text-center text-gray-700 md:text-left">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto assumenda commodi debitis
                    doloremque id, ipsam iste necessitatibus praesentium quidem saepe voluptatem. Culpa earum
                    exercitationem nisi nulla porro reiciendis voluptates.
                </p>
            </div>
            <!-- Numbered List -->
            <div class="flex flex-col space-y-8 md:w-1/2">
                <!-- List item 1 -->
                <div class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row">
                    <!-- Heading -->
                    <div class="rounded-l-full bg-indigo-200 md:bg-transparent">
                        <div class="flex items-center space-x-2">
                            <div class="px-4 py-2 text-white rounded-full bg-indigo-400 md:py-1">
                                01
                            </div>
                            <h3 class="text-base font-bold md:mb-4 md:hidden">
                                Build the projects you want
                            </h3>
                        </div>
                    </div>
                    <div>
                        <h3 class="hidden mb-4 text-lg font-bold md:block">
                            Build the projects you want
                        </h3>
                        <p class="text-gray-700">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Aliquid asperiores, assumenda beatae distinctio dolorem ducimus exercitationem harum illo
                            laboriosam libero minima minus nostrum, numquam provident repellat saepe sint ut vitae?
                        </p>
                    </div>
                </div>
                <!-- List item 2 -->
                <div class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row">
                    <!-- Heading -->
                    <div class="rounded-l-full bg-indigo-200 md:bg-transparent">
                        <div class="flex items-center space-x-2">
                            <div class="px-4 py-2 text-white rounded-full bg-indigo-400 md:py-1">
                                02
                            </div>
                            <h3 class="text-base font-bold md:mb-4 md:hidden">
                                Collaborate on teams
                            </h3>
                        </div>
                    </div>
                    <div>
                        <h3 class="hidden mb-4 text-lg font-bold md:block">
                            Collaborate on teams
                        </h3>
                        <p class="text-gray-700">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Aliquid asperiores, assumenda beatae distinctio dolorem ducimus exercitationem harum illo
                            laboriosam libero minima minus nostrum, numquam provident repellat saepe sint ut vitae?
                        </p>
                    </div>
                </div>
                <!-- List item 3 -->
                <div class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row">
                    <!-- Heading -->
                    <div class="rounded-l-full bg-indigo-200 md:bg-transparent">
                        <div class="flex items-center space-x-2">
                            <div class="px-4 py-2 text-white rounded-full bg-indigo-400 md:py-1">
                                03
                            </div>
                            <h3 class="text-base font-bold md:mb-4 md:hidden">
                                Beef up your resume while making friends
                            </h3>
                        </div>
                    </div>
                    <div>
                        <h3 class="hidden mb-4 text-lg font-bold md:block">
                            Beef up your resume while making friends
                        </h3>
                        <p class="text-gray-700">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Aliquid asperiores, assumenda beatae distinctio dolorem ducimus exercitationem harum illo
                            laboriosam libero minima minus nostrum, numquam provident repellat saepe sint ut vitae?
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA section -->
    <section id="cta" class="bg-indigo-400">
        <!-- Flex Container -->
        <div
            class="container flex flex-col items-center justify-between px-6 py-24 mx-auto space-y-12 md:py-12 md:flex-row md:space-y-0">
            <h2 class="text-5xl font-bold leading-tight text-center text-white md:text-4xl md:max-w-xl md:text-left">
                Join We Build today!
            </h2>
            <!-- Get started -->
            <div class="flex justify-center md:justify-start">
                <Link
                    :href="route('register')"
                    class="p-3 px-6 pt-2 bg-white text-indigo-400 rounded-full shadow-2xl baseline hover:bg-indigo-900">
                    Get Started
                </Link>
            </div>
        </div>
    </section>
</template>
