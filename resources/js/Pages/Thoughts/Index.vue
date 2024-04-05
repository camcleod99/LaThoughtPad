<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Thought from '@/Components/Thought.vue';
import PostNotification from "@/Components/PostNotification.vue";
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['thoughts', 'page', 'pageTitle', 'postMessage'])

const form = useForm({
    message: '',
});

</script>

<template>
<Head :title="pageTitle" />
<AuthenticatedLayout>
    <!-- Page Heading -->
    <div class="flex items-center justify-center p-2">
      <h2 class="text-2xl font-bold">{{pageTitle}}</h2>
    </div>
    <!-- Display Post Notification if there is something in session('message')-->
    <div v-if="postMessage" class="pt-1">
      <PostNotification :message="postMessage" :key="Date.now()"/>
    </div>
    <!-- Main Section -->
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <!-- List of posts -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
          <Thought
            :page="page"
            v-for="thought in thoughts"
            :key="thought.id"
            :thought="thought"
            :postMessage="postMessage"
          />
        </div>
    </div>
</AuthenticatedLayout>
</template>
