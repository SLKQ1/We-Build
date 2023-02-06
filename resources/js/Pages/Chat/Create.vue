<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-col gap-y-3">
                                <div>
                                    <InputLabel for="title" value="Chat Title" />
                                    <TextInput id="title" type="text" placeholder="Enter chat title"
                                        v-model="form.name" class="mt-1 block w-full" required autofocus />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-5 mt-3 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
                                Create Chat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    application: Object, 
    project: Object, 
})

function getSuggestedName() {
    if (props.application) {
        return `${props.application.project.title} - ${props.application.user.name}`
    } else {
        return `${props.application.project.title} Chat`
    }
}

const form = useForm({
    name: getSuggestedName(),
})

function submit() {
    Inertia.post(route('chat.store'), {application: props.application.id, name: form.name})
}
</script>