import Home from '../layouts/Home.vue';
import Login from '../layouts/Login.vue';
import Register from '../layouts/Register.vue';
import Imoveis from '../layouts/Imoveis.vue';
import Profile from '../layouts/Profile.vue';
import Imovel from '../layouts/Imovel.vue';

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
}, {
    path: '/imoveis',
    component: Imoveis,
    name: 'imoveis'
}, {
    path: '/profile',
    component: Profile,
    name: 'profile'
}, {
    path: '/imovel',
    component: Imovel,
    name: 'imovel'
}]