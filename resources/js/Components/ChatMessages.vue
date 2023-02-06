<template>
    <div v-for="message in messages" :key="message.id" :id="message.id">
        <div v-if="isAuthenticatedUserMessage(message)" class="flex w-full mt-2 space-x-3 max-w-xs ml-auto justify-end">
            <div>
                <div class="bg-blue-600 text-white p-3 rounded-l-lg rounded-br-lg">
                    <p class="text-sm">
                        {{ message.message }}
                    </p>
                </div>
                <span class="text-xs text-gray-300 leading-none">
                    {{ moment(message.created_at).fromNow() }}
                </span>
            </div>
            <div class="flex flex-col text-center">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-300"></div>
                <p class=" text-gray-200">
                    {{ useTruncate(message.user.name, 5, '...') }}
                </p>
            </div>
        </div>
        <div v-else class="flex w-full mt-2 space-x-3 max-w-xs">
            <div class="flex flex-col text-center">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-500"></div>
                <p class="text-gray-200">
                    {{ useTruncate(message.user.name, 5, '...') }}
                </p>
            </div>
            <div>
                <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                    <p class="text-sm">
                        {{ message.message }}
                    </p>
                </div>
                <span class="text-xs text-gray-300 leading-none">
                    {{ moment(message.created_at).fromNow() }}
                </span>
            </div>
        </div>
        <div ref="bottom"></div>
    </div>
    <div class="p-10"></div>
</template>

<script setup>
import moment from 'moment';
import { useTruncate } from '@/Composables/truncateStrings';
import { onMounted, ref, watch } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    messages: Object,
    users: Object,
})

const bottom = ref(null)
onMounted(() => {
    if (props.messages.length) {
        bottom.value[props.messages.length - 1].scrollIntoView()
    }
})

watch(props.messages, () => {
    if (props.messages.length > 2) {
        bottom.value[props.messages.length - 2].scrollIntoView()
    }
})


function isAuthenticatedUserMessage(message) {
    return usePage().props.value.auth.user.id === message.user.id
}
</script>