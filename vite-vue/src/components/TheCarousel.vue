<template>
    <div class="carousel">
        <div class="inner" ref="inner" :style="innerStyles">
            <div class="card" v-for="movie in movies" :key="card">
            {{ movie.title }}
            {{ movie.duration }}
            </div>
        </div>
    </div>
    <button @click="prev">prev</button>
    <button @click="next">next</button>
</template>

<script>
    import axios from 'axios';
    const API_URL = 'https://localhost'
    export default {
        data () {
        return {
            movies: [],
            innerStyles: {},
            step: '',
            transitioning: false
        }
        },
    
        mounted () {
            this.fetchMovies()
        this.setStep()
        this.resetTranslate()
        },
    
        methods: {

            async fetchMovies() {
                        const response = await axios.get(`${API_URL}/movies?page=1`);
                        this.movies = await JSON.parse(JSON.stringify(response.data["hydra:member"]));
                        
                        console.log(this.movies)
                    },
        setStep () {
            const innerWidth = this.$refs.inner.scrollWidth
            const totalCards = this.movies.length
            this.step = `${innerWidth / totalCards}px`
            
        },
    
        next () {
            if (this.transitioning) return
    
            this.transitioning = true
    
            this.moveLeft()
    
            this.afterTransition(() => {
            const card = this.cards.shift()
            this.movies.push(card)
            this.resetTranslate()
            this.transitioning = false
            })
        },
    
        prev () {
            if (this.transitioning) return
    
            this.transitioning = true
    
            this.moveRight()
    
            this.afterTransition(() => {
            const card = this.cards.pop()
            this.cards.unshift(card)
            this.resetTranslate()
            this.transitioning = false
            })
        },
    
        moveLeft () {
            this.innerStyles = {
            transform: `translateX(-${this.step})
                        translateX(-${this.step})`
            }
        },
    
        moveRight () {
            this.innerStyles = {
            transform: `translateX(${this.step})
                        translateX(-${this.step})`
            }
        },
    
        afterTransition (callback) {
            const listener = () => {
            callback()
            this.$refs.inner.removeEventListener('transitionend', listener)
            }
            this.$refs.inner.addEventListener('transitionend', listener)
        },
    
        resetTranslate () {
            this.innerStyles = {
            transition: 'none',
            transform: `translateX(-${this.step})`
            }
        }
        }
    }
</script>

<style>
    .carousel {
    width: 170px;
    overflow: hidden;
    }

    .inner {
    transition: transform 0.2s;
    white-space: nowrap;
    }

    .card {
        width: 40px;
        margin-right: 10px;
        display: inline-flex;

        /* optional */
        height: 50px;
        background-color: #39b1bd;
        color: white;
        border-radius: 4px;
        align-items: center;
        justify-content: center;
    }

    /* optional */
    button {
    margin-right: 5px;
    margin-top: 10px;
    }
</style>