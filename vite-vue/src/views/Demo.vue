<template>
    <section v-if="film">
        <h1>Film id: {{ filmId }}</h1>
        <h2>{{ film.name }}</h2>
    </section>
</template>

<script lang="ts">
import filmData from "../../films.json";

export default {
    data() {
        return {
            film: null,
        };
    },
    computed: {
        filmId() {
            if (typeof this.$route.params.id === "string") {
                return parseInt(this.$route.params.id);
            }
            return 0;
        },
    },

    async created() {
        const response = await fetch("../../films.json");
        this.film = await response.json();

        // NOT NEEDED IF WE USE :KEY FOR ROUTER-VIEW
        // this.$watch(
        //     () => this.$route.params.id,
        //     async () => {
        //         const response = await fetch("../../films.json");
        //         this.film = await response.json();
        //     }
        // );
    },
};
</script>
