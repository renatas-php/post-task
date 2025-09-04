<template>
    <div class="flex gap-16px">
        <input type="checkbox" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="rounded-[5px] h-24px w-24px placeholder:text-white placeholder:text-opacity-80 bg-opacity-90 text-white text-opacity-80 text-14px lg:text-16px bg-mainBlueVeryDark dark:bg-mediumGrey dark:bg-opacity-30 placeholder:text-14px lg:placeholder:text-16px border-0">
        <label class="text-mainBlueVeryDark dark:text-white dark:text-opacity-80">{{ label }}</label>
    </div>
</template>
<script setup lang="ts">
    //Props
    defineProps({
        label: String,
        modelValue: String,
        topClass: String,
        errorClass: String,
    });
</script>