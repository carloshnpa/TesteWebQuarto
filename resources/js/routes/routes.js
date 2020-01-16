import Home from '../layouts/Home.vue';
import Login from '../layouts/Login.vue';
import Register from '../layouts/Register.vue';

export default [{
    path: '/',
    component: Home,
    name: 'home'
}, {
    path: '/login',
    component: Login,
    name: 'login'
}, {
    path: '/register',
    component: Register,
    name: 'register'
}]