require('./bootstrap');

import { createApp } from "vue";

import App from "../components/App";
import router from "./router";
import Vuex from "vuex";

const store = new Vuex.Store({
    state:{
        auth: false,
    },
    mutations:{
        setAuth(state, status) {
            state.auth = status;
        }
    }
})

createApp(App).use(router).mount("#app");
