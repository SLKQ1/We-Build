<template>
    <Head title="Create Project"></Head>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a project
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-col gap-y-3">
                                <div>
                                    <InputLabel for="title" value="Project Title" />
                                    <TextInput id="title" type="text" placeholder="Enter project title here"
                                        v-model="form.title" class="mt-1 block w-full" required autofocus />
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                                <div>
                                    <InputLabel for="team_size" value="Team Size" />
                                    <TextInput id="team_size" type="number" class="mt-1 block w-full"
                                        v-model="form.team_size" min="1" max="10" required autofocus />
                                    <InputError class="mt-2" :message="form.errors.team_size" />
                                    <p v-if="form.team_size == 1" class="text-yellow-700"> 
                                        * Team size of 1 means you are the only person in this project. The project will be started as soon as you publish it.
                                    </p>
                                </div>
                                <div>
                                    <InputLabel class="text-lg" for="resume">
                                        <h3>Description Guidelines:</h3>
                                        <ul class="pl-2">
                                            <li>Describe your project</li>
                                            <li>What is the inspiration for your project?</li>
                                            <li>What kind of teammates are you looking for? (If applicable)</li>
                                        </ul>
                                    </InputLabel>
                                    <EditorVue ref="editorReference" />
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                                <div v-if="form.team_size < 2">
                                    <InputLabel for="due" value="Due Date" />
                                    <TextInput id="due" type="date" class="mt-1 block w-full" v-model="form.due"
                                        required autofocus />
                                    <InputError class="mt-2" :message="form.errors.due" />
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-5 mt-3 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Publish Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditorVue from '@/Components/Editor.vue';
import { STATUSES } from '@/Constants/Project';

const editorReference = ref(null)

const form = useForm({
    title: null,
    description: null,
    team_size: 1,
    due: null,
    status: STATUSES.OPEN, 
})

function submit() {
    form.description = editorReference.value.getEditorContentAsJson()
    form.post('/projects')
}
</script>