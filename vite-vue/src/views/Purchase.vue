<template>
    <div>
    <h1>Achat de tickets pour la séance FILM à HEURE</h1>
    <div class="ticket">
        <div class="ticket_number">
            <p>Tickets : </p>
            <div class="form-outline input-ticket">
                <input type="number" id="typeNumber" class="form-control" min="1" max="6"/>
            </div>
        </div>
        <p>Heure de la séance :</p>
        <p>Merci de vous présenter 10min avant le début du film. <br>
        Vos tickets vous seront envoyés par mail dans les plus brefs délais</p>
    </div>
  </div>
</template>

<style>
.ticket {   
    margin-top: 1em;
    align-items: center;
    border-radius: 30px;
    background: rgb(170, 168, 168);
    width: 75%;
    padding: 2em;
}

.ticket_number {
    display: flex;
    flex-direction: row;
}

.input-ticket {
    width: 10%;
    height: 2em;
    border-radius: 10px;
    margin-left: 1em;
    margin-bottom: 1em;
}
</style>

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
