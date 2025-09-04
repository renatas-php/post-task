<template>
    <router-link :to="link" class="border border-black relative group bg-[#D2D2D2] max-h-700px">
        <div class="overflow-hidden">
            <img :src="image" class="w-full group-hover:scale-125 transition-all duration-500 h-300px lg:h-500px object-cover">
        </div>
        <div class="flex flex-col gap-10px py-16px">
            <div class="flex justify-between">
                <p class="text-16px lg:text-20px uppercase px-16px">{{ title }}</p>
                <p class="text-16px lg:text-20px uppercase font-semibold px-16px">{{ price }}</p>
            </div>
            <p class="text-16px lg:text-20px uppercase font-semibold px-16px">{{ fullname }}</p>
            <p class="text-14px lg:text-18px uppercase px-16px">{{ city }}</p>
        </div>
    </router-link>
</template>
<script setup lang="ts">

    const props = defineProps({
        link: String,
        image: String,
        title: String,
        price: String,
        city: String,
        fullname: String,
    });

</script>