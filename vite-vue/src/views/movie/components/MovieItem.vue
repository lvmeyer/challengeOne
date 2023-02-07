<template>

    <div class="movie-item-container">
        <h1>{{ movie.title }}</h1>
        <h2>{{ movie.releaseDate }}</h2>
    </div>
    
</template>

<script setup lang="ts">
defineProps<{
        movie: {
            id: string;
            type: string;
            title: string;
            director: string;
            release_date: Date;
            description: string;
            duration: Number;
            comments: Array<string>;
            seances: Array<string>;
            releaseDate: Date;
            duration2: Number;
        };
    }>();
</script>
