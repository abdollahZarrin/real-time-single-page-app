import Vue from 'vue';
import vuetify from './plugins/vuetify';
import router from './Router/router';
import User from './Helpers/User';
import Exception from './Helpers/Exception';
import CKEditor from '@ckeditor/ckeditor5-vue';

Vue.use( CKEditor );
window.Vue = require('vue');
window.User = User;
window.Exception = Exception;
window.EventBus = new Vue();
Vue.use(vuetify);
require('./bootstrap');

Vue.component('app-home',require('./components/AppHome').default);

const app = new Vue({
   el : '#app',
    vuetify,
    router
});
