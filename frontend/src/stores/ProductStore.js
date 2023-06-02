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
    tempFlanes: [],
    showDialogFl: false,
    EditFl: false,
    AddFl: false,
    ViewFl: false,

    panes: [],
    tempPanes: [],
    showDialogPn: false,
    EditPn: false,
    AddPn: false,
    ViewPn: false,

    reposteria: [],
    tempReposteria: [],
    showDialogRp: false,
    EditRp: false,
    AddRp: false,
    ViewRp: false,

    decoraciones: [],
    tempDecoraciones: [],
    showDialogDc: false,
    EditDc: false,
    AddDc: false,
    ViewDc: false,
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
    async addFlanes(data) {
      try {
        await api.post("/api/catflanes", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getFlanes();
        this.showDialogFl = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editFlanes(id) {
      try {
        await api.patch(`/api/catflanes/${id}`, this.tempFlanes);
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getFlanes();
        this.showDialogFl = false;
        this.tempFlanes = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deleteFlanes(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`/api/catflanes/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getFlanes();
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
    async getPanes() {
      const { data } = await api.get("/api/catpanaderia");
      this.panes = data;
    },
    async addPanes(data) {
      try {
        await api.post("/api/catpanaderia", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getPanes();
        this.showDialogPn = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editPanes(id) {
      try {
        await api.patch(`/api/catpanaderia/${id}`, this.tempPanes);
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getPanes();
        this.showDialogPn = false;
        this.tempPanes = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deletePanes(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`/api/catpanaderia/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getPanes();
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
    async getReposteria() {
      const { data } = await api.get("/api/catreposteria");
      this.reposteria = data;
    },
    async addReposteria(data) {
      try {
        await api.post("/api/catreposteria", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getReposteria();
        this.showDialogRp = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editReposteria(id) {
      try {
        await api.patch(`/api/catreposteria/${id}`, this.tempReposteria);
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getReposteria();
        this.showDialogRp = false;
        this.tempReposteria = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deleteReposteria(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`/api/catreposteria/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getReposteria();
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
    async getDecoraciones() {
      const { data } = await api.get("/api/catdecoraciones");
      this.decoraciones = data;
    },
    async addDecoraciones(data) {
      try {
        await api.post("/api/catdecoraciones", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getDecoraciones();
        this.showDialogDc = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editDecoraciones(id) {
      try {
        await api.patch(`/api/catdecoraciones/${id}`, this.tempDecoraciones);
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getDecoraciones();
        this.showDialogDc = false;
        this.tempDecoraciones = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deleteDecoraciones(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`/api/catdecoraciones/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getDecoraciones();
        });
      } catch (error) {
        Notify.create({
          message: "Error al eliminar",
          icon: "times",
          color: "negative",
        });
      }
    },
  },
});
