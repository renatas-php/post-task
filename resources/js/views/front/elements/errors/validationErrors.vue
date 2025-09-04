<template>
    <div class="flex flex-col">
        <p class="text-mainRed text-14px lg:text-16px" v-for="error in errors">{{ ErrorsHelper.removeErrorStringExtraSymbols(error) }}</p>
    </div>
</template>
<script setup lang="ts">

    import ErrorsHelper from '@/functions/errorsHelper';

    defineProps({
        errors: Array,
    });

</script>