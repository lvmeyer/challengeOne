<script>
import { ref, reactive, onBeforeMount} from 'vue';


const API_URL = import.meta.env.VITE_API_URL;
export default {
    components: {
    },
    setup () {
        const data = ref([])
        const user = ref({});
        const reviews_urls = ref({});
        const reviews = reactive([]);
     
        async function createNewReview(title, description) {
          const formData = {}
          formData.title = title;
          formData.description = description;
          formData.userId = "/users/2";
          console.log(typeof(formData))
          console.log(JSON.stringify({formData}))
          const response = await fetch(`${API_URL}/reviews`, {
            method: 'POST',
            headers: {
              'Content-type': 'application/json; charset=UTF-8' 
            },
            body: JSON.stringify(formData)
          });
          console.log(response.json())
          return await response.json();
        }
        
        onBeforeMount(async () => {
            try {
                
                const res_reviews = await fetch(`${API_URL}/reviews`);
                const data_reviews = await res_reviews.json();
                reviews.value = data_reviews;
                reviews.value = reviews["value"]["hydra:member"];
                for (let element of reviews.value){
                  if(element.userId == "/users/2"){
                    data.value = element
                    console.log(element);
                  }
                }
                console.log(data);
                /*const res_user = await fetch(`${API_URL}/users/1`);
                    const data_user = await res_user.json();
                    console.log( data_user);
                    user.value = data_user;
                    reviews_urls.value = user.value.reviews;
                    
                    console.log(reviews_urls);
                    for (const review of reviews_urls.value) {
                        await fetch(`${API_URL}${review}`)
                            .then(response => response.json())
                            .then(data => {
                                reviews.push(data);
                        }) }*/
            } catch (error) {
                console.log(error);
            }
        
        });
        
      
        return {
            reviews,
            data,
            createNewReview  
        }
    }      
         

};

</script>


<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Titre</th>
          <th scope="col">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="review in data" :key="review.id">
          <th scope="row">{{ review["<target>"] }}</th>
          <td>{{ review}}</td>
          <td>{{ review  }}</td>
        </tr>
        <tr>
          <td>
            <form @submit.prevent="createNewReview(title, description)">
              <input type="text" v-model="title" placeholder="Titre">
              <input type="text" v-model="description" placeholder="Ecrire ici">
              <button class="buttonAdd">Add review</button>    
            </form>
          </td>
        </tr>
      </tbody>
    </table>
    
  </div>
</template>


<style lang="css">

  #button-container {
    width: 100%;
    display:block;
    position:relative;
    margin-top: 100px;
    text-align: center;
    height: auto;
  }

  #save {
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