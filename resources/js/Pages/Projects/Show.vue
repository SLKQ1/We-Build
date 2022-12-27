<template>

  <Head title="View Project"></Head>
  <AuthenticatedLayout v-if="$page.props.auth.user">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ project.title }}
      </h2>
    </template>
    <html lang="en" class="list-disc">
    <div class="m-4">
      <div v-if="$page.props.auth.user.id === project.user_id && project.status === 0" class="flex justify-between">
        <div class="space-x-2">
          <div @click="destroy(project.id)"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-red-600 hover:bg-red-800 rounded-lg">
            Delete Project
          </div>
        </div>
        <div class="space-x-2">
          <Link :href="route('projects.applications.index', { project: project.id })"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
          See applications
          </Link>
          <Link :href="route('projects.edit', { id: project.id })"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-500 hover:bg-blue-700 rounded-lg">
          Edit
          </Link>
          <Link :href="route('projects.start', { id: project.id })"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 hover:bg-green-800 rounded-lg">
          Start Project
          </Link>
        </div>
      </div>
      <div class="flex flex-col gap-y-3 items-center justify-between">
        <div class="text-center text-gray-800 py-4">
          <h1 class="font-semibold underline text-5xl"> {{ project.title }} </h1>
          <p>
            <strong> Team size: </strong>
            <span>{{ currentTeamSize }}/{{ project.team_size }}</span>
          </p>
          <p v-if="project.due">
            <strong> Due: </strong>
            <span>{{ formattedDueDate }} </span>
          </p>
        </div>
        <div>
          <p v-html="project.description">
          </p>
        </div>
        <Link v-if="$page.props.auth.user.id !== project.user_id"
          :href="route('projects.applications.create', { project: project.id })"
          class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
        Apply to project
        </Link>
      </div>
    </div>

    </html>
  </AuthenticatedLayout>
  <GuestLayout v-else>
    <html lang="en" class="list-disc">
    <div class="flex flex-col gap-y-3 items-center justify-between">
      <div class="text-center text-gray-800 py-4">
        <h1 class="font-semibold underline text-5xl"> {{ project.title }} </h1>
        <p>
          <strong> Team size: </strong>
          <span>{{ currentTeamSize }}/{{ project.team_size }}</span>
        </p>
        <p v-if="project.due">
          <strong> Due: </strong>
          <span>{{ formattedDueDate }} </span>
        </p>
      </div>
      <div>
        <p v-html="project.description">
        </p>
      </div>
      <Link :href="route('applications.create', { project_id: project.id })"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
      Apply to project
      </Link>
    </div>

    </html>
  </GuestLayout>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  project: Object,
  currentTeamSize: Number,
})

const formattedDueDate = moment(props.project.due).format('YYYY-MM-DD')

function destroy(id) {
  if (confirm("Are you sure you want to delete this project?")) {
    Inertia.delete(route("projects.destroy", { id: props.project.id }));
  }
}
</script>