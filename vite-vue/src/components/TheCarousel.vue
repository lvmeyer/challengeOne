<template>

<div class="carousel-container">
<div class="inner-carousel">
<div class="track">

    <div class="card-container" v-for="movie in movies" :key="movie.id">
      <router-link :to="'/movie/' + movie.id">  
            <div class="card card1" >
                <p>{{ movie.title }}</p>
                <p>{{ movie.duration }} min</p>
            </div>
      </router-link>
    </div>


</div>
<div class="nav">
    <button class="prev"><i class="fas fa-arrow-left fa-2x"></i></button>
    <button class="next"><i class="fas fa-arrow-right fa-2x"></i></button>
</div>
</div>
</div>

</template>

<script>
    import { ref, onBeforeMount } from 'vue';
    import axios from 'axios';
    
    const API_URL = 'https://localhost/'
    export default {
      setup () {
        const movies = ref({});
        onBeforeMount(async () => {
          const response = await axios.get(`${API_URL}movies?page=1`);
          movies.value = await JSON.parse(JSON.stringify(response.data["hydra:member"]));
            
        });
    
        return {
            movies
        }
    },
    mounted () {

        const prev = document.querySelector(".prev");
        const next = document.querySelector(".next");
        const carousel = document.querySelector(".carousel-container");

        const track = document.querySelector(".track");
        let width = carousel.offsetWidth;
        let index = 0;
        window.addEventListener("resize", function () {
        width = carousel.offsetWidth;
        });
        next.addEventListener("click", function (e) {
        e.preventDefault();
        index = index + 1;
        prev.classList.add("show");
        track.style.transform = "translateX(" + index * -width + "px)";
        if (track.offsetWidth - index * width < index * width) {
            next.classList.add("hide");
        }
        });
        prev.addEventListener("click", function () {
        index = index - 1;
        next.classList.remove("hide");
        if (index === 0) {
            prev.classList.remove("show");
        }
        track.style.transform = "translateX(" + index * -width + "px)";
        })
    }

}


</script>

<style>
    * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
img {
  max-width: 100%;
}
.carousel-container {
  width: 1100px;
  margin: 50px auto;
  position: relative;
  border-left-width: 4px;
  border-left-style: solid;
  border-left-color: #aaa;
}
@media (max-width: 768px) {
  .carousel-container {
    width: 95%;
  }
}
.inner-carousel {
  width: 100%;
  height: 400px;
  overflow: hidden;
}
.track {
  display: inline-flex;
  height: 100%;
  transition: transform 0.2s ease-in-out;
}
.card-container {
  width: 275px;
  height: 400px;
  flex-shrink: 0;
  padding-right: 10px;
}
@media (max-width: 768px) {
  .card-container {
    width: 184px;
  }
}
.card {
  width: 100%;
  height: 100%;
  /*display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;*/
  background-position: center bottom;
  background-size: center;
  background-repeat: no-repeat;
  border-radius: 10px;
}
.card1 {
  background-image: url("https://cdn.pixabay.com/photo/2018/08/21/23/29/fog-3622519_960_720.jpg");
}
.card2 {
  background-image: url("https://cdn.pixabay.com/photo/2016/11/14/04/45/elephant-1822636_960_720.jpg");
}
.card3 {
  background-image: url("https://cdn.pixabay.com/photo/2016/08/11/23/48/italy-1587287_960_720.jpg");
}
.card4 {
  background-image: url("https://cdn.pixabay.com/photo/2014/08/29/03/02/horse-430441_960_720.jpg");
}
.card5 {
  background-image: url("https://cdn.pixabay.com/photo/2014/12/08/17/52/mare-561221_960_720.jpg");
}
.card6 {
  background-image: url("https://cdn.pixabay.com/photo/2017/02/08/17/24/butterfly-2049567_960_720.jpg");
}
.card7 {
  background-image: url("https://cdn.pixabay.com/photo/2017/11/30/22/00/pumpkin-2989569_960_720.jpg");
}
.card8 {
  background-image: url("https://cdn.pixabay.com/photo/2016/07/24/22/25/woman-1539416_960_720.jpg");
}
.card9 {
  background-image: url("https://cdn.pixabay.com/photo/2017/11/15/09/28/music-player-2951399_960_720.jpg");
}
.card10 {
  background-image: url("https://cdn.pixabay.com/photo/2018/02/23/04/38/laptop-3174729_960_720.jpg");
}
.card11 {
  background-image: url("https://cdn.pixabay.com/photo/2016/03/09/09/30/woman-1245817_960_720.jpg");
}
.card12 {
  background-image: url("https://cdn.pixabay.com/photo/2016/11/08/05/31/adorable-1807544_960_720.jpg");
}

.nav button {
  position: absolute;
  top: 50%;
  transform: translatey(-50%);
  width: 60px;
  height: 60px;
  border-radius: 50%;
  outline: none;
  border: 1px solid #000;
  cursor: pointer;
}
.nav .prev {
  left: -30px;
  display: none;
}
.nav .prev.show {
  display: block;
}
.nav .next {
  right: -30px;
}
.nav .next.hide {
  display: none;
}


</style>