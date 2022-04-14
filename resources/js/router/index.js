import { createRouter, createWebHistory } from "vue-router";

import Front from "../../components/Front.vue";
import Dashboard from "../../components/Dashboard";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Front
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
