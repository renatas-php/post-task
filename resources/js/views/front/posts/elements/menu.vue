<template>
    <div class="hidden lg:flex flex-col gap-50px max-w-250px w-full h-fit">
        <ul class="flex flex-col gap-16px">
            <li>
                <div class="w-full flex flex-col py-16px rounded-10px px-32px text-16px font-semibold text-white bg-black dark:bg-mediumGrey dark:bg-opacity-30 transiton-all">
                    <span>Hello,</span>
                    <span class="break-words">{{ user?.email }}</span>
                </div>
            </li>
        </ul>
        <ul class="flex flex-col gap-16px pl-32px">
            <li class="flex justify-between items-center">
                <router-link :to="'/my-posts'" class="text-16px text-mainBlueVeryDark dark:text-white transiton-all" :class="router.currentRoute.value.name === 'my-posts' ? 'font-bold' : ''">My posts</router-link>
            </li>
        </ul>
        <ul class="flex flex-col gap-16px">
            <li>
                <button type="button" @click="logout()" class="w-full py-16px rounded-10px px-32px text-16px text-white bg-black dark:bg-mediumGrey dark:bg-opacity-30 hover:dark:bg-opacity-50 transiton-all">Logout</button>
            </li>
        </ul>
    </div>
</template>
<script setup lang="ts">

//Imports
import { ref, onMounted } from 'vue';
import router from '@/routes/index';
import axios from 'axios';

//Refs
const user = ref<object[]>([]);
const newApplications = ref<null | number>(null);
const newMessages = ref<null | number>(null);

onMounted(( )=> {
    getMyInfo();
});

//Methods
function logout()
{
    axios.post('/api/logout')
    .then(response => {
        if(response.status === 200)
        {
            router.push({ path: '/prisijungti' });
        }
    })
    .catch(function (error) {
    });
}

function getMyInfo()
{
    axios.get('/api/front/me')
    .then(response => {
        user.value = response.data.data;
        newApplications.value = response.data.new_applications;
        newMessages.value = response.data.new_messages;
    })
    .catch(function (error) {
        
    });
}

</script>