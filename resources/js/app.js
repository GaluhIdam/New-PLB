require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';

// VueRouter
import VueRouter from 'vue-router'
Vue.use(VueRouter)
// VueAxios
import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios)
// VueProgressBar
// vForm


// Routes
let routes = [{
        path: '/mutation',
        component: require('./components/Aircraft/Mutation.vue').default
    },
    {
        path: '/delivery',
        component: require('./components/Aircraft/Delivery.vue').default
    },
    {
        path: '/redelivery',
        component: require('./components/Aircraft/Redelivery.vue').default
    },
    {
        path: '/data-users',
        component: require('./components/Users/DataUsers.vue').default
    },
    {
        path: '/users-role',
        component: require('./components/Users/UsersRole.vue').default
    },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router
});