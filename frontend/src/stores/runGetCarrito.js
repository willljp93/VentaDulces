import { defineStore } from "pinia";
import { api } from "src/boot/axios";

export const useGetCarritoStore = defineStore("runGC", {
  state: () => ({
    dulces: [],
    carrito: [],
    cantidadDulces: 0,
  }),

  getters: {},

  actions: {
    async getCarritosByID(id) {
      const { data } = await api.get(`/api/carrito/${id}`);
      this.carrito = data;
      console.log("lebg", data.length);
      this.cantidadDulces = data.length;
    },
    async addDulces(item) {
      const { data } = await api.post("/api/carrito", item);
      console.log("MYSDULCES", data);
    },
  },
});
