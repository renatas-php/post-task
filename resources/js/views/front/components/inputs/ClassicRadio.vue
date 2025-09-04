<template>
    <div class="flex flex-col gap-16px">
        <p class="text-mainBlueVeryDark dark:text-white dark:text-opacity-80 font-bold text-16px">{{ label}}</p>
        <div class="flex flex-wrap gap-16px">
            <div class="flex gap-16px" v-for="item in items">
                <input type="radio" name="radio" :value="item[itemValue]" @input="$emit('update:modelValue', $event.target.value)" class="rounded-[5px] h-24px w-24px placeholder:text-white placeholder:text-opacity-80 bg-opacity-90 text-white text-opacity-80 text-14px lg:text-16px bg-mainBlueVeryDark dark:bg-mediumGrey dark:bg-opacity-30 placeholder:text-14px lg:placeholder:text-16px border-0">
                <label class="text-mainBlueVeryDark dark:text-white dark:text-opacity-80">{{ item[itemTitle] }}</label>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
    //Props
    defineProps({
        label: String,
        modelValue: String,
        topClass: String,
        errorClass: String,
        items: Array,
        itemTitle: String,
        itemValue: String,
    });
</script>