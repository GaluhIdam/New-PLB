require('./bootstrap');

import Vue from 'vue'
window.Vue = require('vue').default;

// Import Router
import router from './router'
// Global Components
import './global-components'

const app = new Vue({
    el: '#app',
    router
});