<template class="map-container">
    <GoogleMapLoader
        class="map"
        :mapConfig="mapConfig"
        apiKey="AIzaSyBAWi18GYAgJOjQapq-AAlDs_4ZXV40qeg"
    >
        <template slot-scope="{ google, map }">
            <GoogleMapMarker
                v-for="marker in markers"
                :key="marker.id"
                :marker="marker"
                :google="google"
                :map="map"
            />
            <GoogleMapLine
                v-for="line in lines"
                :key="line.id"
                :path.sync="line.path"
                :google="google"
                :map="map"
            />
        </template>
    </GoogleMapLoader>
</template>

<script>
import GoogleMapLoader from "./GoogleMapLoader";
import GoogleMapMarker from "./GoogleMapMarker";

import { mapSettings } from "../../constants/mapSettings";

export default {
    components: {
        GoogleMapLoader,
        GoogleMapMarker,
    },

    data() {
        return {
            markers: [
                { id: "a", position: { lat: -19.8090553, lng: -43.1787911 } },

            ],
        };
    },

    computed: {
        mapConfig() {
            return {
                ...mapSettings,
                center: this.mapCenter
            };
        },

        mapCenter() {
            return this.markers[0].position;
        }
    },
};
</script>

<style scoped>
    .map-container{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 400px;
    }
    .map{
        position: relative;
        height: 400px;
    }
</style>
