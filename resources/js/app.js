/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import Vue from 'vue'
require('./bootstrap');

window.Vue = require('vue');
import router from './router.js'
import App from './components/App.vue'
import store from './store/index.js'
import ViewUI from 'view-design'
import 'view-design/dist/styles/iview.css'
import locale from  'view-design/dist/locale/en-US.js'

// Vue.use(ViewUI);
Vue.use(ViewUI, {locale: locale});



const app = new Vue({
    el: '#app',

    components: {
        App
    },

    router,
    store,
});
