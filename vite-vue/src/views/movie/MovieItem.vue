<template>

    <div class="movie-detail">
        <h2>{{movie.title}}</h2>
        <p>{{ movie.release_date }}</p>
        <img src="../../assets/img/avatar.jpg" alt="Movie Poster" class="featured-img" />
        <p>{{ movie.description }}</p>

        <h2> Seances</h2>
        <div class="row">
            <div v-if="seances" v-for="(seance, index) in seances" :key="seance.id" class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <button @click="showModals[index] = true" class="btn btn-primary">
                            {{ seance.start_time }}
                        </button> 
                    </div>  
                </div>
                
                <modal v-if="showModals[index]" @close="showModals[index] = false">
                    <template v-slot:header>
                        <h2>{{movie.title}}</h2>
                    </template>
                    <template v-slot:body>
                        <h3>{{seances[index].start_time}}</h3>
                        <h3>{{seances[index].price}}€</h3>
                    </template>
                    <template v-slot:footer>
                        <a @click="emitDataEvent(seances[index].price)" href="/stripe-test" class="button-cta cta-button">Réserver</a>
                    </template>
                </modal>
            </div>
            <div v-else>
                Aucune séance pour le moment
            </div>
            <div class="comment-contents">
                <p>Comments:</p>
                <div v-if="comments" v-for="(comment) in comments" :key="comment.id" class="col-sm-3">
                    <div class="comment">
                        <h3 class="comment-content">{{ comment.title }}</h3>
                        <p class="comment-content">{{ comment.description }}</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
    import { ref, reactive, onBeforeMount, onMounted } from 'vue';
    import { useRoute } from 'vue-router';
    import modal from "../../components/Modal.vue"
    import StripeTest from '../stripe/StripeTest.vue';

    const API_URL = import.meta.env.VITE_API_URL;
    function getHoursAndMinutes (dateString) {
        let date = new Date(dateString);

        let hours = date.getHours();
        let minutes = date.getMinutes();

        let formattedTime = `${hours.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}`;
        return formattedTime;
    }

    function getFullDate(date_string) {
        let dateString = date_string;
        let date = new Date(dateString);

        let dayOfWeek = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        let day = dayOfWeek[date.getUTCDay()];

        let months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
        let month = months[date.getUTCMonth()];

        let dayOfMonth = date.getUTCDate();

        let formattedDate = `${day} ${dayOfMonth} ${month}`;

        return formattedDate ;

    }
    export default {
        
        components: {
            modal,
            StripeTest
        },
        setup () {
            
            const movie = ref({});
            const seances_urls = ref({});
            const seances = reactive([]);
            const comments = reactive([]);
            const comments_url = ref({});
            const route = useRoute();
            const showModals = reactive(Array(seances.length).fill(false))
            onBeforeMount(async () => {
                try {
                    const res_movie = await fetch(`${API_URL}/movies/${route.params.id}`);
                    const data_movie = await res_movie.json();
                    movie.value = data_movie;
                    movie.value.release_date = new Date(movie.value.release_date).toLocaleDateString()
                    seances_urls.value = movie.value.seances;

                    // get comments
                    comments_url.value = movie.value.comments;
                    console.log(comments_url.value);
                    for (const comment of comments_url.value) {
                        await fetch(`${API_URL}${comment}`)
                            .then(response => response.json())
                            .then(data => {
                                comments.push(data);
                        })   
                    } 

                    for (const s of seances_urls.value) {
                        await fetch(`${API_URL}${s}`)
                            .then(response => response.json())
                            .then(data => {
                                data.start_time = getHoursAndMinutes(data.start_time)
                                seances.push(data);
                        })   
                    } 
            
                } catch (error) {
                    console.log(error);
                }
            
            });

            
            return {
                movie,
                seances_urls,
                seances,
                showModals,
                comments,
                comments_url
            }
        },
    /*  methods: {
            emitDataEvent(seance) {
                bus.$emit('data-event', seance)
        } */
    //}                
        
        
    
    };
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

.button-cta {
        background-color: #B3282F;
        color: #fff !important;
    }

.button-cta:hover {
    background-color: #6687BA;
}

.comment-contents {
    border-color: grey;
    border: solid;
    border-radius: 10px;
    padding: 1em;
    margin: 1em;
}

.comment {
    border-radius: 10px;
    padding: 1em;
    margin: 1em;
    width: 100%;
}

.comment-content {
    width: 100;
}
</style>
