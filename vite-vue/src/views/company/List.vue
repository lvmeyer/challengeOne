<script setup lang="ts">
import { ref } from 'vue';
import Products from "../../components/Company.vue";


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
}




</script>


<template>
  <Products @pressed="pressed"/>

  <div v-if="users">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Username</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <th scope="row">{{ user.id }}</th>
          <td>{{ user.name }}</td>
          <td>{{ user.username }}</td>
          <td><button class="buttonAction"><i class="bi bi-trash text-danger" @click="removeUser(user)"></i></button><button class="buttonAction"><i class="bi bi-pencil-square text-warning" @click="editUser(user)"></i></button></td>
        </tr>
        <tr>
          <td>
            <form @submit.prevent="addUser">
              <input v-model="name" placeholder="Name">
              <input v-model="userName" placeholder="userName">
              <button class="buttonAdd">Add User</button>    
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<style lang="css">
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