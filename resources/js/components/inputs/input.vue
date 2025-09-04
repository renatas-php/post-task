<template>
    <div class="w-full" :class="topClass">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
        <input :disabled="disabled" :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" :placeholder="placeholder">
    </div>
</template>
<script setup lang="ts">
    //Props
    defineProps({
        label: String,
        placeholder: String,
        type: String,
        modelValue: String,
        topClass: String,
        errorClass: String,
        mode: String,
        disabled: Boolean,
    });
</script>