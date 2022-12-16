<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Start Project
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-col gap-y-3">
                                <div>
                                    <h1 class="font-semibold text-3xl text-center underline"> Select a Due Date </h1>
                                    <InputLabel for="due" value="Due Date" />
                                    <TextInput id="due" type="date" class="mt-1 block w-full" v-model="form.due"
                                        required autofocus />
                                    <InputError class="mt-2" :message="form.errors.due" />
                                </div>
                                <div>
                                    <h1 class="font-semibold text-3xl text-center underline"> Project Details </h1>
                                    <html lang="en" class="list-disc">
                                    <div class="flex flex-col gap-y-3 items-center justify-between">
                                        <h2>
                                            {{ project.title }}
                                        </h2>
                                        <div>
                                            <p v-html="project.description">
                                            </p>
                                        </div>
                                    </div>

                                    </html>
                                    <div>
                                        <h2>Team</h2>
                                        <div class="border-2 p-4">
                                            <div v-for="member in team">
                                                <div class="border-b-2 border-b-gray-800">
                                                    <p>Name: {{ member.name }}</p>
                                                    <p>Email: {{ member.email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-5 mt-3 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Start Project
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
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    project: Object,
    team: Object,
})

const form = useForm({
    title: props.project.title,
    description: props.project.description,
    team_size: props.project.team_size,
    due: null,
})

function submit() {
    form.put(route('projects.update', props.project.id))
}
</script>