import {createApp} from 'vue'
import App from '@/App.vue';
import { createPinia } from 'pinia';
import VueSocialSharing from 'vue-social-sharing'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import router from '@/routes/index';
import { CkeditorPlugin } from '@ckeditor/ckeditor5-vue';
import { createHead } from '@unhead/vue';
import axios from 'axios';
import mitt from 'mitt';

axios.defaults.baseURL = 'http://127.0.0.1:8000';
axios.defaults.withCredentials = true;

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

const emitter = mitt();

const head = createHead();

const Vue = createApp(App);

Vue.provide('emitter', emitter);
Vue.use(VueSocialSharing);
Vue.use(pinia)
Vue.use(head)
Vue.use(CkeditorPlugin)
Vue.use(router).mount("#app")
