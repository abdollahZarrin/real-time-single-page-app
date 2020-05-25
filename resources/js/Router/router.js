import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import Parallax from '../components/Parallax';
import Login from '../components/Auth/Login';
import Logout from '../components/Auth/Logout';
import Signup from '../components/Auth/Signup';
import Forum from '../components/forum/Forum';
import Read from '../components/forum/Read';
import Create from '../components/forum/Create';
import CreateCategory from '../components/category/CreateCategory';


const routes = [
    { path: '/', component: Parallax , name:'home' },
    { path: '/login', component: Login,name:'login' },
    { path: '/logout', component: Logout,name:'logout' },
    { path: '/signup', component: Signup,name:'signup' },
    { path: '/forum', component: Forum,name:'forum' },
    { path: '/question/:slug', component: Read,name:'read' },
    { path: '/ask', component: Create,name:'create' },
    { path: '/category', component: CreateCategory,name:'category' },
];
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

export default router;
