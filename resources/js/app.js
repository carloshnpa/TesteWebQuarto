require('./bootstrap');

import App from './components/App.vue';
import VueRouter from 'vue-router';
import routes from './routes/routes';

window.Vue = require('vue');

Vue.component('spinner', require('vue-simple-spinner'));
Vue.use(VueRouter);

const router = new VueRouter({
    routes
});
const app = new Vue({
    router,
    el: '#app',
    components: { App },
    template: "<App />"
})