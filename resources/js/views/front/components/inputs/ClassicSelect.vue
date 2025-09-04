<template>
    <div class="relative rounded-10px px-28px  py-16px w-full bg-opacity-90 text-white text-opacity-80 text-14px lg:text-16px bg-mainBlueVeryDark dark:bg-mediumGrey dark:bg-opacity-30 border-0" :class="selectOpen === 1 ? 'z-20' : ''">
        <div class="gap-32px flex items-center justify-between cursor-pointer" @click="selectOpen === 1 ? selectOpen = 0 : selectOpen = 1">
            <p class="">{{ newTitle ? newTitle : label }}</p>
            <img :src="'/assets/icons/arrow-down.svg'" class="h-10px transition-all" :class="selectOpen === 1 ? 'rotate-180' : ''">
        </div>
        <div class="rounded-10px bg-mainBlueVeryDark dark:bg-[#1A1A25] py-16px absolute bg-white top-100px h-0 left-0 opacity-0 pointer-events-none transition-all" :class="selectOpen === 1 ? 'top-64px bg-white w-full opacity-100 pointer-events-auto !h-fit z-20' : ''">
            <div class="relative px-16px py-10px group" v-for="item in items">
                <p class=" transition-all group-hover:text-hoverPurple">{{ item[itemTitle] }}</p>
                <input type="radio" @change="newTitle = item[itemTitle]" name="model" @input="$emit('update:modelValue', $event.target.value)" :value="[item[itemValue]]" class="absolute top-0 left-0 h-full w-full opacity-0 cursor-pointer" @click="selectOpen = 0">
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">

    //Imports
    import { ref } from 'vue';
    //Props
    defineProps({
        placeholder: String,
        type: String,
        modelValue: String,
        topClass: String,
        errorClass: String,
        items: Array,
        itemTitle: String,
        itemValue: String,
        label: String,
    });

    const selectOpen = ref<number>(0);
    const newTitle = ref<string>('');

</script>