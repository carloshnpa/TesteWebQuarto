require('./bootstrap');
import Welcome from './components/Welcome.vue';
window.Vue = require('vue');

Vue.component('Welcome', Welcome);

const app = new Vue({
    el: '#app'
});