require('./bootstrap');

import { createApp } from "vue";

import Front from "../components/Front";
import router from "./router";

createApp({
    components: {
        Front
    }
}).use(router).mount("#app");





/*
window.Vue = require('vue');

Vue.component('front-page', require('../components/Front.vue').default);

const app = new Vue({
    el: '#app',
});
*/
