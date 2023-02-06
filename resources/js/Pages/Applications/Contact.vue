<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contact for {{ user.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-col gap-y-3">
                                <div>
                                    <InputLabel for="subject" value="Email Subject" />
                                    <TextInput id="subject" type="text" placeholder="Enter subject for email here"
                                        v-model="form.subject" class="mt-1 block w-full" required autofocus />
                                    <InputError class="mt-2" :message="form.errors.subject" />
                                </div>
                                <div>
                                    <Editor ref="editorReference" :description="form.description" />
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-5 mt-3 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Send Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import Editor from '@/Components/Editor.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const editorReference = ref(null)

const props = defineProps({
    project: Object,
    application: Object,
    user: Object,
})

const form = useForm({
    subject: `Re: ${props.project.title} application`,
    description: "",
})

function submit() {
    form.description = editorReference.value.getEditorContentAsJson()
    form.put(route('projects.update', props.project.id))
}
</script>