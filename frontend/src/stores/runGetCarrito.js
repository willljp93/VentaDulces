import { defineStore } from "pinia";

export const useGetCarritoStore = defineStore("runGC", {
  state: () => ({
    runGC: false,
  }),

  getters: {
    obtenerBandera() {
      return this.runGC;
    },
  },

  actions: {
    alternarBandera() {
      this.runGC = !this.runGC;
    },
  },
});
