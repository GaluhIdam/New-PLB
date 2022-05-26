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

import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)
import "vue-multiselect/dist/vue-multiselect.min.css"

// Routes
let routes = [{
        path: '/home',
        name: 'home',
        component: require('./components/Home.vue').default
    },
    {
        path: '/mutation',
        name: 'mutation',
        component: require('./components/Aircraft/Mutation.vue').default
    },
    {
        path: '/delivery',
        name: 'mutation',
        component: require('./components/Aircraft/Delivery.vue').default
    },
    {
        path: '/redelivery',
        name: 'delivery',
        component: require('./components/Aircraft/Redelivery.vue').default
    },
    {
        path: '/data-users',
        name: 'data-users',
        component: require('./components/Users/DataUsers.vue').default
    },
    {
        path: '/users-role',
        name: 'users-role',
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