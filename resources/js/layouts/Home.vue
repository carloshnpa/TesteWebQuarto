<template>
    <div>
        <banner></banner>
        <destaques></destaques>
        <infos></infos>
        <customfooter></customfooter>
    </div>
</template>

<script>
import Banner from '../components/Banner';
import Destaques from '../components/Destaques';
import Infos from '../components/Infos';
import Footer from '../components/Footer';

export default {
    name: 'home',
    components: {
        Banner,
        Destaques,
        Infos,
        'customfooter' : Footer,
    },
}
</script>

<style lang="scss" scoped>
    banner{
        height: 50%;
    }
</style>
