<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ chat.name }} Chat
            </h2>
        </template>
        <Chat :chat="chat"></Chat>
    </AuthenticatedLayout>
</template>

<script setup>
import Chat from '@/Components/Chat.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


const props = defineProps({
    chat: Object,
})
</script>
