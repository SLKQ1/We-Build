<template>
    <body class="flex flex-col items-center justify-center w-screen min-h-[80vh] text-gray-800 p-10">
        <!-- Component Start -->
        <div class="flex flex-col flex-grow w-full max-w-xl bg-gray-700 shadow-xl rounded-lg overflow-hidden">
            <div class="flex flex-col flex-grow h-0 p-4 overflow-auto">
                <ChatMessages :messages="messages"></ChatMessages>
            </div>

            <ChatForm v-on:messagesent="addMessage" :user="$page.props.auth.user"></ChatForm>
        </div>
        <!-- Component End  -->
    </body>
</template>

<script setup>
import ChatMessages from './ChatMessages.vue';
import ChatForm from './ChatForm.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const props = defineProps({
    messages: Object,
})

console.log(document.getElementById('container'))

function addMessage(message) {
    props.messages.push(message)
    axios.post('/messages',  message ).then(response => {
        console.log(response.data)
    })
}

window.Echo.private('chat')
  .listen('MessageSent', (e) => {
    props.messages.push({
      message: e.message.message,
      user: e.user
    });
  });
</script>
