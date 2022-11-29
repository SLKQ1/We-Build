<template>
      <AuthenticatedLayout v-if="$page.props.auth.user">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Project X
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex flex-col gap-y-3">
              <TextInput id="name" type="text" placeholder="Enter project name here" class="mt-1 block w-full" required autofocus
                autocomplete="name" />
              <EditorVue />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditorVue from '@/Components/Editor.vue';
import TextInput from '@/Components/TextInput.vue';
</script>