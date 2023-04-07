import { defineStore } from "pinia";
import api from "src/boot/axios";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    authUser: null,
  }),
  getters: {
    user: (state) => state.authUser,
  },
  actions: {
    async getToken() {
      await api.get("/sanctum/csrf-cookie");
    },
    async getUser() {
      this.getToken();
      const { data } = await api.get("/api/user");
      this.authUser = data;
    },
  },
});
