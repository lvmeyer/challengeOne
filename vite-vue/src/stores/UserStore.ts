import { defineStore } from "pinia";

interface State {
  user: User | null;
  isLoggedIn: boolean;
}

interface User {
  name: string;
  isAuthenticate: boolean;
}

const isLoggedIn = localStorage.getItem("access_token") ? true : false;
console.log("IsLoggedIn:", isLoggedIn);

export const useUserStore = defineStore("UserStore", {
  state: (): State => ({ user: {} as User, isLoggedIn }),

  getters: {},

  actions: {
    async login(credentials: {
      email: string;
      password: string;
    }): Promise<boolean | void> {
      console.log(credentials);

      try {
        const response = await fetch("https://localhost/authentication_token", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(credentials),
        });
        const data = await response.json();
        console.log("data received:", data);

        if (response.status !== 200 || !response.ok) {
          throw new Error(data.message);
        }

        // TODO: check if user is needed
        this.user = {
          name: credentials.email,
          isAuthenticate: true,
        };
        this.isLoggedIn = true;
        console.log("user:", this.user);

        localStorage.setItem("access_token", data.token);
        return true;
      } catch (error) {
        console.error(error);
      }
    },

    async register(credentials: {
      email: string;
      plainPassword: string;
      firstname: string;
      lastname: string;
    }) {
      try {
        console.log("req", credentials);

        const response = await fetch("https://localhost/users", {
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
        return true;
      } catch (error) {
        console.error(error);
      }
    },

    async logout() {
      // const response = await fetch("http://localhost:3003/api/logout", {
      //   method: "DELETE",
      // });
      // console.log("logout", response);

      this.user = null;
      this.isLoggedIn = false;
      localStorage.removeItem("access_token");
    },
  },
});
