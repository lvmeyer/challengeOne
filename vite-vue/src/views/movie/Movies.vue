<template>
    <div>
        <h1>Movies</h1>
        <TheCarousel>
        </TheCarousel>
    </div>
</template>


<script setup lang="ts">
    import { Carousel, Pagination, Slide, Navigation } from 'vue3-carousel'
    import MovieItem from "./components/MovieItem.vue";
    import TheCarousel from "../../components/TheCarousel.vue";


</script>



