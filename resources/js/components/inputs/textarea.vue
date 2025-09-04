<template>
    <div class="w-full border-none p-0" :class="topClass">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
        <textarea id="description" rows="8" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" :placeholder="placeholder"></textarea>
    </div>
</template>
<script setup lang="ts">
    //Props
    defineProps({
        label: String,
        placeholder: String,
        modelValue: String,
        topClass: String,
        errorClass: String,
        mode: String
    });
</script>