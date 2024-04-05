<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';

const form = useForm({
  type: 'Text',
  searchTerm: '',
});

</script>

<template>
  <Head title="Search" />

  <AuthenticatedLayout>
    <!-- Page Heading -->
    <div class="flex items-center justify-center p-2">
      <h2 class="text-2xl font-bold">Search</h2>
    </div>

    <!-- Search Form -->
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <form @submit.prevent="form.post(route('thoughts.search'), { onSuccess: () => form.reset() })">
        <div class="py-2">
          <label for="type" class="mt-5 font-bold italic">Type:</label>
          <select
              id="type"
              v-model="form.type"
              class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
              >
            <option value="thoughts">Text</option>
            <option value="tags">Tag</option>
            <option value="users">User</option>
          </select>
        </div>
        <div class="py-2">
          <label for="searchTerm" class="mt-5 font-bold italic">Search Term:</label>
          <textarea
            id="searchTerm"
            v-model="form.searchTerm"
            placeholder="What are you looking for?"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
          </textarea>
        </div>
        <div>
          <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
        </div>
      </form>
    </div>
   </AuthenticatedLayout>

</template>
