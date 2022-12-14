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
      <div v-if="$page.props.auth.user.id === project.user_id" class="flex justify-end space-x-2">
        <Link :href="route('projects.edit', { id: project.id })"
          class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
        Edit
        </Link>
      </div>
      <div class="flex flex-col gap-y-3 items-center justify-between">
        <div class="text-center text-gray-800 py-4">
          <h1 class="font-semibold underline text-5xl"> {{ project.title }} </h1>
          <p>
            <strong> Team size: </strong>
            <span>{{ currentTeamSize }}/{{ project.team_size }}</span>
          </p>
          <p>
            <strong> Due: </strong>
            <span>{{ formattedDueDate }} </span>
          </p>
        </div>
        <div>
          <p v-html="project.description">
          </p>
        </div>
        <Link v-if="$page.props.auth.user.id !== project.user_id" :href="route('applications.create', {project_id: project.id})"
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
      <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4"> {{ project.title }} </h1>
      <div>
        <p v-html="project.description">
        </p>
      </div>
      <button type="submit"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
        Apply to project
      </button>
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

const props = defineProps({
  project: Object,
  currentTeamSize: Number,
})

const formattedDueDate = moment(props.project.due).format('YYYY-MM-DD')
</script>