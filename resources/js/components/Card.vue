<template>
    <div>
        <div class="card">
            <div class="card-img-top"
                :style="{ backgroundImage: `url(/images/${img})`, height: `${img_h}px` }"
            ></div>
            <div class="card-body">
                <h4 class="card-title">{{ title }}</h4>
                <div class="local">
                    <i class="fas fa-map-marker-alt m-r-5"></i> {{ `${city}, ${state}` }}
                </div>
                <div class="valor">
                    <p>R$ {{ value }}</p>
                </div>
            </div>
            <div class="card-footer">
                <router-link :to="{ name: 'imovel', query: { id : this.id }}" replace v-if="this.edit == false" class="btn">
                    Saber Mais
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'card',
        props: {
            img: String,
            title: String,
            value: Number,
            id: Number,
            city: String,
            state: String,
            img_h: {
                type: Number,
                default: 250
            },
            edit: {
                type: Boolean,
                default: false
            }
        },
    }
</script>

<style lang="scss" scoped>
.card{
    border: none;
    border-radius: 0;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s cubic-bezier(0.075, 0.82, 0.165, 1);
    text-align: center;
    &:hover{
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.3);
        .card-img-top{
            &:hover{
                transform: scale(1.03);
            }
        }
    }
    .card-img-top{
        background-position: center;
        background-size: cover;
        transition: all 0.5s ease;

    }
    .card-body{
        color: rgb(49, 58, 70);
        h4.card-title{
            font-size: 26px;
        }
        .valor{
            p{
                font-size: 20px;

            }
        }
    }
    .card-footer{
        display: flex;
        justify-content: center;
        .btn{
            background-color: #52d298;
            color: white;
            margin: 10px 0;
        }
    }

}
</style>
