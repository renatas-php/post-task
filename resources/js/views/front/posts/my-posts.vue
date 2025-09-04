<template>
    <Navigation></Navigation>
    <div class="px-16px xl:px-104px flex gap-100px py-64px pt-64px xl:pt-20px pr-16px xl:pr-104px relative dark:bg-mainBlueVeryDark">       
        <UserMenu></UserMenu>
        <div class="flex flex-col gap-32px lg:gap-64px w-full max-w-700px">
            <Breadcrumb
                :title="'My posts'"
                :description="'Add or edit your posts'">
            </Breadcrumb>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-32px w-full">
                <Post
                    v-for="post in posts"
                    :title="post?.name"
                    :content="post?.content"
                    :group="post?.group?.name"
                    :username="post?.user?.fullname"
                    :validFrom="post?.valid_from_formated"
                    :postId="post?.id"
                    @delete="deleteItemPopupShow">
                </Post>
            </div>
            <div class="flex flex-col gap-16px lg:hidden">
                <div class="flex flex-col gap-16px bg-mainBlueVeryDark dark:bg-mediumGrey dark:bg-opacity-30 text-white rounded-10px p-16px" v-for="project in projects" v-if="projects?.length > 0">
                    <div class="flex flex-col">
                        <p class="text-14px font-semibold">Pavadinimas:</p>
                        <p class="text-16px font-normal">{{ project?.title }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-14px font-semibold">Aplikacijos:</p>
                        <router-link v-if="project?.applications_count > 0" :to="'/profilis/projektai/' + project?.id + '/aplikacijos'" class="text-16px font-normal underline hover:text-bold">{{ project?.applications_count }}</router-link>
                        <p v-if="project?.applications_count < 1" class="hover:text-bold">{{ project?.applications_count }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-14px font-semibold">Peržiūros:</p>
                        <p class="text-16px font-normal">{{ project?.views }}</p>
                    </div>
                    <div class="flex flex-col justify-between">
                        <p class="text-14px font-semibold">Veiksmai:</p>
                        <div class="flex justify-between gap-16px">
                            <button type="button" @click="editPost(project?.id)"><img :src="'/assets/icons/edit-white.svg'" class="h-20px"></button>
                            <button type="button" @click="deletePopup(true, project?.id)"><img :src="'/assets/icons/close-red.svg'" class="h-16px"></button>
                        </div>
                    </div>
                </div>
                <div v-if="projects?.length < 1" class="flex flex-col gap-16px dark:text-white rounded-10px p-16px" v-for="project in projects">
                    <p class="text-14px text-center py-64px">Projektų nėra</p>
                </div>
            </div>
            <div class="max-w-700px">
                <h2 class="text-mainBlueVeryDark dark:text-white text-24px lg:text-20px font-bold">New post</h2>
                <div class="flex flex-col gap-16px pt-32px" v-if="postAddedSuccess === true">
                    <p class="text-mainBlueVeryDark dark:text-white text-14px lg:text-16px py-32px">Post succesfully added!</p>
                    <MainCta
                        :class="'w-fit px-50px bg-dark bg-darkPurple dark:bg-darkPurple dark:bg-opacity-30 hover:dark:bg-opacity-50 font-semibold text-white'"
                        @click="postAddedSuccess = false"
                        :title="'Create new post'">
                    </MainCta>
                </div>
                <div class="flex flex-col gap-16px pt-32px" v-if="postAddedSuccess === false">
                    <ClassicInput
                        :placeholder="'Name'"
                        :type="'text'"
                        v-model="name">
                    </ClassicInput>
                    <ClassicTextarea
                        :placeholder="'Content'"
                        :class="'min-h-150px'"
                        :type="'text'"
                        v-model="content">
                    </ClassicTextarea>
                    <flat-pickr
                        v-model="validFrom"
                        :placeholder="'Valid from'"
                        :config="{
                            enableTime: false,
                            dateFormat: 'Y-m-d',
                        }"
                        class="px-32px py-16px w-full bg-mainBlueVeryDark dark:bg-mediumGrey dark:bg-opacity-30 border-0 rounded-10px dark:placeholder:text-white dark:placeholder:text-opacity-80 dark:text-white text-14px lg:text-16px"
                    ></flat-pickr>
                    <div class="flex flex-col" v-show="errors">
                        <p class="dark:text-white text-14px lg:text-16px" v-for="error in errors">{{ ErrorsHelper.removeErrorStringExtraSymbols(error) }}</p>
                    </div>
                    <MainCta
                        v-if="postEditing === true"
                        :class="'w-fit px-50px bg-dark bg-darkPurple dark:bg-darkPurple dark:bg-opacity-30 hover:dark:bg-opacity-50 font-semibold text-white'"
                        @click="updatePost"
                        :title="'Update post'"
                        :loading="addPostLoader"
                        :loaderColor="'#FFF'">
                    </MainCta>
                    <MainCta
                        v-if="postEditing === false"
                        :class="'w-fit px-50px bg-dark bg-darkPurple dark:bg-darkPurple dark:bg-opacity-30 hover:dark:bg-opacity-50 font-semibold text-white'"
                        @click="addPost"
                        :title="'Add post'"
                        :loading="addPostLoader"
                        :loaderColor="'#FFF'">
                    </MainCta>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Popup -->
    <DeletePopup
        v-on:updateList="getPosts"
        :url="'/api/front/user-posts-delete'"
        :itemId="deleteItemId"
        :showDeletePopup="deleteItemPopup"
        @cancel="deleteItemPopupShow">
    </DeletePopup>
    <!-- ENd Delete Pop -->
    <Footer></Footer>
</template>
<script setup lang="ts">

//Import 
import axios from 'axios';
import { ref, onMounted, watch } from 'vue';
import router from '@/routes/index';
import Navigation from '@/views/front/includes/navigation.vue';
import UserMenu from '@/views/front/posts/elements/menu.vue';
import MainCta from '@/views/front/elements/buttons/main-cta.vue';
import Footer from '@/views/front/includes/footer.vue';
import Breadcrumb from '@/views/front/components/breadcrumb.vue';
import ClassicSelect from '@/views/front/components/inputs/ClassicSelect.vue';
import ClassicInput from '@/views/front/components/inputs/ClassicInput.vue';
import ClassicSingleCheckbox from '@/views/front/components/inputs/ClassicSingleCheckbox.vue';
import ClassicTextarea from '@/views/front/components/inputs/ClassicTextarea.vue';
import Post from '@/views/front/elements/cards/post.vue';
import DeletePopup from '@/views/front/posts/elements/delete-popup.vue';
import { useHead } from '@unhead/vue';

import ErrorsHelper from '@/functions/errorsHelper';

//flatpickr
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

//Refs
const errors = ref<object[]>([]);
const posts = ref<object[]>([]);
const skip = ref<number>(0);
const take = ref<number>(20);
const totalPages = ref<number>(1);
const currentPage = ref<number>(1);
//Post fields
const postEditing = ref<boolean>(false);
const name = ref<string>('');
const content = ref<string>('');
const validFrom = ref<string>('');
const addPostLoader = ref<boolean>(false);
const postAddedSuccess = ref<boolean>(false);
//Delete
const deleteItemPopup = ref<boolean>(false);
const deleteItemId = ref<null | number>(null);
const PostId = ref<number>(0);

onMounted(() => {
    getPosts();
    setMetaTags();
});

watch([
    router.currentRoute,
], async (newValue, OldValue) => {
    editPost();
});

//Methods
function getPosts()
{
    deleteItemPopup.value = false;
    axios.get('/api/front/user-posts', 
        {
            params: {
                skip: take.value * (currentPage.value - 1),
                take: take.value,
            }
        })
        .then(response => {
            posts.value = response.data.data;
        })
        .catch(function (error) {
    });
}

function editPost()
{
    if(router.currentRoute.value.params.id)
    {
        postEditing.value = true;
        axios.get('/api/front/user-posts/' + router.currentRoute.value.params.id)
            .then(response => {
                name.value = response.data.data?.name;
                content.value = response.data.data?.content;
                validFrom.value = response.data.data?.valid_from;
                window.scroll({
                    top: document.body.scrollHeight,
                    left: 0,
                    behavior: 'smooth'
                });
            })
            .catch(function (error) {
        });
    }
}

function addPost()
{
    errors.value = [];
    addPostLoader.value = true;
    setTimeout(() => {
        axios.post('/api/front/add-post', {
            name: name.value,
            content: content.value,
            valid_from: validFrom.value,
        })
        .then(response => {            
            addPostLoader.value = false;
            if(response.status === 200)
            {
                postAddedSuccess.value = true;
                name.value = '';
                content.value = '';
                validFrom.value = '';
                getPosts();
            }
             
        })
        .catch(function (error) {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors
                addPostLoader.value = false;
            }
            if (error.response && error.response.status === 401) {
                errors.value = error.response.data.errors
                addPostLoader.value = false;
            }
        });
    }, 700);
}

function updatePost()
{
    errors.value = [];
    addPostLoader.value = true;
    setTimeout(() => {
        axios.put('/api/front/update-post/' + router.currentRoute.value.params.id, {
            name: name.value,
            content: content.value,
            valid_from: validFrom.value,
        })
        .then(response => {            
            addPostLoader.value = false;
            if(response.status === 200)
            {
                name.value = '';
                content.value = '';
                validFrom.value = '';
                router.push({ path: '/my-posts' });
                getPosts();            
            }
             
        })
        .catch(function (error) {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        });
    }, 700);
}

function deleteItemPopupShow(id: number)
{
    deleteItemPopup.value = deleteItemPopup.value === true ? deleteItemPopup.value = false : deleteItemPopup.value = true;
    deleteItemId.value = id;
}


function setMetaTags()
{
    let title = 'My posts';
    let description = 'My posts';

    useHead({
        title: title,
        meta: [
                {
                    name: 'description',
                    content: description,
                },
        ],
        link: [
        {
            rel: 'canonical',
            href: router.currentRoute.value.path,
        },
    ]
    });
}

</script>