import { createRouter, createWebHistory } from "vue-router";

import Login from "../../components/Login";
import Register from "../../components/Register";
import Home from "../../components/Home";
import Profile from "../../components/Profile";
import Purchase from "../../components/Purchase";
import Mytickets from "../../components/Mytickets";

const guard = function(to, from, next) {
    // check for valid auth token
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
    axios.get('/api/checktoken').then(response => {
        // Token is valid, so continue
        next();
    }).catch(error => {
        // There was an error so redirect
        next('/login');
    })
  };

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
        beforeEnter: (to, from, next) => {
            guard(to, from, next);
        }
    },
    {
        path: '/purchase',
        name: 'purchase',
        component: Purchase,
        beforeEnter: (to, from, next) => {
            guard(to, from, next);
        }
    },
    {
        path: '/profile/mytickets',
        name: 'mytickets',
        component: Mytickets,
        beforeEnter: (to, from, next) => {
            guard(to, from, next);
        }
    }
]

export default createRouter({
    history: createWebHistory(),
    routes,
})
