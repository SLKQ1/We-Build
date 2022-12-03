<template>
  <GuestLayout>
    <div class="flex flex-col gap-y-3 items-center justify-between">
      <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4"> {{project.title}} </h1>
      <div>
        <p>
         {{project.description}}
        </p>
      </div>
      <button type="submit"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-indigo-400 hover:bg-indigo-600 rounded-lg">
        Apply to project
      </button>
    </div>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
    project: Object,
})
</script>