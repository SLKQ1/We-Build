<template>
  <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
    Project Title
  </h2>

  <div class="flex flex-col justify-around md:flex-row">
    <div class="flex-grow basis-1/2 px-5 my-5 md:my-0">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Description
      </h2>
      <EditorVue />
    </div>

    <div class="basis-1/3 px-5 text-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Project Info
      </h2>
    </div>
  </div>

</template>

<script setup>
import EditorVue from '@/Components/Editor.vue';


</script>

<style>

</style>