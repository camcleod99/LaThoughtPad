<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Thought from '@/Components/Thought.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['thoughts', 'page'])

const form = useForm({
    message: '',
});
</script>

<template>
<Head :title="page + ' | Thoughtpad'" />
<AuthenticatedLayout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Submission form for posts -->
        <form v-if="page == 'Main'" @submit.prevent="form.post(route('thoughts.store'), { onSuccess: () => form.reset() })">
            <textarea
            v-model="form.message"
            placeholder="What's on your mind?"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
            <InputError :message="form.errors.message" class="mt-2" />
            <PrimaryButton class="mt-4">Have a Thought</PrimaryButton>
        </form>

        <!-- List of posts -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
          <Thought
            :page="page"
            v-for="thought in thoughts"
            :key="thought.id"
            :thought="thought"
          />
        </div>
    </div>
</AuthenticatedLayout>
</template>
