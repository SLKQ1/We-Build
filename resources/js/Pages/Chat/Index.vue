<template>
    <AuthenticatedLayout>
        <Chat :messages="messages"></Chat>
    </AuthenticatedLayout>
</template>

<script setup>
import Chat from '@/Components/Chat.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


const props = defineProps({
    messages: Object,
})
</script>
