import Vue from 'vue';
import vuetify from './plugins/vuetify';
import VueRouter from 'vue-router';
import router from './Router/router';

window.Vue = require('vue');
Vue.use(vuetify);
Vue.use(VueRouter);
require('./bootstrap');

Vue.component('app-home',require('./components/AppHome').default);

const app = new Vue({
   el : '#app',
    vuetify,
    router
});
