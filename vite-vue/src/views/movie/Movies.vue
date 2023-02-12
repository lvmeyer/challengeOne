<template>
    <div>
        <h1>Movies</h1>
        <p>Number of items: {{ movieStore.count }}</p>
        <MovieItem
            v-for="movie in movieStore.movies"
            :movie="movie"
            :key="movie._id"
        />
    </div>
</template>

<script setup lang="ts">
// @ts-ignore
import { useMovieStore } from "../../stores/MovieStore";
import MovieItem from "./components/MovieItem.vue";

const movieStore = useMovieStore();
movieStore.fetchMovies();
</script>
