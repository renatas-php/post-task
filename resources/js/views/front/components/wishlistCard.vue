<template>
    <router-link :to="'/' + link" class="border border-black relative group flex flex-col lg:flex-row lg:items-center">
        <div class="overflow-hidden h-300px lg:h-400px w-full lg:w-fit">
            <img :src="userImage" class="h-full w-full lg:w-300px lg:w-400px object-cover transition-all duration-500">
        </div>
        <div class="flex flex-col px-16px lg:px-64px py-32px">
            <p class="uppercase text-32px lg:text-44px font-extralight">{{ fullname }}</p>
            <p class="uppercase text-16px lg:text-20px">{{ city }}</p>
            <div class="flex flex-col mt-16px">
                <p class="uppercase text-12px lg:text-14px">Socialiniai tinklai</p>
                <a :href="instagram" class="uppercase tetx-14px lg:text-20px flex items-center gap-8px" v-if="instagram" target="_blank">
                    <img :src="'/assets/icons/instagram.svg'" class="h-12px lg:h-20px">
                    <span>Instagram</span>
                </a>
            </div>
            <div class="flex flex-col mt-16px">
                <p class="uppercase text-12px lg:text-14px">Amžius</p>
                <p class="uppercase text-16px lg:text-20px">{{ age }}</p>
            </div>
            <div class="flex flex-col mt-16px">
                <p class="uppercase text-12px lg:text-14px">Hobiai</p>
                <p class="uppercase text-16px lg:text-20px">{{ hobbies }}</p>
            </div>
        </div>
        <div class="flex w-full lg:w-450px relative overflow-hidden ml-auto h-300px lg:h-400px">
            <template v-for="(image, index) in productImages">
                <img :src="image" class="h-300px lg:h-400px" v-if="index < 3" :class="[index == 1 ? 'left-[50%] absolute sm:left-[33%] z-20' : '', index == 2 ? 'absolute left-[66%] z-10 sm:z-30' : '']">
            </template>
            <p class="z-40 text-20px text-white font-extralight bg-black px-50px py-12px uppercase absolute left-2/4 top-2/4 -translate-x-2/4 -translate-y-2/4 hover:loadMoreLinearBg">Noras</p>
        </div>
    </router-link>
</template>
<script setup lang="ts">

    const props = defineProps({
        userImage: String,
        link: String,
        fullname: String,
        city: String,
        instagram: String,
        age: String,
        hobbies: String,
        productImages: Array,
    });

</script>