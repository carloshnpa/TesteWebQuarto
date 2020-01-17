<template>
    <div class="container-fluid">
        <div class="row">
            <h1>
                Destaques
            </h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-4" v-for="(destaque, index) in this.destaques" :key="index">
                <card
                    :key="index"
                    :value="destaque.value"
                    :img="destaque.photo"
                    :title="destaque.title"
                    :id="destaque.id"
                    :city="destaque.city"
                    :state="destaque.state"
                />
            </div>
        </div>
        <div class="row">
            <router-link to="/imoveis" class="btn btn-lg">
                Ver Todos
            </router-link>
        </div>
    </div>
</template>

<script>
    import Card from './Card';

    export default {
        name: 'destaques',
        props: ['app'],
        components:{
            Card
        },
        data() {
            return {
                destaques : null,
            }
        },
        mounted() {
            this.init();
        },
        methods: {
            init() {
                axios
                .get('/destaques')
                .then(response => {
                    this.destaques = response.data.destaques;
                }).catch(error => {
                    console.log(error)
                })
            }
        },

    }
</script>

<style lang="scss" scoped>
    .container-fluid{
        font-family: 'Hind', sans-serif;
        padding: 3rem 1rem;
        .row:nth-of-type(1){
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 2rem 0;
            h1{
                font-size: 48px;
            }
        }
        .row:nth-of-type(2){

        }
        .row:nth-of-type(3){
            display: flex;
            justify-content: center;
            .btn{
                font-family: 'Hind', sans-serif;
                background-color: #55748f;
                color: white;
                margin-top: 40px;
                margin-bottom: 10px;
            }
        }
    }
</style>
