import { defineStore } from "pinia";
import axios from "axios";
import { useQuasar } from "quasar";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: null,
    cookies: {},
    token: null,
  }),

  actions: {
    async getCookie() {
      return this.$cookies.get("laravel_session");
    },

    async getAllCookies() {
      const $q = useQuasar();
      this.cookies = $q.cookies.getAll();
    },

    async getUser() {
      try {
        // this.token = await this.getCookie();
        const { data } = await axios.get("http://localhost:8000/api/user");
        this.user = data;
        console.log("Usuario: ", data);
      } catch (error) {}
    },
  },
});
