import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/home/Home.vue";
import filmDb from "../../films.json";

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: "/about",
    name: "about",
    component: () => import("../views/about/About.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () => import("../views/auth/Login.vue"),
  },
  {
    path: "/register",
    name: "register",
    component: () => import("../views/auth/Register.vue"),
  },
  {
    path: "/movies",
    name: "movies",
    component: () => import("../views/movie/Movies.vue"),
  },
  {
    path: "/movie/:id",
    name: "movie.show",
    component: () => import("../views/movie/MovieItem.vue"),
  },
  {
    path: "/demo/:id",
    name: "demo.show",
    component: () => import("../views/Demo.vue"),
    beforeEnter(to: any, from: any) {
      const exists = filmDb.find((film) => film.id === parseInt(to.params.id));
      if (!exists) {
        return { name: "not-found" };
      }
    },
  },
  {
    path: "/:pathMatch(.*)*",
    name: "not-found",
    component: () => import("../views/NotFound.vue"),
  },
  {
    path: "/reservation",
    name: "reservation",
    component: () => import("../views/movie/Reservation.vue"),
  },
  {
    path: "/purchase",
    name: "purchase",
    component: () => import("../views/movie/Reservation.vue"),
  },
];

export const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return (
      savedPosition ||
      new Promise((resolve) => {
        setTimeout(() => {
          resolve({ top: 0, left: 0 });
        }, 200);
        // TIMING DEPENDS ON CSS TRANSITION ANIMATION
      })
    );
  },
});
