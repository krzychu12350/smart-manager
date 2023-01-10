import { defineStore } from "pinia";
import axios from "axios";
import UserAuthService from "../services/UserAuthService";
import TokenService from "../services/TokenService";
import ToastService from "../services/ToastService";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    loggedIn: localStorage.getItem("token") ? true : false,
    //user: localStorage.getItem("user"),
    userData: {},
    /*
    accessToken: null,
    userId: null,
    userComapnyId: null,
    isOwner: false,
    */
  }),

  getters: {
    /*
    async getUserRole () {
      return this.isOwner;
    },
    async getUserId () {
      return this.userId;
    },
    async getUserCompanyId () {
      return this.userCompanyId;
    },
    async getAccessToken () {
      return this.accessToken;
    },
   
    getUserData: () => {
      return this.userData;
    },
     */
  },

  actions: {
    async setUserData(userData) {
      this.userData = userData;
    },
    /*
    async setUserRole(isOwner) {
      this.isOwner = isOwner;
    },
    async setUserId(userId) {
      this.userId = userId;
    },
    async setUserCompanyId(companyId) {
      this.userComapnyId = companyId;
    },
    async setAccessToken(accessToken) {
      this.accessToken = accessToken;
    },
    */
    async login(credentials) {
      //await axios.get("sanctum/csrf-cookie");

      //const response = (await axios.post("api/login", credentials)).data;
      const response = await UserAuthService.login(credentials);

      if (response) {
        const token = `Bearer ${response.authorization.access_token}`;
      

        localStorage.setItem("token", token);

        //await this.setAccessToken(token);
        axios.defaults.headers.common["Authorization"] = token;

        const userData = await this.fetchUser();

        const userDataForStoring = {
          user_id: userData.id,
          user_name: userData.name,
          user_surname: userData.surname,
          user_company_id: userData.companies[0].id,
          is_owner: userData.is_owner,
        };

        //console.log(userData.companies[0].id);

        //await this.setUserCompanyId(userData.companies[0].id);
        //await this.setUserId(userData.id);
        //await this.setUserRole(userData.is_owner);
        await this.setUserData(userDataForStoring);

        ToastService.showToast(response.message)
        //this.loggedIn = true;
        this.loggedIn = true;
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
      const response = await UserAuthService.userProfile();
      //this.user = response;
      //localStorage.setItem("user", this.user);
      //this.setUserCompanyId(response.user.company[0]);
      //this.isOwner = response.is_owner;

  
      return response;
    },
  },
  persist: {
    enabled: true
  },
});