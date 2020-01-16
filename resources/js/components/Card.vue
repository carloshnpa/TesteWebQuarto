<template>
    <div>
        <div class="card">
            <div class="card-img-top" :style="{ backgroundImage: `url(${img})` }"></div>
            <div class="card-body">
                <h4 class="card-title">{{ title }}</h4>
                <p class="card-text">{{ value }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'card',
        props: {
            img:{
                type: String,
                required: true
            },
            title:{
                type: String,
                required: true
            },
            value:{
                type: Number,
                required: true,
            },
            id: {
                type: Number,
                required: true
            }
        },
    }
</script>

<style lang="scss" scoped>
.card{
    .card-img-top{
        height: 250px;
        background-position: center;
        background-size: cover;
    }
}
</style>
