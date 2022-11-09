import { defineStore } from "pinia";
import axios from "axios";
import UserAuthService from "../services/UserAuthService";
import TokenService from "../services/TokenService";
import ToastService from "../services/ToastService";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    loggedIn: localStorage.getItem("token") ? true : false,
    user: localStorage.getItem("user"),
    //user: null,
  }),

  getters: {},

  actions: {
    async login(credentials) {
      //await axios.get("sanctum/csrf-cookie");

      //const response = (await axios.post("api/login", credentials)).data;
      const response = await UserAuthService.login(credentials);

      if (response) {
        const token = `Bearer ${response.authorization.access_token}`;

        localStorage.setItem("token", token);
        axios.defaults.headers.common["Authorization"] = token;

        await this.fetchUser();
        ToastService.showToast(response.message)
        //this.loggedIn = true;
      }
    },

    async logout() {
      //const response = (await axios.post("api/logout")).data;
      const response = await UserAuthService.logout();


      if (response) {
        ToastService.showToast(response.message)
        localStorage.removeItem("token");

        this.$reset();

        this.loggedIn = false;

      }
    },

    async fetchUser() {
      this.user = await UserAuthService.userProfile();
      //localStorage.setItem("user", this.user);
      this.loggedIn = true;
    },
  },
  persist: {
    enabled: true
  },
});