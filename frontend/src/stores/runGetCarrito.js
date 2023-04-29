import { defineStore } from "pinia";
import { api } from "src/boot/axios";

export const useGetCarritoStore = defineStore("runGC", {
  state: () => ({
    runGC: false,
    dulces:[],
    carrito: [],
    cantidadDulces:0
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
    async getDulces(){
      const { data } = await api.get('/api/carrito');
      console.log("DULCESSSSS =>",data);
      this.dulces = data;
    },
    async getCarritosByID(id){
      const { data } = await api.get(`/api/carrito/${ id}`);
      this.carrito = data;
      console.log("lebg", data.length);
      this.cantidadDulces = data.length;
    },
    async addDulces(item){
      const { data } = await api.post("/api/carrito",item)
      console.log("MYSDULCES", data);
    }
  },

});
