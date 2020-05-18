import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import Login from '../components/Auth/Login';
import Logout from '../components/Auth/Logout';
import Signup from '../components/Auth/Signup';
import Forum from '../components/forum/Forum';


const routes = [
    { path: '/login', component: Login,name:'login' },
    { path: '/logout', component: Logout,name:'logout' },
    { path: '/signup', component: Signup,name:'signup' },
    { path: '/forum', component: Forum,name:'forum' },
];
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

export default router;
