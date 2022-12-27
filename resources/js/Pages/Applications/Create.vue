<template>

    <Head title="Apply to Project"></Head>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Apply to {{ project.title }}
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-col gap-y-3">
                                <div>
                                    <InputLabel class="text-lg" for="resume" value="Please provide a description of why you would like to join this project. (Optional)" />
                                    <EditorVue ref="editorReference" />
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                                <div>
                                    <InputLabel class="text-lg" for="resume" value="Please upload your resume (Required)" />
                                    <input type="file"
                                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        @input="form.resume = $event.target.files[0]" />
                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">Please upload a PDF file.
                                    </p>
                                    <InputError class="mt-2" :message="form.errors.resume" />
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                        {{ form.progress.percentage }}%
                                    </progress>
                                </div>
                            </div>


                            <button type="submit"
                                class="inline-flex items-center px-5 mt-3 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Apply to project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import EditorVue from '@/Components/Editor.vue';
import { ref } from 'vue';

const props = defineProps({
    project: Object,
})

const editorReference = ref(null)

const form = useForm({
    project_id: props.project.id,
    description: null,
    resume: null

})

function submit() {
    form.description = editorReference.value.getEditorContentAsJson()
    form.post('store')
}
</script>