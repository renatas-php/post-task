<template>
    <div class="bg-black fixed top-0 left-0 w-full h-full bg-opacity-50 flex justify-center items-center z-50" v-show="showMessagePopup === true">
        <div class="flex flex-col gap-16px bg-black border border-[#181818] rounded-10px py-30px px-16px lg:p-50px mt-10px w-full max-w-700px h-fit relative">
            <button type="button" @click="emit('update:showMessagePopup', false)" class="absolute top-16px right-16px">
                <img :src="'/assets/icons/x-white.svg'" alt="x-white" width="" height="">
            </button>
            <template v-if="messageSent === false && isLogged === true">
                <p class="text-22px lg:text-28px text-white pb-10px lg:pb-20px">Parašykite žinutę vartotojui - "{{ post?.user?.fullname }}"</p>
                <ClassicTextarea
                    :placeholder="'Jūsų žinutė'"
                    :class="'min-h-150px'"
                    :type="'text'"
                    v-model="myMessage">
                </ClassicTextarea>
                <div class="flex flex-col" v-show="messageError">
                    <p class="text-mainRed text-14px lg:text-16px" v-for="error in messageError">{{ ErrorsHelper.removeErrorStringExtraSymbols(error) }}</p>
                </div>
                <MainCta
                    :buttonClass="'w-fit px-50px bg-white bg-opacity-90 text-black hover:bg-opacity-100 font-semibold'"
                    @click="sendMessage"
                    :title="'Siųsti'"
                    :loading="sendMessageLoader"
                    :loaderColor="'#000'">
                </MainCta>
            </template>
            <template v-if="messageSent === true">
                <p class="text-28px text-white pb-20px">Žinutė išsiųsta!</p>
                <MainCta
                    :class="'w-fit px-80px'"
                    @click="emit('update:showMessagePopup', false)"
                    :title="'Uždaryti'">
                </MainCta>
            </template>
            <div class="" v-if="isLogged !== true">
                <div class="flex flex-col pb-32px">
                    <p class="text-22px lg:text-28px text-mainRed">Dėmesio!</p>
                    <p class="text-mainRed text-opacity-50 text-14px lg:pb-32px">Privalote prisijungti norėdami parašyti žinutę</p>
                </div>
                <router-link :to="'/prisijungti'" class="mx-auto w-fit flex items-center gap-10px bg-white dark:bg-white dark:bg-opacity-90 hover:dark:bg-opacity-100 rounded-100px py-12px px-40px text-black font-semibold block text-center">
                    Prisijungti
                </router-link>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">

//Import 
import { ref, onMounted, watch, computed, inject } from 'vue';
import axios from 'axios';
import MainCta from '@/views/front/elements/buttons/main-cta.vue';
import ClassicLoader from '@/views/front/elements/loaders/classicLoader.vue';
import ClassicTextarea from '@/views/front/components/inputs/ClassicTextarea.vue';
import ValidationErrors from '@/views/front/elements/errors/validationErrors.vue';
import { checkOrLogged, isLogged, user } from '@/store/auth';
import ErrorsHelper from '@/functions/errorsHelper';

const props = defineProps({
    showMessagePopup: Boolean,
});
const emit = defineEmits(['update:showMessagePopup']);

onMounted(() => {
    checkOrLogged();
});

//Methods
function displayPopup()
{
    //showMessagePopup.value = showMessagePopup.value === true ? showMessagePopup.value = false : showMessagePopup.value = true;
}

</script>