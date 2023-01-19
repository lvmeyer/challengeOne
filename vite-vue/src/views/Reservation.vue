<template>
    <div>
    <h1>Ma réservation</h1>
    <div class="booking">
        <p>Film : </p>
        <p>Nombre de places : </p>
        <p>Heure de la séance :</p>
        <p>Merci de vous présenter 10min avant le début du film. <br>
        Vos tickets vous seront envoyés par mail dans les plus brefs délais</p>
    </div>
  </div>
</template>

<script>
import GoBack from "../components/GoBack.vue";
import filmDb from "../../films.json";


//idk if it works but it should
export default {

   
  data() {
    return {
      movies: [],
    };
  },


  methods: {
    async getData() {
      try {
        let response = await fetch("https://localhost/movies"); //wrong route but you get the idea
        this.movies = await response.json();;
      } catch (error) {
        console.log(error);
      }
    },
  },


  created() {
    this.getData();
  },
};

</script>
