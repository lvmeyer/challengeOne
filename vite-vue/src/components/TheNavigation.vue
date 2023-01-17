<template>
    <nav id="nav">
        <router-link to="/">Home</router-link> |
        <router-link to="/about">About</router-link> |
        <router-link :to="{ name: 'demo.show', params: { id: '1' } }"
            >Demo1</router-link
        >
        <router-link :to="{ name: 'demo.show', params: { id: '2' } }"
            >Demo2</router-link
        >
        | <router-link to="/login">Login</router-link> |
        <router-link to="/register">Register</router-link>
    </nav>
</template>

<style>
.router-link-active {
    color: red;
}
</style>
