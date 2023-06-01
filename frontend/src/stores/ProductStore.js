import { defineStore } from "pinia";
import { api } from "src/boot/axios";
import { Notify, Dialog } from "quasar";

export const useProductStore = defineStore("Product", {
  state: () => ({
    carrito: [],
    carritoCantidad: 0,

    pasteles: [],
    tempPasteles: [],
    showDialogPt: false,
    EditPt: false,
    AddPt: false,
    ViewPt: false,

    flanes: [],
    panes: [],
    reposteria: [],
    decoraciones: [],
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
    async getPasteles() {
      const { data } = await api.get("/api/catpasteles");
      this.pasteles = data;
    },
    async addPasteles(data) {
      try {
        await api.post("/api/catpasteles", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getPasteles();
        this.showDialogPt = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editPasteles(id) {
      try {
        await api.patch(`/api/catpasteles/${id}`, this.tempPasteles);
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getPasteles();
        this.showDialogPt = false;
        this.tempPasteles = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deletePasteles(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`/api/catpasteles/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getPasteles();
        });
      } catch (error) {
        Notify.create({
          message: "Error al eliminar",
          icon: "times",
          color: "negative",
        });
      }
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
