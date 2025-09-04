<template>
    <div :class="topClass">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" v-if="label">{{ label }}</label>
        <select :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option :value="''">Pasirinkite</option>
            <option :value="item[value]" v-for="item in items" :key="item[value]">{{ item[title] }}</option>
        </select>
    </div>
</template>
<script setup lang="ts">
    //Props
    defineProps({
        label: String,
        modelValue: String,
        topClass: String,
        errorClass: String,
        value: String,
        title: String,
        items: Array,
        selectedValue: String,
    });
</script>