import { defineStore } from "pinia";

export const useMovieStore = defineStore("MovieStore", {
  state: () => {
    return {
      movies: [],
    };
  },
  getters: {
    // count: (state) => state.movies.length
    // OR
    count() {
      return this.movies.length;
    },
  },
  actions: {
    async fetchMovies() {
      this.movies = (await import("../datas/movies.json")).movies;
    },
  },
});
