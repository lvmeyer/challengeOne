<script lang="ts" setup>
import { useUserStore } from "../stores/UserStore.js";
import { useRouter } from "vue-router";

const router = useRouter();
const user = useUserStore();

async function handleLogout() {
    await user.logout();
    router.push({ name: "login" });
}
</script>

<template>
    <nav id="nav" class="d-flex justify-content-between pt-3 pb-2">
        <div>
            <router-link to="/" class="p-2 m-3">Home</router-link>
            <router-link to="/about" class="p-2 m-3">About</router-link>
            <router-link to="/movies" class="p-2 m-3">Movies</router-link>
            <router-link to="/admin/dashboard" class="p-2 m-3">Moderation</router-link>
            <router-link
                :to="{ name: 'demo.show', params: { id: '1' } }"
                class="p-2 m-3"
                >Demo1</router-link
            >
            <router-link
                :to="{ name: 'demo.show', params: { id: '2' } }"
                class="p-2 m-3"
                >Demo2</router-link
            >
            <router-link to="/products" class="p-2 m-3">Products</router-link>
        </div>
        <div v-if="user.isLoggedIn">
            <a href="#" class="p-2 m-3" v-on:click="handleLogout">Logout</a>
        </div>
        <div v-else>
            <router-link to="/login" class="p-2 m-3">Login</router-link>
            <router-link to="/register" class="p-2 m-3">Register</router-link>
        </div>
    </nav>
    <hr />
</template>

<style>
.router-link-active {
    background-color: #d9e8f5;
    border-radius: 4px;
}

nav > div a {
    color: black;
    text-decoration: none;
    position: relative;
    transition: color 0.2s ease-in-out;
}

nav > div a:before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background-color: black;
    transform: scaleX(0);
    transition: transform 0.2s ease-in-out;
}

nav > div a:hover {
    color: gray;
}

nav > div > a:hover:before {
    transform: scaleX(1);
}
</style>
