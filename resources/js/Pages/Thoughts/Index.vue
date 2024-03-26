<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Thought from '@/Components/Thought.vue';
// import InputError from '@/Components/InputError.vue';
// import PrimaryButton from '@/Components/PrimaryButton.vue';
import PostNotification from "@/Components/PostNotification.vue";
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['thoughts', 'page', 'postMessage'])

const form = useForm({
    message: '',
});
</script>

<template>
<Head :title="page + ' | Thoughtpad'" />
<AuthenticatedLayout>
    <!-- Display Post Notification if there is something in session('message')-->
    <div v-if="postMessage" class="pt-1">
      <PostNotification :message="postMessage" />
    </div>
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
