<template>
    <div id="popup-modal" tabindex="-1" class="bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-popupBg" :class="showDeletePopup === true ? 'flex' : 'hidden'">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Ar tikrai norite ištrinti šį įrašą?</h3>
                    <button data-modal-hide="popup-modal" type="button" @click="deleteItem" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Ištrinti
                    </button>
                    <button data-modal-hide="popup-modal" type="button" @click="cancelDelete" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Atšaukti</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">

    //Imports
    import { ref } from 'vue';
    import axios from 'axios';

    //Emits
    const emit = defineEmits(['deleteItem', 'updateList', 'cancel']);   

    //Props
    const props = defineProps({
        showDeletePopup: Boolean,
        url: String,
        itemId: Number,
    });

    //Method 
    function cancelDelete()
    {
        emit('cancel');
    }

    function deleteItem()
    {
        axios.delete(props?.url + '/' + props?.itemId)
        .then(response => {
           emit('updateList');
        })
        .catch(function (error) {
            
        });
    }

</script>