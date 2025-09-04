<template>
    <Navigation></Navigation>
    <div class="px-16px xl:px-104px dark:bg-mainBlueVeryDark py-200px">
        <div class="mx-auto rounded-32px w-full md:w-450px">
            <div class="flex flex-col gap-16px px-0px md:px-32px pt-0px pb-32px">
                <div class="flex flex-col gap-8px">
                    <h1 class="text-mainBlueVeryDark dark:text-white text-24px lg:text-20px font-bold">Prisijunkite prie savo paskyros</h1>
                    <p class="text-12px lg:text-14px text-mainBlueVeryDark dark:text-white dark:text-opacity-50">Įveskite savo el. pašto adresą ir slaptažodį norėdami prisijungti</p>
                </div>
                <div class="flex flex-col gap-16px">
                    <ClassicInput
                        :placeholder="'Įveskite el. pašto adresą'"
                        :type="'text'"
                        v-model="email">
                    </ClassicInput>
                    <ClassicInput
                        :placeholder="'Slaptažodis'"
                        :type="'password'"
                        v-model="password">
                    </ClassicInput>
                </div>
                <a href="/slaptazodzio-priminimas" class="text-right text-14px pt-4px text-mainBlueVeryDark dark:text-white dark:text-opacity-50 transition-all underline">Pamiršote slaptažodį?</a>
                <div class="flex flex-col" v-show="Object.keys(errors)?.length > 0">
                    <p class="text-mainRed text-14px lg:text-16px" v-for="error in errors">{{ ErrorsHelper.removeErrorStringExtraSymbols(error) }}</p>
                </div>
                <MainCta
                    :buttonClass="'bg-dark bg-darkPurple dark:bg-darkPurple dark:bg-opacity-30 hover:dark:bg-opacity-50 font-semibold text-white'"
                    @click="login"
                    :title="'Prisijungti'"
                    :loading="loginAction"
                    :loaderColor="'#fff'">
                </MainCta>
                <router-link :to="'/registracija'" class="text-center text-14px pt-4px text-mainBlueVeryDark dark:text-white dark:text-opacity-50 transition-all underline">Registracija</router-link>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">

//Imports
import { ref, onMounted } from 'vue';
import router from '@/routes/index';
import axios from 'axios';
import { Auth } from '@/store/auth';
import Footer from '@/views/front/includes/footer.vue';
import Navigation from '@/views/front/includes/navigation.vue';
import MainCta from '@/views/front/elements/buttons/main-cta.vue';
import SocialLoginCta from '@/views/front/elements/buttons/social-login-cta.vue';
import Breadcrumb from '@/views/front/components/breadcrumb.vue';
import ClassicInput from '@/views/front/components/inputs/ClassicInput.vue';
import { useHead } from '@unhead/vue';

import ErrorsHelper from '@/functions/errorsHelper';

// Refs
const formType = ref<string>('login');
const errors = ref({});
const loginLoader = ref<boolean>(false);
const registerAction = ref<boolean>(false);
const gmailLoginAction = ref(false);
const facebookLoginAction = ref(false);
const loginSuccess = ref(false);
const email = ref<string>('');
const password = ref<string>('');
const privacy = ref<boolean>(false);
const passwordRememberAction = ref<boolean>(false);
const resetPasswordLinkSent = ref<boolean>(false);
const loginAction = ref<boolean>(false);

onMounted(() => {
    setMetaTags();
});

//Methods
async function login()
{   
    await axios.get('/api/sanctum/csrf-cookie');
    loginAction.value = true;

    //setTimeout(() => {
        await axios.post('/api/login', {
            email: email.value,
            password: password.value,
        })
        .then(response => {
            if(response.status === 200)
            {
                router.push({ path: '/my-posts' });
            }
        })
        .catch(function (error) {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors
                loginAction.value = false;
            }
            if (error.response && error.response.status === 401) {
                errors.value = error.response.data.errors
                loginAction.value = false;
            }
        });
    //}, 800);        
}

function passwordRemember()
{
    passwordRememberAction.value = true;
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
}

function socialLogin(provider: string)
{
    if(provider === 'google')
    {
        gmailLoginAction.value = true;
    }

    if(provider === 'facebook')
    {
        facebookLoginAction.value = true;
    }

    axios.get('/api/social/' + provider)
    .then(response => {
        window.location.replace(response.data.url);
    })
    .catch(function (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors
        }
        if (error.response && error.response.status === 401) {
            errors.value = error.response.data.errors
        }
    });  
}

function setMetaTags()
{
    let title = 'Prisijungimas | Stitch Please';
    let description = 'Prisijungimas drabužių pagamintų Lietuvoje, unikalių mūsų kurtų ir siųtų moteriškų ir vyriškų drabužių';

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