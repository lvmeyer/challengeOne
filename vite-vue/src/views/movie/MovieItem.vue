<template>

    <div class="movie-detail">
        <h2>{{movie.title}}</h2>
        <p>{{ movie.release_date }}</p>
        <!-- <img :src="movie.Poster" alt="Movie Poster" class="featured-img" /> -->
        <p>{{ movie.description }}</p>
    </div>

</template>

<script>
import axios from 'axios';
import { ref, onBeforeMount } from 'vue';
import { useRoute } from 'vue-router';

const API_URL = 'https://localhost/';

export default {
    

    setup () {
        const movie = ref({});
        const route = useRoute();
        onBeforeMount(async () => {
            const response = await axios.get(`${API_URL}movies/${route.params.id}`);
            movie.value = await JSON.parse(JSON.stringify(response.data))
        
        });
    
        return {
            movie
        }
    }
}
</script>

<style lang="scss">
.movie-detail {
    padding: 16px;
    h2 {
        color: #000;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 16px;
    }
    .featured-img {
        display: block;
        max-width: 200px;
        margin-bottom: 16px;
    }
    p {
        color: #000;
        font-size: 18px;
        line-height: 1.4;
    }
}
</style>
