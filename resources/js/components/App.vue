<template>
    <div class="app">
        <navbar :app="this"></navbar>
        <router-view :app="this"></router-view>
    </div>
</template>
<script>

import Navbar from './Navbar';

export default {

    name: "App",
    mounted() {
        this.init();
    },
    data(){
        return{
            user: null,
            loading: false,
            initiated: false,
        }
    },
    methods: {
        init(){
            this.loading = true;
            axios.get('/auth/init').then(response => {
                this.user = response.data.user;
                this.loading = false;
                this.initiated = true;
            })
        },
    },
    components: {
        Navbar
    }
};
</script>
<style scoped>
    .app {
        height: 100%;
    }
</style>
