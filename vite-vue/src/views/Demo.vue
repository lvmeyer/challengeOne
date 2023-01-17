<template>
    <section v-if="film">
        <GoBack />
        <h1>Film id: {{ filmId }}</h1>
        <h2>{{ film.name }}</h2>
    </section>
</template>

<script lang="ts">
import GoBack from "../components/GoBack.vue";
import filmDb from "../../films.json";

export default {
    components: {
        GoBack,
    },
    computed: {
        filmId() {
            if (typeof this.$route.params.id === "string") {
                return parseInt(this.$route.params.id);
            }
            return 0;
        },
        film() {
            return filmDb.find((film) => film.id === this.filmId);
        },
    },
    // async created() {
    // const response = await fetch("../../films.json");
    // this.films = await response.json();
    // console.log(this.films);
    // NOT NEEDED IF WE USE :KEY FOR ROUTER-VIEW
    // this.$watch(
    //     () => this.$route.params.id,
    //     async () => {
    //         const response = await fetch("../../films.json");
    //         this.film = await response.json();
    //     }
    // );
    // },
};
</script>
