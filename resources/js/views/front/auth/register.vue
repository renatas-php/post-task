<template>
    <Navigation></Navigation>
    <div class="px-16px xl:px-104px dark:bg-mainBlueVeryDark py-200px">
        <div class="mx-auto rounded-32px w-full md:w-450px">
            <div class="flex flex-col gap-16px px-0px md:px-32px pt-0px pb-32px">
                <div class="flex flex-col gap-8px">
                    <h1 class="text-mainBlueVeryDark dark:text-white text-24px lg:text-20px font-bold">Susikurkite savo paskyrą</h1>
                    <p class="text-12px lg:text-14px text-mainBlueVeryDark dark:text-white dark:text-opacity-50">Pasirinkite ar esate specialistas ar įdėjos autorius ieškantis specialistų</p>
                </div>
                <div class="flex flex-col gap-16px">
                    <ClassicInput
                        :placeholder="'Email'"
                        :type="'text'"
                        :class="errors?.email ? '' : ''"
                        v-model="email">
                    </ClassicInput>
                    <ClassicInput
                        :placeholder="'Name'"
                        :type="'text'"
                        :class="errors?.name ? '' : ''"
                        v-model="name">
                    </ClassicInput>
                    <ClassicInput
                        :placeholder="'Surname'"
                        :type="'text'"
                        :class="errors?.surname ? '' : ''"
                        v-model="surname">
                    </ClassicInput>
                    <ClassicInput
                        :placeholder="'Slaptažodis'"
                        :type="'password'"
                        :class="errors?.password ? '' : ''"
                        v-model="password">
                    </ClassicInput>
                </div>
                <div class="flex flex-col" v-show="Object.keys(errors)?.length">
                    <p class="text-mainRed text-14px lg:text-16px" v-for="error in errors">{{ ErrorsHelper.removeErrorStringExtraSymbols(error) }}</p>
                </div>
                <MainCta
                    :buttonClass="'bg-dark bg-darkPurple dark:bg-darkPurple dark:bg-opacity-30 hover:dark:bg-opacity-50 font-semibold text-white'"
                    :title="'Registruotis'"
                    :loading="registerAction"
                    :loaderColor="'#fff'"
                    @click="register">
                </MainCta>
                <router-link :to="'/prisijungti'" class="text-center text-14px pt-4px text-mainBlueVeryDark dark:text-white dark:text-opacity-50 transition-all underline">Prisijungti</router-link>
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
const registerLoader = ref<boolean>(false);
const gmailLoginAction = ref(false);
const loginSuccess = ref(false);
const email = ref<string>('');
const name = ref<string>('');
const surname = ref<string>('');
const password = ref<string>('');
const privacy = ref<boolean>(false);
const passwordRememberAction = ref<boolean>(false);
const resetPasswordLinkSent = ref<boolean>(false);
const registerAction = ref<boolean>(false);
const roleType = ref<string>('');

onMounted(() => {
    setMetaTags();
});

//Methods
function register()
{
    registerAction.value = true;
    setTimeout(() => {
        axios.post('/api/register', {
            email: email.value,
            name: name.value,
            surname: surname.value,
            password: password.value,
        })
        .then(response => {            
            router.push({ path: '/my-posts' });
            registerAction.value = false; 
        })
        .catch(function (error) {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors
                registerAction.value = false;
            }
            if (error.response && error.response.status === 401) {
                errors.value = error.response.data.errors
                registerAction.value = false;
            }
        });
    }, 800);
}

function setMetaTags()
{
    let title = 'Registracija | Stitch Please';
    let description = 'Registracija drabužių pagamintų Lietuvoje, unikalių mūsų kurtų ir siųtų moteriškų ir vyriškų drabužių';

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