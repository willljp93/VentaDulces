import { defineStore } from 'pinia';
import api from 'src/boot/axios';

export const useAuthStore = defineStore("auth",{
  state: () => ({
    authUser: null
  }),
  getters: {
    user: (state) => state.authUser
  },
  actions: {
    async getUser(){
      const data = await api.get("/api/user");
      this.authUser = data.data;
    }
  }
})
