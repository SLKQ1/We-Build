<template>
    <form @submit.prevent="sendMessage" class="bg-gray-600 p-4 flex flex-col">
        <textarea v-model="newMessage"
            class=" w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            placeholder="Type your message…" rows="5" cols="50">
        </textarea>
        <div class="flex justify-end mt-4">
            <PrimaryButton class=""> Send </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import PrimaryButton from './PrimaryButton.vue';

const emit = defineEmits([
    'messagesent'
])

let newMessage = ref('')

function sendMessage() {
    emit('messagesent', { user: usePage().props.value.auth.user, message: newMessage.value })
    newMessage.value = ""
}
</script>