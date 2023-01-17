<template>
    <nav id="nav" class="d-flex justify-content-between p-3 bg-light">
        <div>
            <router-link to="/" class="p-2 m-3">Home</router-link>
            <router-link to="/about" class="p-2 m-3">About</router-link>
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
        </div>
        <div>
            <router-link to="/login" class="p-2 m-3">Login</router-link>
            <router-link to="/register" class="p-2 m-3">Register</router-link>
        </div>
    </nav>
</template>

<style>
.router-link-active {
    color: red;
}
</style>
