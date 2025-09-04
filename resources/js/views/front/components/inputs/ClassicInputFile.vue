<template>
    <input type="file" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="w-fit rounded-10px px-28px py-50px placeholder:text-white placeholder:text-opacity-80 text-white text-opacity-80 text-14px lg:text-16px bg-black dark:bg-mediumGrey dark:bg-opacity-30 placeholder:text-14px lg:placeholder:text-16px border-0" :placeholder="placeholder">
</template>
<script setup lang="ts">
    //Props
    defineProps({
        placeholder: String,
        type: String,
        modelValue: String,
        topClass: String,
        errorClass: String,
    });
</script>