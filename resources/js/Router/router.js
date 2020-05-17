import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import Login from '../components/Auth/Login';


const routes = [
    { path: '/login', component: Login,name:'login' },
];
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

export default router;
