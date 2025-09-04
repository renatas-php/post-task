<template>
    <Navigation></Navigation>
    <div class="px-16px xl:px-104px bg-veryLightGrey dark:bg-mainBlueVeryDark py-64px">
        <div class="flex flex-col gap-64px w-full">
            <div class="hidden lg:flex justify-center items-center gap-22px">
                <flat-pickr
                    v-model="validFromDate"
                    :placeholder="'Valid from'"
                    :config="{
                        enableTime: false,
                        dateFormat: 'Y-m-d',
                    }"
                    class="px-24px py-14px w-fit bg-mainBlueVeryDark dark:bg-mediumGrey dark:bg-opacity-30 border-0 font-semibold rounded-10px dark:placeholder:text-white dark:placeholder:text-opacity-80 dark:text-white text-14px lg:text-16px"
                ></flat-pickr>
                <div class="relative flex flex-col bg-wite dark:bg-mediumGrey dark:bg-opacity-30 rounded-10px w-250px px-16px py-12px">
                    <button type="button" class="flex items-center justify-between gap-20px text-mainBlueVeryDark dark:text-white font-semibold" @click="filterDropdown === 1 ? filterDropdown = 0 : filterDropdown = 1">
                        <span>Group</span>
                        <img :src="'/assets/icons/arrow-down.svg'" class="h-10px hidden dark:block" alt="arrow-down" width="24" height="14" :class="filterDropdown === 1 ? 'rotate-180' : ''">
                        <img :src="'/assets/icons/arrow-down-dark.svg'" class="h-10px dark:hidden block" alt="arrow-down" width="24" height="14" :class="filterDropdown === 1 ? 'rotate-180' : ''">
                    </button>
                    <div class="absolute left-0 top-200px opacity-0 pointer-events-none transition-all dark:bg-[#3f587e] rounded-10px flex flex-col gap-12px px-16px py-16px w-full" :class="filterDropdown === 1 ? '!top-60px !opacity-100 !pointer-events-auto' : ''">
                        <div class="flex items-center gap-16px" v-for="category in categories">
                            <div class="relative w-18px h-18px bg-[#FFF] flex justify-center items-center rounded-4px">
                                <img :src="'/assets/icons/check.svg'" alt="nike-white" width="11" height="8" v-if="filterGroup.includes(category?.id)">
                                <input type="checkbox" v-model="filterGroup" :value="category?.id" class="opacity-0 absolute top-0 left-0 w-full h-full">
                            </div>
                            <span class="text-mainBlueVeryDark dark:text-white nowrap">{{ category?.name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center pt-200px min-h-500px" v-if="loading === 1">
                <ClassicLoader :loaderColor="'#FFFFFF'"></ClassicLoader>
            </div>
            <div class="flex flex-col" v-if="loading != 1 && posts?.length > 0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-32px w-full">
                    <Post
                        v-for="post in posts"
                        :title="post?.name"
                        :content="post?.content"
                        :group="post?.group?.name"
                        :username="post?.user?.fullname"
                        :validFrom="post?.valid_from_formated">
                    </Post>
                </div>
                <div class="flex justify-center flex-wrap gap-10px pt-50px pb-32px">
                    <template v-for="page in totalPages">
                        <button type="button" @click="goToPage(page)" class="bg-black dark:bg-white dark:bg-opacity-10 h-30px lg:h-42px w-30px lg:w-42px rounded-full text-white text-14px lg:text-16px" :class="currentPage === page ? 'bg-darkPurple dark:!bg-opacity-80 dark:!text-mainBlack' : ''">{{ page }}</button>
                    </template>
                </div>
            </div>
            <div class="flex justify-center items-center min-h-500px w-full" v-if="posts?.length < 1 && loading != 1">
                <p class="text-mainBlueVeryDark dark:text-white">Posts not found</p>
            </div>
        </div>     
    </div>
    <Footer></Footer>
</template>
<script setup lang="ts">

//Import 
import { ref, onMounted, watch, inject } from 'vue';
import axios from 'axios';
import router from '@/routes/index';
import Navigation from '@/views/front/includes/navigation.vue';
import ProductCard from '@/views/front/components/productCard.vue';
import Footer from '@/views/front/includes/footer.vue';
import Breadcrumb from '@/views/front/components/breadcrumb.vue';
import Post from '@/views/front/elements/cards/post.vue';
import ClassicLoader from '@/views/front/elements/loaders/classicLoader.vue';
import { useHead } from '@unhead/vue';

import TextHelper from '@/functions/textHelper';

//Refs
const errors = ref<object[]>([]);
const validFromDate = ref<string>('');
const posts = ref<object[]>([]);
const categories = ref<object[]>([]);
const stages = ref<object[]>([]);
const skip = ref<number>(0);
const take = ref<number>(6);
const loading = ref<number>(0);
const filterDropdown = ref<number>(0);
const filterGroup = ref<number[]>([]);
const filterStage = ref<number[]>([]);
const totalPages = ref<number>(0);
const currentPage = ref<number>(1);

//flatpickr
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

onMounted(() => {
    getPosts(false, false);
    getPostHelper();
});

watch([
    filterGroup,
    filterStage,
    validFromDate,
    router.currentRoute,
], async (newValue, OldValue) => {
    getPosts(true, false);
});

//Methods
async function getPostHelper()
{
    await axios.get('/api/front/post-helper')
    .then(response => {
        categories.value = response.data.categories;
    })
    .catch(function (error) {
        errors.value = error.response.data.errors;
    });
}

function goToPage(page: number)
{
    skip.value = 6 * page - 6;
    currentPage.value = page;
    getPosts(true, true);
}

function getPosts(reset: boolean, loadMoreButton: boolean)
{
    loading.value = 1;
    if(reset === true)
    {
        posts.value = [];
    }

    if(loadMoreButton === true && skip.value === 0)
    {
        skip.value = 6;
    }

    setTimeout(() => {
        axios.get('/api/front/posts',
        {
            params: {
                skip: skip.value,
                take: take.value,
                groups: filterGroup.value,
                valid_from: validFromDate.value,
            }
        })
        .then(response => {
            response.data.data.forEach((item) => {
                posts.value.push(item);
            });
            totalPages.value = response.data.totalPages;
            loading.value = 0;
            setMetaTags();
        })
        .catch(function (error) {
            loading.value = 0;
        });
    }, 700);

    function setMetaTags()
    {
        let title = subcategory.value?.meta_title ? subcategory.value?.meta_title : category.value?.meta_title;
        let description = subcategory.value?.meta_description ? subcategory.value?.meta_description : category.value?.meta_description;

        useHead({
            title: title,
            meta: [
                {
                    name: 'description',
                    content: description,
                },
                {
                    name: 'msapplication-TileColor',
                    content: 'rgb(122 82 244)',
                },
                {
                    name: 'theme-color',
                    content: 'rgb(122 82 244)',
                },
                {
                    name: 'DC.title',
                    content: title,
                },
                {
                    name: 'DC.description',
                    content: description,
                },
                {
                    name: 'og:image',
                    content: 'https://stitchplease.lt/assets/logo.svg',
                },
                {
                    name: 'og:image:type',
                    content: 'image/jpg',
                },
                {
                    name: 'og:description',
                    content: description,
                },
                {
                    name: 'og:title',
                    content: title,
                },
                {
                    name: 'og:type',
                    content: 'website',
                },
                {
                    name: 'og:url',
                    content: router.currentRoute.value.path,
                },
                {
                    name: 'og:site_name',
                    content: 'Stitch Please',
                },
                {
                    name: 'author',
                    content: 'Stitch Please',
                }
            ],
            link: [
            {
                rel: 'canonical',
                href: 'https://stitchplease.lt' + router.currentRoute.value.path,
            },
        ]
        });
    }
}

</script>