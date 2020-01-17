<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <h1>
                    Todos Imóveis
                </h1>
            </div>
            <div class="row">
                <div class="col-12 col-md-4" v-for="(imovel, index) in this.imoveis" :key="index">
                    <card
                        :key="index"
                        :value="imovel.value"
                        :img="imovel.photo"
                        :title="imovel.title"
                        :id="imovel.id"
                        :city="imovel.city"
                        :state="imovel.state"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Card from '../components/Card';
    export default {
        name: 'imoveis',
        props: ['app'],
        components: {
            Card,
        },
        data(){
            return{
                imoveis: null
            }
        },
        methods: {
            init(){
                axios.get('property/').then(response => {
                    this.imoveis = response.data;
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        mounted(){
          this.init();
        }
    }
</script>

<style lang="scss" scoped>
    .container-fluid{
        background: rgb(247, 247, 247);
        padding: 4rem 3rem;
        .row{
            &:nth-of-type(1){
                color: rgb(49, 58, 70);
                font-family: 'Hind', sans-serif;
            }
            &:nth-of-type(2){
                padding: 2rem;
            }
        }
    }
</style>
