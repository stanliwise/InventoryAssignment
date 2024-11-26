<script setup>
import { onMounted } from 'vue';

defineProps(['modelValue']);
defineEmits(['update:modelValue']);
</script>
<template>
    <textarea :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
</template>
