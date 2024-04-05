<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Thought from '@/Components/ResultThought.vue';
// import PostNotification from "@/Components/PostNotification.vue";
import {Head, Link} from '@inertiajs/vue3';
defineProps(['type', 'term', 'results'])
const pageTitle = 'Search Results';
</script>

<template>
<Head title="Search Results" />
<AuthenticatedLayout>
    <!-- Page Heading -->
    <div class="flex items-center justify-center p-2">
      <h2 class="text-2xl font-bold">Search Results</h2>
    </div>
    <div class="flex items-center justify-center p-2">
      <p class="text-2xl font-bold">{{results}}</p>
    </div>
    <!-- Go Back Button -->
    <div class="flex items-center justify-center p-2">
      <Link :href="route('search')">
        go back
      </Link>
    </div>
<!--    &lt;!&ndash; Display Post Notification if there is something in session('message')&ndash;&gt;-->
<!--    <div v-if="postMessage" class="pt-1">-->
<!--      <PostNotification :message="postMessage" :key="Date.now()"/>-->
<!--    </div>-->
    <!-- Main Section -->
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <!-- Displays the search term and search type -->
        <div class="p-2">
          <p class="text-lg"><span class="font-bold italic">Search Type:</span> {{type}}</p>
          <p class="text-lg"><span class="font-bold italic">Search Term:</span> {{term}}</p>
          <p v-if="results" class="text-lg"><span class="font-bold italic">Results:</span> {{results.length}}</p>
        </div>
        <!-- List of Results -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
          <thought v-for="result in results" :key="result.id" :thought="result" />
        </div>
    </div>
</AuthenticatedLayout>
</template>
