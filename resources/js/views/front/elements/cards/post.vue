<template>
    <div class="bg-veryDarkBlue dark:bg-white rounded-10px p-20px h-auto min-h-400px flex flex-col justify-between">
        <div class="">
            <div class="flex items-center justify-between gap-16px">
                <div class="flex flex-col">
                    <p class="font-semiBold text-[14px] dark:text-opacity-80 text-white dark:text-black underline">{{ group }}</p>
                    <p class="font-semiBold text-[40px] leading-[50px] text-white dark:text-black">{{ title }}</p>
                    <p class="font-semiBold text-[18px] text-white dark:text-black">{{ username }}</p>
                </div>
                <p class="font-semiBold text-[14px] text-white dark:text-black">{{ validFrom }}</p>
            </div>
            <div class="dark:text-opacity-90 text-16px leading-[22px] py-20px text-white dark:text-black">
                {{ content }}
            </div>
        </div>
        <div class="flex flex-col gap-16px mt-32px mb-16px">
            <router-link v-if="slug" :to="'/projektai/' + slug" class="dark:bg-black mx-auto w-fit text-white border-2 border-white rounded-100px py-12px lg:py-12px px-30px lg:px-50px font-semibold block text-center mt-20px transition-all">
                {{ buttonTitle }}
            </router-link>
            <div class="flex gap-16px">
                <router-link v-if="postId" :to="'/my-posts/' + postId" class="dark:border-black mx-auto w-fit text-black border-2 rounded-100px py-12px lg:py-12px px-30px lg:px-30px font-semibold block text-center mt-20px transition-all">
                    Edit
                </router-link>
                <button v-if="postId" @click="handleDelete" type="button" class="dark:border-negativeRed mx-auto w-fit text-negativeRed border-2 rounded-100px py-12px lg:py-12px px-30px lg:px-30px font-semibold block text-center mt-20px transition-all">
                    Delete
                </button>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">

    //Imports
    import { ref, onMounted } from 'vue';
    import MainCta from '@/views/front/elements/buttons/main-cta.vue';

    const props = defineProps({
        title: String,
        content: String,
        username: String,
        validFrom: String,
        group: String,
        userSlug: String,
        slug: String,
        approvedSpecialists: String,
        specialistsNumber: String,
        buttonTitle: String,
        loading: Boolean,
        postId: Number
    });

    //Refs
    const emit = defineEmits(["delete"]);

    //Methods
    function handleDelete() {
    if (props.postId) {
        emit("delete", props.postId);
    }
}

</script>