<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Thought from '@/Components/Results/Thought.vue';
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
    <!-- Go Back Button -->
    <div class="flex items-center justify-center p-2">
      <Link :href="route('search')">
        go back
      </Link>
    </div>
    <!-- Main Section -->
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <div v-if="results" class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        <thought v-for="result in results" :key="result.id" :thought="result" />
      </div>
    </div>
</AuthenticatedLayout>
</template>
