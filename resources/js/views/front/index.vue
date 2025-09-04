<template>
    <Navigation></Navigation>
    <section class="flex px-16px xl:px-104px bg-veryLightGrey dark:bg-mainBlueVeryDark py-100px">
        <div class="flex flex-col gap-20px max-w-600px">
            <h1 class="text-mainBlueVeryDark dark:text-white text-36px lg:text-48px font-semibold leading-[40px] lg:leading-[50px]">Viskas, ko reikia tavo idėjai įgyvendinti – vienoje vietoje</h1>
            <p class="text-mainBlueVeryDark dark:text-white text-20px lg:text-24px text-opacity-80 font-semibold">Suburk komandą ir realizuok savo projektą</p>
            <div class="flex flex-col gap-4px pt-10px">
                <div class="flex gap-16px">
                    <img :src="'/assets/icons/nike-white.svg'" alt="" width="16" height="16">
                    <p class="text-mainBlueVeryDark dark:text-white text-16px font-normal">Nemokamas projekto paskelbimas</p>
                </div>
                <div class="flex gap-16px">
                    <img :src="'/assets/icons/nike-white.svg'" alt="" width="16" height="16">
                    <p class="text-mainBlueVeryDark dark:text-white text-16px font-normal">Pagalba ieškant tinkamų bendraminčių</p>
                </div>
                <div class="flex gap-16px">
                    <img :src="'/assets/icons/nike-white.svg'" alt="" width="16" height="16">
                    <p class="text-mainBlueVeryDark dark:text-white text-16px font-normal">Profesionalų bendruomenė</p>
                </div>
            </div>
            <div class="flex flex-col xs:flex-row gap-20px pt-20px">
                <router-link :to="''" class="w-full md:w-fit flex justify-center gap-12px bg-darkPurple dark:bg-white dark:bg-opacity-90 hover:dark:bg-opacity-100 rounded-100px px-30px py-12px">
                    <span class="text-white dark:text-mainBlueVeryDark font-semibold text-16px">Sukurti projektą</span>
                </router-link>
                <router-link :to="'/registracija'" class="w-full md:w-fit flex justify-center gap-12px bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100 rounded-100px px-30px py-12px">
                    <span class="text-white font-semibold text-16px">Registruotis specialistui</span>
                </router-link>
            </div>
        </div>
        <img :src="'/assets/hero-1.png'" class="hidden lg:block max-w-600px w-full mx-auto object-contain" alt="" width="" height="">
    </section>
    <section class="flex flex-col px-16px xl:px-104px bg-veryLightGrey dark:bg-mainBlueVeryDark py-32px lg:py-100px">
        <div class="flex flex-col items-center gap-20px w-full">
            <h2 class="text-mainBlueVeryDark dark:text-white text-36px lg:text-48px font-semibold leading-[40px] lg:leading-[50px]">Tavo sėkmė prasideda čia</h2>
            <p class="text-mainBlueVeryDark dark:text-white text-20px lg:text-24px text-opacity-80 font-semibold">Lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
        </div>
        <div class="flex flex-col items-center w-full">
            <div class="hidden lg:flex gap-20px pt-60px">
                <button type="button" @click="showCards = 'posts'" class=" font-semibold text-16px flex gap-12px  rounded-100px px-30px py-12px" :class="showCards === 'posts' ? 'bg-darkPurple dark:bg-white dark:bg-opacity-90 hover:dark:bg-opacity-100 text-white dark:text-mainBlueVeryDark' : 'text-white bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100'">Naujausi projektai</button>
                <button type="button" @click="showCards = 'specialists'" class="text-white font-semibold text-16px flex gap-12px bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100 rounded-100px px-30px py-12px" :class="showCards === 'specialists' ? 'bg-darkPurple dark:bg-white dark:bg-opacity-90 hover:dark:bg-opacity-100 text-white dark:text-mainBlueVeryDark' : 'text-white bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100'">Populiariausi specialistai</button>
                <button type="button" @click="showCards = 'articles'" class="text-white font-semibold text-16px flex gap-12px bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100 rounded-100px px-30px py-12px" :class="showCards === 'articles' ? 'bg-darkPurple dark:bg-white dark:bg-opacity-90 hover:dark:bg-opacity-100 text-white dark:text-mainBlueVeryDark' : 'text-white bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100'">Naujaus straipsniai</button>
            </div>
            <swiper
                class="w-full !block lg:!hidden !pt-30px"
                :slides-per-view="'auto'"
                :loop="false"
                :space-between="16">
                    <swiper-slide class="!w-fit">
                        <button type="button" @click="showCards = 'posts'" class="w-fit font-semibold text-16px flex gap-12px  rounded-100px px-30px py-12px text-nowrap" :class="showCards === 'posts' ? 'bg-darkPurple dark:bg-white dark:bg-opacity-90 hover:dark:bg-opacity-100 text-white dark:text-mainBlueVeryDark' : 'text-white bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100'">Naujausi projektai</button>
                    </swiper-slide>
                    <swiper-slide class="!w-fit">
                        <button type="button" @click="showCards = 'specialists'" class="w-fit text-white font-semibold text-16px flex gap-12px text-nowrap bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100 rounded-100px px-30px py-12px" :class="showCards === 'specialists' ? 'bg-darkPurple dark:bg-white dark:bg-opacity-90 hover:dark:bg-opacity-100 text-white dark:text-mainBlueVeryDark' : 'text-white bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100'">Populiariausi specialistai</button>
                    </swiper-slide>
                    <swiper-slide>
                        <button type="button" @click="showCards = 'articles'" class="text-white font-semibold text-16px flex gap-12px text-nowrap bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100 rounded-100px px-30px py-12px" :class="showCards === 'articles' ? 'bg-darkPurple dark:bg-white dark:bg-opacity-90 hover:dark:bg-opacity-100 text-white dark:text-mainBlueVeryDark' : 'text-white bg-black dark:bg-opacity-80 hover:dark:bg-opacity-100'">Naujaus straipsniai</button>
                    </swiper-slide>
            </swiper>
            <div class="grid grid-cols lg:grid-cols-2 gap-20px pt-30px" v-if="showCards === 'posts'">
                <Post
                    v-for="post in posts"
                    :title="post?.title"
                    :categoryTitle="post?.category?.title"
                    :categoryColor="post?.category?.second_color"
                    :approvedSpecialists="post?.approved_specialists_count"
                    :specialistsNumber="post?.specialists_count"
                    :shortDescription="post?.short_description"
                    :city="post?.user?.city_plain"
                    :stage="post?.stage?.title"
                    :userSlug="post?.user?.slug"
                    :fullname="post?.user?.fullname"
                    :slug="post?.slug"
                    :buttonTitle="'Daugiau informacijos'">
                </Post>
            </div>
            <div class="grid grid-cols lg:grid-cols-2 gap-20px pt-30px" v-if="showCards === 'specialists'">
                <Specialist
                    v-for="specialist in specialists"
                    :expierences="specialist?.expierences"
                    :category="specialist?.category?.title"
                    :fullname="specialist?.fullname"
                    :city="specialist?.city"
                    :position="specialist?.position"
                    :shortDescription="specialist?.short_description">
                </Specialist>
            </div>
            <div class="grid grid-cols lg:grid-cols-2 gap-20px pt-30px" v-if="showCards === 'articles'">
                <Article
                    v-for="article in articles"
                    :slug="article?.slug"
                    :title="article?.title"
                    :description="article?.short_description"
                    :date="article?.formated_date">
                </Article>
            </div>
        </div>
    </section>
    <section class="flex flex-col lg:flex-row items-center px-16px xl:px-104px bg-veryLightGrey dark:bg-mainBlueVeryDark py-100px gap-100px dark:linearPurpleBottomTop">
        <img :src="'/assets/hero-2.png'" class="w-full mx-auto" alt="" width="" height="">
        <div class="flex flex-col gap-20px max-w-600px">
            <h3 class="text-mainBlueVeryDark dark:text-white text-36px lg:text-48px font-semibold leading-[40px] lg:leading-[50px]">Matyk viską. Valdyk eigą.</h3>
            <div class="text-mainBlueVeryDark dark:text-white text-18px leading-[30px] text-opacity-80 font-light">
                Mūsų aiški ir patogi valdymo aplinka sukurta tam, kad galėtum lengvai stebėti savo projekto eigą, komandos veiklą ir svarbiausius etapus – viskas vienoje vietoje.
                <br>
                Nesvarbu, ar tik pradedi, ar jau turi patirties – sistema sukurta taip, kad būtų patogi tiek naujokams, tiek pažengusiems. Vienu žvilgsniu galėsi įvertinti progresą ir greitai atlikti reikiamus pakeitimus.
            </div>
        </div>
    </section>
    <section class="flex flex-col items-center px-16px xl:px-104px bg-veryLightGrey dark:bg-mainBlueVeryDark py-100px gap-100px dark:linearPurpleTopBottom">
        <div class="flex flex-col items-center gap-20px w-full">
            <h1 class="text-mainBlueVeryDark dark:text-white text-36px lg:text-48px font-semibold leading-[40px] lg:leading-[50px]">Mūsų kūrėjų, idėjų autorių ir profesionalų nuomonės</h1>
            <p class="text-mainBlueVeryDark dark:text-white text-24px text-opacity-80 font-semibold">Lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-30px w-full lg:w-auto">
            <div class="flex flex-col justify-between bg-opacity-80 dark:bg-opacity-100 bg-mainBlueVeryDark rounded-10px p-30px w-full lg:w-300px h-auto lg:h-300px" v-for="review in reviews">
                <div class="flex flex-col">
                    <p class="text-white text-24px font-semibold">{{ review?.title }}</p>
                    <p class="text-white text-16px">{{ review?.company }}</p>
                </div>
                <div class="flex flex-col">
                    <div class="flex gap-4px pt-24px pb-6px">
                        <img :src="'/assets/icons/star-yellow.svg'" alt="star-yellow" width="20" height="20" v-for="i in review?.stars">
                    </div>
                    <p class="text-white text-opacity-80 text-16px max-w-250px">{{ review?.description }}</p>
                    <span class="text-white text-opacity-50 text-14px pt-10px block">{{ review?.formated_created_at }}</span>
                </div>
            </div>
        </div>
    </section>
    <Footer></Footer>
</template>
<script setup lang="ts">

    //Import 
    import { ref, onMounted, watch, inject } from 'vue';
    import axios from 'axios';
    import router from '@/routes/index';
    import ClassicLoader from '@/views/front/elements/loaders/classicLoader.vue';
    import Navigation from '@/views/front/includes/navigation.vue';
    import Footer from '@/views/front/includes/footer.vue';
    import MainCta from '@/views/front/elements/buttons/main-cta.vue';
    import AuctionLiveCard from '@/views/front/elements/cards/auctionLive.vue';
    import AuctionSoonCard from '@/views/front/elements/cards/auctionSoon.vue';
    import AuctionSoldCard from '@/views/front/elements/cards/auctionSold.vue';
    import VerifyUserPopup from '@/views/front/elements/popups/userApprove.vue';
    import staticDataHelper from '@/functions/staticDataHelper';
    import Post from '@/views/front/elements/cards/post.vue';
    import Specialist from '@/views/front/elements/cards/specialist.vue';
    import Article from '@/views/front/elements/cards/article.vue';
    import { useHead } from '@unhead/vue';
    //Swiper
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import { Grid, Pagination } from 'swiper/modules';
    import 'swiper/css';
    import 'swiper/css/pagination';

    //Refs
    const showBidPopup = ref<boolean>(false);
    const auctionToBid = ref<number>(0);
    const newests = ref<object[]>([]);
    const newestSkip = ref<number>(0);
    const newestTake = ref<number>(6);
    const newestLoadMore = ref<boolean>(true);

    const showCards = ref<string>('posts');
    const popularsLoader = ref<boolean>(false);
    const posts = ref<object[]>([]);
    const specialists = ref<object[]>([]);
    const articles = ref<object[]>([]);
    const popularSkip = ref<number>(0);
    const popularTake = ref<number>(6);
    const popularLoadMore = ref<boolean>(true);
    const emitter = inject('emitter'); // Inject `emitter`;
    const disabledButtons = ref<number[]>([]);
    const loading = ref<number>(0);
    
    //Reviews
    const reviewsLoader = ref<boolean>(false);
    const reviews = ref<object[]>([]);


    onMounted(() => {
        getPopularPosts();
        getPopularSpecialists();
        getPopularArticles();
        getReviews();
        setMetaTags();
    });

    //Methods 
    function getNewestProducts()
    {   
        loading.value = 1;

        setTimeout(() => {
            axios.get('/api/front/products-newest',
            {
                params: {
                    skip: newestSkip.value,
                    take: newestTake.value,
                },
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('aukcionasToken')
                }
            })
            .then(response => {
                response.data.data.forEach((item) => {
                    newests.value.push(item);
                });
                newestLoadMore.value = response.data?.load_more;
                loading.value = 0;
                newestSkip.value += 6;
            })
            .catch(function (error) {
                loading.value = 0;
            });
        }, 700);
        
    }

    function getPopularPosts()
    {   
        popularsLoader.value = true;
        setTimeout(() => {
            axios.get('/api/front/posts-populars')
            .then(response => {
                posts.value = response.data.data;
                popularsLoader.value = false;
            })
            .catch(function (error) {
                popularsLoader.value = false;
            });
        }, 700);
    }

    function getPopularSpecialists()
    {   
        popularsLoader.value = true;
        setTimeout(() => {
            axios.get('/api/front/specialists-populars')
            .then(response => {
                specialists.value = response.data.data;
                popularsLoader.value = false;
            })
            .catch(function (error) {
                popularsLoader.value = false;
            });
        }, 700);
    }

    function getPopularArticles()
    {   
        popularsLoader.value = true;
        setTimeout(() => {
            axios.get('/api/front/articles-populars')
            .then(response => {
                articles.value = response.data.data;
                popularsLoader.value = false;
            })
            .catch(function (error) {
                popularsLoader.value = false;
            });
        }, 700);
    }

    function getReviews()
    {   
        reviewsLoader.value = true;
        setTimeout(() => {
            axios.get('/api/front/reviews', {
                params: {
                    take: 3,
                }
            })
            .then(response => {
                reviews.value = response.data.data;
                reviewsLoader.value = false;
            })
            .catch(function (error) {
                reviewsLoader.value = false;
            });
        }, 700);
    }

    function setMetaTags()
    {
        useHead({
            title: 'Drabužiai pagaminti Lietuvoje | Stitch Please',
            meta: [
                {
                    name: 'description',
                    content: 'Drabužiai pagaminti Lietuvoje, unikalūs mūsų kurti ir siųti moteriški ir vyriški drabužiai',
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
                    content: 'Drabužiai pagaminti Lietuvoje | Stitch Please',
                },
                {
                    name: 'DC.description',
                    content: 'Drabužiai pagaminti Lietuvoje, unikalūs mūsų kurti ir siųti moteriški ir vyriški drabužiai',
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
                    content: 'Drabužiai pagaminti Lietuvoje, unikalūs mūsų kurti ir siųti moteriški ir vyriški drabužiai',
                },
                {
                    name: 'og:title',
                    content: 'Drabužiai pagaminti Lietuvoje | Stitch Please',
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
        });
    }
    
</script>