<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

const form = useForm({
  message: '',
  tag_1: '',
  tag_2: '',
  tag_3: '',
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
          <form @submit.prevent="form.post(route('thoughts.store'), { onSuccess: () => form.reset() })">
                <label for="thought" class="mt-5">Thought</label>
                <textarea
                  v-model="form.message"
                  placeholder="What's on your mind?"
                  class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <label for="tags" class="mt-5">Tags</label>
                <div class="flex space-x-2">
                  <textarea v-model="form.tag_1" class="resize-none" rows="1" @keydown.enter.prevent ></textarea>
                  <textarea v-model="form.tag_2" class="resize-none" rows="1" @keydown.enter.prevent ></textarea>
                  <textarea v-model="form.tag_3" class="resize-none" rows="1" @keydown.enter.prevent ></textarea>
                </div>
            <InputError :message="form.errors.message" class="mt-2" />
            <PrimaryButton class="mt-4">Have a Thought</PrimaryButton>
          </form>
        </div>

<!--      TODO: List Last 5 thoughts -->

<!--      TODO: List number of drafts -->

<!--      TODO: List number of deleted items -->

    </AuthenticatedLayout>

</template>
