<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Complete Project
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-col gap-y-5">
                                <h1 class="font-semibold text-3xl text-center underline"> Project Details </h1>
                                <html lang="en" class="list-disc">
                                <div class="flex flex-col gap-y-3 items-center justify-between">
                                    <h2>
                                        {{ project.title }}
                                    </h2>
                                    <div class="md:px-20">
                                        <p v-html="project.description">
                                        </p>
                                    </div>
                                </div>

                                </html>
                                <div>
                                    <h2 class="font-bold">Team</h2>
                                    <div class="border-2 p-4">
                                        <div v-for="member in team">
                                            <div class="border-b-2 border-b-gray-800">
                                                <p>Name: {{ member.name }}</p>
                                                <p>Email: {{ member.email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-3">
                                    <h2 class="font-bold">Project Links</h2>
                                    <InputLabel for="project_link_1" value="Project Link 1 (Required)" />
                                    <TextInput id="project_link_1" type="url" class="mt-1 block w-1/3"
                                        v-model="form.project_link_1" required autofocus />
                                    <InputError class="mt-2" :message="form.errors.project_link_2" />
                                    <InputLabel for="project_link_2" value="Project Link 2 (Optional)" />
                                    <TextInput id="project_link_2" type="url" class="mt-1 block w-1/3"
                                        v-model="form.project_link_2" autofocus />
                                    <InputError class="mt-2" :message="form.errors.project_link_2" />
                                </div>

                                <div>
                                    <h2 class="text-center font-bold">Submission</h2>
                                    <div class="flex flex-row justify-around">
                                        <div class="flex flex-col gap-2">
                                            <p class="font-semibold">Project due date: {{ formatDate(project.due) }}</p>
                                            <p class="font-semibold">Project submission date: {{
                                                formatDate(currentDate)
                                            }} </p>
                                            <p v-if="status == SUBMISSION_STATUSES.ON_TIME" class="font-semibold text-green-700"> Days early: {{ diffDays }}
                                            </p>
                                            <p v-else="status == SUBMISSION_STATUSES.LATE" class="font-semibold text-red-700"> Days late: {{ diffDays }}
                                            </p>
                                        </div>
                                        <div class="flex flex-row gap-2 items-center font-bold text-red-900 text-2xl">
                                            <font-awesome-icon icon="fa-solid fa-meteor" size="3x" />
                                            <p> {{ multiplier }} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit"
                                        class="inline-flex items-center px-5 mt-3 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg"
                                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Start Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { STATUSES } from '@/Constants/Project';
import { formatDate } from '@/Composables/formatDateYMD';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { SUBMISSION_STATUSES } from '@/Constants/Project';

const props = defineProps({
    project: Object,
    team: Object,
    diffDays: Number, 
    multiplier: Number, 
    status: String
})

const currentDate = new Date();

const form = useForm({
    title: props.project.title,
    description: props.project.description,
    team_size: props.project.team_size,
    due: props.project.due,
    status: STATUSES.DONE,
    project_link_1: null,
    project_link_2: null,
})

function submit() {
    form.put(route('projects.update', props.project.id))
}
</script>