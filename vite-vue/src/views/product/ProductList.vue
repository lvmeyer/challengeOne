<script>
/*import { ref } from 'vue';
import Products from "../../components/Products.vue";


// give each todo a unique id
let id = 0;
let users = ref(null) as any;
const newUser = ref('');
let name = ref('');
let userName = ref('');



function addUser() {
  console.log(newUser);
  console.log(id);
    users.value.push({ id: id++, name: name.value, username: userName.value });
    name.value = '';
    userName.value = ''; 
}


function removeUser(user: any) {
    users.value = users.value.filter((u: any) => u !== user)
}


function editUser(user: any) {
    users.value = users.value.filter((u: any) => u !== user)
}


async function pressed() {
  const info = await fetch("https://jsonplaceholder.typicode.com/users");
  const json = await info.json();
  users.value = json;
  console.log(json);
  console.log(users);
}*/


    import axios from 'axios';
    const API_URL = 'https://localhost'
    export default {
        data () {
        return {
            movies: [],
            innerStyles: {}
           
        }
        },
    
        mounted () {
            this.fetchMovies()
          
        
        },
    
        methods: {

            async fetchMovies() {
                        const response = await axios.get(`${API_URL}/movies?page=1`);
                        this.movies = await JSON.parse(JSON.stringify(response.data["hydra:member"]));
                       console.log(this.movies)
                    }
                  }
        
                }


</script>


<template>


  <div v-if="movies">
    <section style="background-color: #eee;">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-12 col-lg-4 mb-4 mb-lg-4" v-for="user in movies" >
            <div class="card">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/4.webp"
                class="card-img-top" alt="Laptop" />
              <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                  <h5 class="mb-0"></h5>
                  <h5 class="text-dark mb-0"> &euro;</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<style lang="css">
  section {
    margin-bottom: 2em;
  }

  .buttonAction {
    background: none;
    border: none;
    padding: 0;
    cursor: cursor;
    outline: none;
    margin-right: 2em;
  }
 
  .buttonAdd {
    color: #fff;
    border-radius: 5px;
    font-family: 'Lato', sans-serif;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
    box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
    7px 7px 20px 0px rgba(0,0,0,.1),
    4px 4px 5px 0px rgba(0,0,0,.1);
    outline: none;
    background: linear-gradient(0deg, rgba(255,151,0,1) 0%, rgba(251,75,2,1) 100%);
    width: 130px;
    height: 40px;
    line-height: 42px;
    padding: 0;
    border: none;
    text-align: center;
  }
</style>