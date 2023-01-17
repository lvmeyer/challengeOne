<template>
    <TheNavigation />
    <div class="container">
        <router-view v-slot="{ Component }">
            <transition name="slide" mode="out-in">
                <component :is="Component" :key="$route.path" />
            </transition>
        </router-view>
    </div>
</template>

<script setup lang="ts">
import TheNavigation from "./components/TheNavigation.vue";
</script>

<style lang="css">
.slide-enter-active,
.slide-leave-active {
    transition: opacity 0.2s, transform 0.2s;
}

.slide-enter-from,
.slide-leave-to {
    opacity: 0;
    transform: translateX(-30%);
}
</style>
