import Home from '../layouts/Home.vue';
import Login from '../layouts/Login.vue';

export default [{
    path: '/',
    component: Home,
    name: 'home'
}, {
    path: '/login',
    component: Login,
    name: 'login'
}]