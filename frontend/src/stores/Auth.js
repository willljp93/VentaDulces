import { defineStore } from "pinia";
import axios from "axios";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: null,
  }),

  actions: {
    async getUser() {
      const res = await axios.get("http://localhost:8000/api/user");
      this.user = res.data;
    },
    async signUp(email, password) {
      const res = await axios.post("http://localhost:8000/register", {
        email,
        password,
      });
      this.user = res.data;
    },
    async signIn(email, password) {
      const res = await axios.post("http://localhost:8000/login", {
        email,
        password,
      });
      this.user = res.data;
    },
  },
});
