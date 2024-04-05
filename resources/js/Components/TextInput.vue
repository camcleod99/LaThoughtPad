<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-sm shadow-sm px-3 py-2"
        v-model="model"
        ref="input"
    />
</template>
