<script setup lang="ts">
import { ref } from 'vue';
import Review from "../../components/Review.vue";

let users = ref(null) as any;
let testVal = ref(null) as any;
let adminSelect = ref(null) as any;

async function pressed() {
  const info = await fetch("https://jsonplaceholder.typicode.com/users");
  const json = await info.json();
  users.value = json;
  console.log(json);
  console.log(users);
}

</script>


<template>
  <Review @pressed="pressed"/>
    <div v-if="users">
      <div class="col-lg-4 col-xs-12 m-auto mt-5">
        <main class="form-signin w-100 border p-4 rounded shadow">
            <form>
                <h1 class="h3 mb-3 fw-normal">Fill your review</h1>

                <div class="w-50 mb-2">
                  <label>Choose the movie:</label>
                  <select v-model="testVal">
                    <option v-for="user in users" 
                      :value="user.id" 
                      :key="user.id">
                        {{user.name}}
                    </option>
                  </select>
                </div>

                <div class="form-group mb-2">
                  <label for="exampleFormControlTextarea1">Write your review here</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                
                
                <div class="w-50 mb-2">
                  <label>Choose the reviewer:</label>
                  <select v-model="adminSelect">
                    <option v-for="user in users" 
                      :value="user.id" 
                      :key="user.id">
                        {{user.name}}
                    </option>
                  </select>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="published" /> You validate the review
                    </label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">
                    Submit
                </button>
            </form>
        </main>
    </div>
</div>
</template>

