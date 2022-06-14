import { createRouter, createWebHistory } from "vue-router";

import Login from "../../components/Login";
import Register from "../../components/Register";
import Home from "../../components/Home";
import Profile from "../../components/Profile";
import Purchase from "../../components/Purchase";
import Mytickets from "../../components/Mytickets";



const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile,
        meta: {requiresAuth: true}
    },
    {
        path: '/purchase',
        name: 'purchase',
        component: Purchase
    },
    {
        path: '/profile/mytickets',
        name: 'mytickets',
        component: Mytickets
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
