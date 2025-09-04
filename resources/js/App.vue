<template>
    <RouterView v-slot="{ Component }">
        <component :is="Component" />
    </RouterView>
    
</template>

<script setup lang="ts">
    //Imports
    import { ref } from 'vue';
    import { useRoute } from 'vue-router';

</script>