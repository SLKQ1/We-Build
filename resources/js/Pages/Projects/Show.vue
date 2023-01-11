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
      <div v-if="$page.props.auth.user.id === project.user_id && project.status === STATUSES.OPEN"
        class="flex justify-between">
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

      <div v-if="$page.props.auth.user.id === project.user_id && project.status === STATUSES.IN_PROGRESS"
        class="flex justify-end">
        <div class="space-x-2">
          <Link :href="route('projects.complete', { id: project.id })"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
          Complete Project
          </Link>
        </div>
      </div>

      <div>
        <div class="flex justify-between items-center mx-20">
          <font-awesome-icon icon="fa-solid fa-thumbs-down" size="3x" class="text-red-700 cursor-pointer" />
          <div class="flex flex-col gap-2">
            <div class="text-center text-red-900">
              <font-awesome-icon icon="fa-solid fa-meteor" size="3x" />
              <span>4</span>
            </div>
            <h1 class="font-semibold underline text-5xl"> {{ project.title }} </h1>
          </div>
          <font-awesome-icon icon="fa-solid fa-thumbs-up" size="3x" class="text-green-700 cursor-pointer"/>
        </div>
        <div class="flex flex-col gap-y-3 items-center justify-between">
          <div class="text-center text-gray-800 py-4">
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
            <div class="flex flex-col gap-2">
              <h2 class="underline">Project Links</h2>
              <a :href="project.project_link_1">Link 1: 
                <span class="text-blue-700">
                  {{ project.project_link_1 }}
                </span>
              </a>
              <a :href="project.project_link_2">Link 2: 
                <span class="text-blue-700">
                  {{ project.project_link_2 }}
                </span>
              </a>
            </div>
          </div>
          <Link v-if="canApplyToProject()" :href="route('projects.applications.create', { project: project.id })"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
          Apply to project
          </Link>
        </div>
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
      <Link :href="route('projects.applications.create', { project: project.id })"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
      Apply to project
      </Link>
    </div>

    </html>
  </GuestLayout>
</template>

<script setup>
import { Head, usePage } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
import { Inertia } from '@inertiajs/inertia';
import { STATUSES } from '@/Constants/Project';

const props = defineProps({
  project: Object,
  currentTeamSize: Number,
  hasApplied: Boolean,
})

const formattedDueDate = moment(props.project.due).format('YYYY-MM-DD')

function destroy(id) {
  if (confirm("Are you sure you want to delete this project?")) {
    Inertia.delete(route("projects.destroy", { id: props.project.id }));
  }
}

function isTeamFull() {
  return props.project.team_size === props.currentTeamSize
}

function canApplyToProject() {
  return usePage().props.value.auth.user.id !== props.project.user_id
    && !props.hasApplied
    && props.currentTeamSize !== props.project.team_size
    && !props.project.due
}
</script>