import Vue from 'vue';
import vuetify from './plugins/vuetify';


window.Vue = require('vue');
Vue.use(vuetify);
require('./bootstrap');


const app = new Vue({
   el : '#app',
    vuetify,
});
