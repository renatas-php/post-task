<template>
    <footer class="px-16px xl:px-104px py-32px xl:pt-64px xl:pb-32px bg-veryLightGrey dark:bg-mainBlueVeryDark text-white relative">
        <div class="flex flex-col mt-32px text-white text-opacity-50">
            <p class="text-14px text-center">© 2025 Footeris</p>
        </div>
    </footer>
</template>
<script setup lang="ts">

    //Imports
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    import MainCta from '@/views/front/elements/buttons/main-cta.vue';
    import { useDark, useToggle } from '@vueuse/core';

    import ErrorsHelper from '@/functions/errorsHelper';

    //Refs

    const isDark = useDark();
    const toggleDark = useToggle(isDark);

    onMounted(() => {
 
    });

    //Methods




</script>