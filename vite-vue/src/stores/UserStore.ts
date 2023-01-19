import { defineStore } from "pinia";

interface State {
  user: User | null;
  isLoggedIn: boolean;
}

interface User {
  name: string;
  email: string;
  isAuthenticate: boolean;
}

const isLoggedIn = localStorage.getItem("access_token") ? true : false;
console.log("ISLOG?", isLoggedIn);

export const useUserStore = defineStore("UserStore", {
  state: (): State => ({ user: {} as User, isLoggedIn }),

  getters: {},

  actions: {
    async login(credentials: {
      email: string;
      password: string;
    }): Promise<boolean | void> {
      try {
        const response = await fetch("http://localhost:3003/api/login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(credentials),
        });
        const data = await response.json();
        console.log(data);
        if (response.status !== 201 || !response.ok) {
          throw new Error(data.message);
        }
        // TODO: check if user is needed
        this.user = data.user;
        this.isLoggedIn = true;
        localStorage.setItem("access_token", data.access_token);
        return true;
      } catch (error) {
        console.error(error);
      }
    },

    async logout() {
      const response = await fetch("http://localhost:3003/api/logout", {
        method: "DELETE",
      });
      console.log("logout", response);

      this.user = null;
      this.isLoggedIn = false;
      localStorage.removeItem("access_token");
    },
  },
});
