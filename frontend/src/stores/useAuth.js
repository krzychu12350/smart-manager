import { defineStore } from "pinia";
import axios from "axios";
import UserAuthService from "../services/UserAuthService";
import TokenService from "../services/TokenService";
import ToastService from "../services/ToastService";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    loggedIn: localStorage.getItem("token") ? true : false,
    userData: {},
  }),
  getters: {

  },
  actions: {
    async setUserData(userData) {
      this.userData = userData;
    },
    
    async login(credentials) {
      const response = await UserAuthService.login(credentials);
      if (response) {
        const token = `Bearer ${response.authorization.access_token}`;
        localStorage.setItem("token", token);
        axios.defaults.headers.common["Authorization"] = token;
        const userData = await this.fetchUser();
        const company = (userData.companies[0] === undefined) ? 0 : userData.companies[0];
        const userDataForStoring = {
          user_id: userData.id,
          user_name: userData.name,
          user_surname: userData.surname,
          user_company_id: company.id,
          is_owner: userData.is_owner,
        };  
        await this.setUserData(userDataForStoring);
        ToastService.showToast(response.message)
        this.loggedIn = true;
      }
    },

    async logout() {
      const response = await UserAuthService.logout();
      if (response) {
        TokenService.removeUserAccessToken();
        ToastService.showToast(response.message)
        this.$reset();
        this.loggedIn = false;
      }
    },

    async fetchUser() {
      return await UserAuthService.userProfile();
    },
  },
  persist: {
    enabled: true
  },
});