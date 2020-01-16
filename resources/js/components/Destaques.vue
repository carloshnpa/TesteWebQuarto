<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <h1>
                    Destaques
                </h1>
            </div>
            <div class="row">
                <div class="col-4" v-for="(destaque, index) in this.destaques" :key="index">
                    <card
                        :key="index"
                        :value="destaque.value"
                        :img="destaque.photo"
                        :title="destaque.title"
                        :id="destaque.id"
                    />
                </div>
            </div>
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
                }).catch(erro => {
                    console.log(erro)
                })
            }
        },

    }
</script>

<style lang="scss" scoped>

</style>
