<template>
    <Head title="Edit Project"></Head>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ project.title }}
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
                                </div>
                                <div>
                                    <EditorVue ref="editorReference" :description="form.description" />
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
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditorVue from '@/Components/Editor.vue';
import moment from 'moment';
import { ref } from 'vue';

const editorReference = ref(null)

const props = defineProps({
    project: Object 
})

const form = useForm({
    title: props.project.title,
    description: props.project.description,
    team_size: props.project.team_size,
    due: props.project.due ? moment(props.project.due).format('YYYY-MM-DD') : null, 
    status: props.project.status, 
})

function submit() {
    form.description = editorReference.value.getEditorContentAsJson()
    form.put(route('projects.update', props.project.id))
}
</script>