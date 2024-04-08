<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import PostNotification from "@/Components/PostNotification.vue";
defineProps(['flash'])
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

    <!-- Display Post Notification if there is something in session('message')-->
    <div v-if="flash.message" class="pt-1">
      <PostNotification :message="flash.message" :key="Date.now()"/>
    </div>

    <!-- Search Form -->
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <form @submit.prevent="form.post(route('search/results'), { onSuccess: () => form.reset() })">
        <div class="py-2">
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
