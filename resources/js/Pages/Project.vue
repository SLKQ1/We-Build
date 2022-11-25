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

  <GuestLayout v-else>
    <div class="flex flex-col gap-y-3 items-center justify-between">
      <h1 class="font-semibold underline text-center text-5xl text-gray-800 py-4">Project X</h1>
      <div>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis quam quas sequi ipsum omnis incidunt
          vitae debitis? Veritatis dignissimos atque recusandae iste quibusdam iusto harum, modi dolore minima fuga
          voluptates.
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, quas laboriosam dolores eius fugiat neque
          eaque, voluptatum ea, numquam libero recusandae. Beatae suscipit recusandae nihil, voluptatum voluptate
          adipisci! Animi, quis?
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quasi deleniti non commodi velit et? Rerum, ab eos
          omnis dicta reiciendis deserunt expedita provident cum, fugiat, aperiam commodi culpa porro officiis.
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia hic eius id sunt iusto et iste
          aliquam, pariatur eveniet ut, perferendis, illum enim voluptatibus culpa animi aliquid magni cum!
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi harum nisi ducimus sapiente delectus,
          debitis sint tempora distinctio reprehenderit dicta? Quas deleniti inventore aut fugit obcaecati, omnis
          nostrum nam sapiente!
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditorVue from '@/Components/Editor.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

</script>