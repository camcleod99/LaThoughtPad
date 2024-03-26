<script setup>

import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

dayjs.extend(relativeTime);
const props = defineProps(['thought', 'page']);

const form = useForm({
    message: props.thought.message,
    tag_1: props.thought.tag_1,
    tag_2: props.thought.tag_2,
    tag_3: props.thought.tag_3,
});

const editing = ref(false);

</script>

<template>
  <div class="p-6 flex space-x-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24"
      stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
    <div class="flex-1">

      <div class="flex justify-between items-center">

        <div>
          <span class="text-gray-800">{{ thought.user.name }}</span>
          <small class="ml-2 text-sm text-gray-600">{{ dayjs(thought.created_at).fromNow() }}</small>
          <small v-if="thought.created_at !== thought.updated_at" class="text-sm text-gray-600"> &middot;
            edited</small>
        </div>

        <Dropdown v-if="thought.user.id === $page.props.auth.user.id">
          <template #trigger>
            <button>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
              </svg>
            </button>
          </template>

          <template #content>
            <button class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out" @click="editing = true">
              Edit
            </button>
            <DropdownLink v-if="page !== 'thoughts'" as="button" method="post" :href="route('thoughts.updateStatus', { id: thought.id, status: 'Posted', source: page })">
              Move to Posts
            </DropdownLink>
            <DropdownLink v-if="page !== 'drafts'" as="button" method="post" :href="route('thoughts.updateStatus', { id: thought.id, status: 'Draft', source: page })">
              Move to Drafts
            </DropdownLink>
            <DropdownLink v-if="page !== 'deleted'" as="button" method="post" :href="route('thoughts.updateStatus', { id: thought.id, status: 'Deleted', source: page })">
              Move to The Bin
            </DropdownLink>
            <DropdownLink v-if="page ==='deleted'" as="button" method="delete" :href="route('thoughts.destroy', { id: thought.id })" class="bg-red-500 hover:bg-red-400 text-white">
              Delete Permanently
            </DropdownLink>
          </template>
        </Dropdown>
      </div>

      <form v-if="editing"
            @submit.prevent="form.put(route('thoughts.update', { thought: thought.id, page: page }), { message: form.message }); editing = false">
        <label for="message" class="mt-5">Message</label>
        <textarea v-model="form.message"
          class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        </textarea>
        <label for="tags" class="mt-5">Tags</label>
        <div class="flex space-x-4">
          <textarea v-model="form.tag_1" rows="1" @keydown.enter.prevent
            class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm resize-none">
          </textarea>
          <textarea v-model="form.tag_2" rows="1" @keydown.enter.prevent
            class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm resize-none">
          </textarea>
          <textarea v-model="form.tag_3" rows="1" @keydown.enter.prevent
            class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm resize-none">
          </textarea>
        </div>
        <InputError :message="form.errors.message" class="mt-2" />
        <div class="space-x-2 text-right">
            <PrimaryButton class="mt-4">Save</PrimaryButton>
            <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
        </div>
      </form>

      <div v-else >
        <p class="mt-4 text-lg text-gray-900">{{ thought.message }}</p>
        <div class="mt-3 space-x-2 text-right">
          <span class="font-bold font-serif" v-if="thought.tag_1 !== null && thought.tag_1 !== ''">{{ thought.tag_1 }}</span>
          <span class="font-bold font-serif" v-if="thought.tag_2 !== null && thought.tag_2 !== ''"> {{ thought.tag_2 }} </span>
          <span class="font-bold font-serif" v-if="thought.tag_3 !== null && thought.tag_3 !== ''"> {{ thought.tag_3 }} </span>
        </div>
      </div>
    </div>
  </div>
</template>
