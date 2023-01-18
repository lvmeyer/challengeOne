<template>
    <div class="movie-item-container">
        <h1>{{ movie.title }}</h1>
        <h2>{{ movie.publishedDate }}</h2>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    movie: {
        title: string;
        publishedDate: Date;
    };
}>();
</script>
