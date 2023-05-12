import { defineStore } from "pinia";
import { api } from "src/boot/axios";

export const useProductStore = defineStore("Product", {
  state: () => ({
    flanes: [],
    panes: [],
    pasteles: [],
    reposteria: [],
    decoraciones: [],
    carrito: [],
    carritoCantidad: 0,
  }),

  getters: {},

  actions: {
    async getCartByID(id) {
      const { data } = await api.get(`/api/carrito/${id}`);
      this.carrito = data;
      this.carritoCantidad = data.length;
    },
    async putToCart(item) {
      const { data } = await api.post("/api/carrito", item);
      console.log("MYSDULCES", data);
    },
    // -----------------------------
    async getFlanes() {
      const { data } = await api.get("/api/catflanes");
      this.flanes = data;
    },
    async getPanes() {
      const { data } = await api.get("/api/catpanaderia");
      this.panes = data;
    },
    async getPasteles() {
      const { data } = await api.get("/api/catpasteles");
      this.pasteles = data;
    },
    async getReposteria() {
      const { data } = await api.get("/api/catreposteria");
      this.reposteria = data;
    },
    async getDecoraciones() {
      const { data } = await api.get("/api/catdecoraciones");
      this.decoraciones = data;
    },
  },
});
