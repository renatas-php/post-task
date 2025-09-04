<template>
    <router-link :to="'/' + link" class="border border-black relative group">
        <div class="overflow-hidden">
            <img :src="image" class="w-full group-hover:scale-125 transition-all duration-500">
        </div>
        <p class="text-16px lg:text-20px uppercase border-t border-t-black px-16px py-16px bg-white">{{ title }}</p>
        <p class="bg-black text-white px-8px md:px-16px py-4px md:py-8px absolute top-2/4 right-0 text-14px md:text-20px flex gap-8px">
            <span>{{ price }}</span>
            <span class="text-12px md:text-16px">EUR</span>
        </p>
    </router-link>
</template>
<script setup lang="ts">

    const props = defineProps({
        link: String,
        image: String,
        title: String,
        price: String,
    });

</script>