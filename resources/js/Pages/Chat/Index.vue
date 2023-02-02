<template>
    <AuthenticatedLayout>
        <Chat :chat="chat"></Chat>
    </AuthenticatedLayout>
</template>

<script setup>
import Chat from '@/Components/Chat.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


const props = defineProps({
    chat: Object,
})

console.log(props.chat)
</script>
