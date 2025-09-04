<template>
    <div class="flex flex-col gap-10px">
        <h1 class="text-mainBlueVeryDark dark:text-white text-24px lg:text-20px font-bold">{{ title }}</h1>
        <p class="text-12px lg:text-14px text-mainBlueVeryDark dark:text-white dark:text-opacity-50">{{ description }}</p>
    </div>
</template>
<script setup lang="ts">

    const props = defineProps({
        title: String,
        description: String,
    });

</script>