<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <h1>{{ this.imovel.title }}</h1>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 p-3">
                    <div class="img-top" :style="{ backgroundImage: `url(/images/${this.imovel.photo})`}">

                    </div>
                    <div class="info">
                        <h3>
                            {{this.imovel.description}}
                        </h3>
                        <h5>Adressdwnkdlandkabjscasnc,mas cmnd ,am </h5>
                        <hr>
                        <h4>R$ {{ this.imovel.value }}</h4>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-3">
                    <!-- <GoogleMap/> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import GoogleMap from '../components/map/GoogleMap';

    export default {
        name: 'imovel',
        props: ['app'],
        components: {
            // GoogleMap
        },
        async mounted () {
            await this.init();
        },
        data() {
            return {
                imovel : '',
                coordinates: '',
                errors : []
            }
        },
        methods: {
            async init() {
                await axios.get(`property/${this.$route.query.id}`).then(response => {
                    this.imovel = response.data
                }).catch(error => {
                    console.log(error);
                } )

                // this.getPositionMap();
            },
            getPositionMap(){
                var instance = axios.create();
                delete instance.defaults.headers.common['X-CSRF-TOKEN'];
                delete instance.defaults.headers.common['X-Requested-With'];

                instance.get(encodeURI(`https://maps.googleapis.com/maps/api/geocode/json?address=${this.imovel.number},${this.imovel.street},${this.imovel.city}&key=AIzaSyBAWi18GYAgJOjQapq-AAlDs_4ZXV40qeg)`))
                    .then(response => {
                        this.coordinates = response
                        console.log(response)
                    }).catch(error => {
                        console.log(error)
                        this.errors.push(error)
                    })
            }
        },

    }
</script>

<style lang="scss" scoped>
    .container-fluid{
        background: rgb(247, 247, 247);
        padding:3rem 4rem;
        .img-top{
            height: 300px;
            background-position: center;
            background-size: cover;
        }
        .info{
            margin-top: 16px;
            font-family: 'Hind';
            color: rgb(49, 58, 70);
            h3{
                font-size: 20px;
            }
            h4{
                font-size: 18px;
            }
            h5{
                font-size: 14px;
            }
        }
    }
</style>
