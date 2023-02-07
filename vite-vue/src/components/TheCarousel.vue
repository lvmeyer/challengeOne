<template>
    
<div id="app">
	<Carousel :settings="settings" :breakpoints="breakpoints">
        <slide v-for="slide in 10" :key="slide">
            <div class="carousel__item">
                <a href="">{{ slide }}</a>
            </div>
        </slide>
        <!-- <MovieItem
            v-for="movie in movieStore.movies"
            :movie="movie"
            :key="movie._id"
        /> -->

		<template #addons>
			<navigation />
		</template>
	</Carousel>
</div>
</template>


<script lang="ts">
    //@ts-ignore
    import { defineComponent } from 'vue'
    import { Carousel, Pagination, Slide, Navigation } from 'vue3-carousel'
    // import  useMovieStore  from "../stores/MovieStore"
    import MovieItem from "../views/movie/components/MovieItem.vue"

    import '../../node_modules/vue3-carousel/dist/carousel.css'

    export default defineComponent({
        name: 'Autoplay',
        components: {
            Carousel,
            // MovieItem,
            Pagination,
            Navigation,
            Slide
        },
        data: () => ({
            // carousel settings
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
            },
            // breakpoints are mobile first
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
            // 700px and up
            700: {
                itemsToShow: 3.5,
                snapAlign: 'center',
            },
            // 1024 and up
            1024: {
                itemsToShow: 7,
                snapAlign: 'start',
            },
            },
        })
    })

    // const movieStore = useMovieStore();
    // movieStore.fetchMovies();


</script>

<style scoped>

body {
	padding: 20px;
}

.carousel__item {
	min-height: 200px;
	width: 100%;
	background-color: #642afb;
	color: white;
	font-size: 20px;
	border-radius: 8px;
	display: flex;
	justify-content: center;
	align-items: center;
}

.carousel__slide {
	padding: 10px;
}

.carousel__prev,
.carousel__next {
	background-color: #fff7;
}


</style>
