<template>
    <nav class="z-50 bg-veryLightGrey bg-veryLightGrey dark:bg-mainBlueVeryDark fixed xl:relative flex justify-between items-center w-full h-50px xl:h-80px px-16px xl:px-104px z-10">
        <div class="border-b border-b-[#181818] px-20px bg-mainBlack lg:bg-none h-0 fixed -top-100px left-0 w-full transition-all flex flex-col pt-50px pb-32px gap-32px z-10 opacity-0 pointer-events-none" :class="mobileMenuActive === true ? 'h-auto top-0 opacity-100 pointer-events-auto' : ''">
            <div v-if="isLogged === true" class="flex flex-col border-b border-b-mainBlueVeryDark dark:border-b-white border-opacity-10 dark:border-opacity-10 py-20px">
                <p class="font-semibold text-16px text-mainBlueVeryDark dark:text-white">Hello</p>
                <div class="flex flex-col">
                    <router-link :to="''" class="font-semibold text-16px text-mainBlueVeryDark dark:text-white">{{ user?.email }}</router-link>
                </div>
            </div>
            <ul class="flex flex-col xl:hidden gap-16px lg:gap-26px w-full" :class="isLogged != true ? 'pt-24px' : ''">   
                <li class="flex flex-col">
                    <router-link :to="'/projektai'" class="flex gap-16px group text-mainBlueVeryDark dark:text-white">
                        <img :src="isDark ? '/assets/icons/work-white.svg' : '/assets/icons/work-dark.svg'" alt="projektai" height="24" width="24">
                        <span class="font-light text-18px">My posts</span>
                    </router-link>
                </li>
                <li class="flex justify-between" v-if="isLogged !== true">
                    <router-link :to="'/prisijungti'" class="flex gap-16px group text-mainBlueVeryDark dark:text-white">
                        <img :src="'/assets/icons/user.svg'" alt="prisijungti" height="24" width="24">
                        <span class="font-light text-18px">Prisijungti</span>
                    </router-link>
                </li>
                <li class="flex flex-col">
                    <router-link :to="'/mano-projektai'" class="flex gap-16px group text-mainBlueVeryDark dark:text-white" v-if="user?.roles?.includes('author')">
                        <img :src="'/assets/icons/edit-white.svg'" alt="mano-projektai" height="24" width="24">
                        <span class="font-light text-18px">Mano projektai</span>
                    </router-link>
                    <router-link :to="'/mano-aplikacijos'" class="flex gap-16px group text-mainBlueVeryDark dark:text-white" v-if="user?.roles?.includes('specialist')">
                        <img :src="'/assets/icons/edit-white.svg'" alt="mano-projektai" height="24" width="24">
                        <span class="font-light text-18px">Aplikacijos</span>
                    </router-link>
                </li>
                <li class="flex flex-col" v-if="isLogged === true">
                    <button type="button" @click="logout" class="flex items-center justify-center gap-16px py-14px group bg-navyBlue bg-opacity-20 rounded-10px text-mainBlueVeryDark dark:text-white">
                        <img :src="'/assets/icons/close-red.svg'" class="h-14px" alt="mano-projektai" height="24" width="24">
                        <span class="font-light text-16px">Atsijungti</span>
                    </button>
                </li>
            </ul>
        </div>
        <router-link :to="'/'" class="text-24px xl:text-[42px] z-20 text-mainBlueVeryDark dark:text-white"><!--<img :src="'/assets/logo.svg'" class="h-16px lg:h-22px">-->Logotipas</router-link>
        <div class="flex gap-32px">
            <ul class="hidden lg:flex items-center gap-24px z-20">
                <li class="flex items-center">
                    <router-link :to="isLogged === true ? '/my-posts' : '/prisijungti'" class="bg-mainBlueVeryDark text-white dark:text-black dark:bg-white px-32px py-8px flex items-center transition-all rounded-[5px] text-16px font-normal" @mouseover="activeIcon = 2" @mouseleave="activeIcon = 0">
                        {{ isLogged === true ? 'My posts' : 'Login' }}
                    </router-link>
                </li>
            </ul>
        </div>
        <ul class="flex lg:hidden items-center gap-16px z-20">
            <li class="h-24px">
                <button type="button" @click="mobileMenuActive = ! mobileMenuActive">
                    <img class="hidden dark:block" :src="mobileMenuActive === true ? '/assets/icons/x-white.svg' : '/assets/icons/burger-white.svg'">
                    <img class="block dark:hidden" :src="mobileMenuActive === true ? '/assets/icons/x-dark.svg' : '/assets/icons/burger-dark.svg'">
                </button>
            </li>
        </ul>
        <!-- Search -->
        <div class="px-16px xl:px-104px h-0 fixed -top-100px left-0 w-full transition-all flex flex-col items-center justify-center gap-32px z-10 bg-white opacity-0 bg-veryLightGrey dark:bg-black border-b border-b-[#181818]" :class="searchActive === true ? 'h-300px lg:h-500px top-0 opacity-100 border-b border-b-black' : ''">
            <div class="flex flex-col gap-10px max-w-500px lg:max-w-700px w-full">
                <p class="text-mainRed text-14px lg:text-16px" v-if="searchError">{{ searchError }}</p>
                <div class="flex gap-16px">
                    <div class="flex items-center gap-16px">
                        <div class="relative w-18px h-18px bg-black dark:bg-mediumGrey dark:bg-opacity-30 flex justify-center items-center rounded-4px">
                            <img :src="'/assets/icons/nike-white.svg'" alt="nike-white" width="11" height="8" v-if="searchType === 'posts'">
                            <input type="radio" name="search_type" v-model="searchType" :value="'posts'" class="opacity-0 absolute top-0 left-0 w-full h-full">
                        </div>
                        <span class="text-mainBlueVeryDark dark:text-white nowrap">Projektai</span>
                    </div>
                    <div class="flex items-center gap-16px">
                        <div class="relative w-18px h-18px bg-black dark:bg-mediumGrey dark:bg-opacity-30 flex justify-center items-center rounded-4px">
                            <img :src="'/assets/icons/nike-white.svg'" alt="nike-white" width="11" height="8" v-if="searchType === 'specialists'">
                            <input type="radio" name="search_type" v-model="searchType" :value="'specialists'" class="opacity-0 absolute top-0 left-0 w-full h-full">
                        </div>
                        <span class="text-mainBlueVeryDark dark:text-white nowrap">Specialistai</span>
                    </div>
                </div>
                <div class="flex flex-row items-center justify-start gap-16px lg:gap-32px w-full">
                    <ClassicInput
                        :class="'w-full lg:max-w-500px py-14px'"
                        :placeholder="'Įveskite paieškos tekstą'"
                        :type="'text'"
                        v-model="search">
                    </ClassicInput>
                    <MainCta 
                        :buttonClass="'w-fit px-24px lg:px-50px bg-white bg-opacity-90 text-black hover:bg-opacity-100 font-semibold'"
                        :title="'Ieškoti'"
                        @click="makeSearch()">
                    </MainCta>
                </div>
            </div>
        </div>
        <!-- End search -->
    </nav>
</template>
<script setup lang="ts">

    //Imports
    import { ref, onMounted, watch, computed, inject } from 'vue';
    import axios from 'axios';
    import router from '@/routes/index';
    import MainCta from '@/views/front/elements/buttons/main-cta.vue';
    import { Cart } from '@/store/basket';
    import ClassicInput from '@/views/front/components/inputs/ClassicInput.vue';
    import { useDark } from '@vueuse/core';
    import { checkOrLogged, isLogged, user } from '@/store/auth'

    //Refs
    const emitter = inject('emitter'); // Inject `emitter`
    const search = ref<string>('');
    const searchActive = ref<boolean>(false);
    const mobileMenuActive = ref<boolean>(false);
    const mainBidAuction = ref<object>({});
    const basketItems = ref<number>(0);
    const activeSubMenu = ref<number>(0);
    const activeIcon = ref<number>(0);
    const categories = ref<object[]>([]);
    const activeCategory = ref<number>(0);
    const searchError = ref<string>('');
    const user = ref<object>({});
    const isLogged = ref<boolean | null>(null);
    const searchType = ref<string>('posts');
    const notificationPopupShow = ref<boolean>(false);
    const isDark = useDark();
    const myNotifications = ref<object[]>([]);

    onMounted(() => {
        getCategories();
        checkOrLogged();
    });


    //Methods

    function getNotifications()
    {
        notificationPopupShow.value = notificationPopupShow.value === true ? notificationPopupShow.value = false : notificationPopupShow.value = true;
        axios.get('/api/front/my-notifications')
        .then(response => {
            myNotifications.value = response.data.data;
            console.log('ok');
        })
        .catch(function (error) {
            
        });
    }

    function getCategories()
    {
        axios.get('/api/front/categories',
        {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('aukcionasToken')
            }
        })
        .then(response => {
            categories.value = response.data.data;
        })
        .catch(function (error) {
            
        });
    }

    function makeSearch()
    {
        if(search.value?.length >= 3)
        {
            if(searchType.value === 'posts')
            {
                router.push({ path: '/projektai', query: { q: search.value } });
            }
            if(searchType.value === 'specialists')
            {
                router.push({ path: '/specialistai', query: { q: search.value } });
            }
        }
        else
        {
            searchError.value = 'Paieškos frazė negali būti trumpesnė nei 3 simboliai';
        }
        
    }

    function logout()
    {
        router.push({ path: '/prisijungti' })
    }

    function checkOrLogged()
    {
        axios.get('/api/front/me')
        .then(response => {
            isLogged.value = response.data.data ? true : false;
            user.value = response.data.data;
        })
        .catch(function (error) {
            
        });
    }


</script>