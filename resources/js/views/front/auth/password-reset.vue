<template>
    <Navigation></Navigation>
    <div class="px-16px xl:px-104px dark:bg-mainBlueVeryDark py-200px">
        <div class="mx-auto rounded-32px w-full md:w-450px">
            <div class="flex flex-col gap-16px px-0px md:px-32px pt-0px pb-32px">
                <div class="flex flex-col gap-8px">
                    <h1 class="text-mainBlueVeryDark dark:text-white text-24px lg:text-20px font-bold">Slaptažodžio priminimas</h1>
                    <p class="text-12px lg:text-14px text-mainBlueVeryDark dark:text-white dark:text-opacity-50">Slaptažodžio keitimo nuoroda bus išsiųsta į nurodytą el. pašto adresą</p>
                </div>
                <div class="flex flex-col gap-16px" v-if="resetPasswordLinkSent === false">
                    <div class="flex flex-col gap-16px">
                        <ClassicInput
                            :placeholder="'El. paštas'"
                            :type="'text'"
                            v-model="email">
                        </ClassicInput>
                    </div>
                    <div class="flex flex-col" v-show="Object.keys(errors)?.length">
                        <p class="text-mainRed text-16px" v-for="error in errors">{{ ErrorsHelper.removeErrorStringExtraSymbols(error) }}</p>
                    </div>
                    <MainCta
                        :buttonClass="'bg-dark bg-darkPurple dark:bg-darkPurple dark:bg-opacity-30 hover:dark:bg-opacity-50 font-semibold text-white'"
                        @click="passwordRemember"
                        :title="'Siųsti priminimą'"
                        :loading="passwordRememberAction"
                        :loaderColor="'#FFF'">
                    </MainCta>
                </div>
                <div class="flex flex-col gap-16px" v-if="resetPasswordLinkSent === true">
                    <p class="text-mainBlueVeryDark dark:text-white text-center py-40px px-32px border border-black">Jeigu el. pašto adresas egzistuoja slaptažodžio keitimo nuoroda buvo išsiųsta į nurodytą el. pašto adresą</p>
                    <router-link :to="'/prisijungti'" class="text-center font-semibold py-14px rounded-100px bg-dark bg-darkPurple dark:bg-darkPurple dark:bg-opacity-30 hover:dark:bg-opacity-50 font-semibold text-white">Prisijungti</router-link>
                </div>
            </div>
        </div>
    </div>
    <Footer></Footer>
</template>
<script setup lang="ts">

//Imports
import { ref, onMounted } from 'vue';
import router from '@/routes/index';
import axios from 'axios';
import Footer from '@/views/front/includes/footer.vue';
import Navigation from '@/views/front/includes/navigation.vue';
import MainCta from '@/views/front/elements/buttons/main-cta.vue';
import Breadcrumb from '@/views/front/components/breadcrumb.vue';
import ClassicInput from '@/views/front/components/inputs/ClassicInput.vue';
import { useHead } from '@unhead/vue';

import ErrorsHelper from '@/functions/errorsHelper';

// Refs
const formType = ref<string>('login');
const errors = ref({});
const email = ref<string>('');
const passwordRememberAction = ref<boolean>(false);
const resetPasswordLinkSent = ref<boolean>(false);

onMounted(() => {
    setMetaTags();
});

//Methods
function passwordRemember()
{
    passwordRememberAction.value = true;
    errors.value = [];

    setTimeout(() => {
        axios.post('/api/forget-password', {
            email: email.value,
        })
        .then(response => {
            passwordRememberAction.value = false;
            if(response.status === 200)
            {
                resetPasswordLinkSent.value = true;
            }
        })
        .catch(function (error) {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors
                passwordRememberAction.value = false;
            }
            if (error.response && error.response.status === 401) {
                errors.value = error.response.data.errors
                passwordRememberAction.value = false;
            }
        });
    }, 800);
}

function setMetaTags()
{
    let title = 'Slaptažodžio priminimas | Stitch Please';
    let description = 'Slaptažodžio priminimas drabužių pagamintų Lietuvoje, unikalių mūsų kurtų ir siųtų moteriškų ir vyriškų drabužių';

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

</script>