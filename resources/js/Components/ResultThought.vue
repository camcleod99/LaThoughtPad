<script setup>

import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';

dayjs.extend(relativeTime);
const props = defineProps(['thought']);

const form = useForm({
    message: props.thought.message,
    tag_1: props.thought.tag_1,
    tag_2: props.thought.tag_2,
    tag_3: props.thought.tag_3,
});

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
          <span class="text-gray-800">{{ thought && thought.user ? thought.user.name : '' }}</span>
          <small class="ml-2 text-sm text-gray-600">{{ dayjs(thought.created_at).fromNow() }}</small>
          <small v-if="thought.created_at !== thought.updated_at" class="text-sm text-gray-600"> &middot;
            edited</small>
        </div>

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
