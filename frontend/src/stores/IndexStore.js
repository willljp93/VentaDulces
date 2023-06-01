import { defineStore } from "pinia";
import { api } from "src/boot/axios";
import { Notify, Dialog } from "quasar";

export const useIndexStore = defineStore("IndexStore", {
  state: () => ({
    featureds: [],
    tempFeatureds: [],
    showDialogF: false,
    EditF: false,
    AddF: false,
    ViewF: false,

    promotions: [],
    tempPromotions: [],
    showDialogP: false,
    EditP: false,
    AddP: false,
    ViewP: false,

    testimonials: [],
    tempTestimonials: [],
    showDialogT: false,
    EditT: false,
    AddT: false,
    ViewT: false,
  }),

  actions: {
    // Tabla Featureds(Naranja)
    async getFeatureds() {
      try {
        const { data } = await api.get("/api/featureds");
        this.featureds = data;
      } catch (error) {
        console.log(error);
      }
    },
    async addFeatured(data) {
      try {
        await api.post("/api/featureds", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getFeatureds();
        this.showDialogF = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editFeatured(id) {
      try {
        await api.patch(`/api/featureds/${id}`, this.tempFeatureds);
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getFeatureds();
        this.showDialogF = false;
        this.tempFeatureds = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deleteFeatured(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`/api/featureds/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getFeatureds();
        });
      } catch (error) {
        Notify.create({
          message: "Error al eliminar",
          icon: "times",
          color: "negative",
        });
      }
    },

    // Tabla Promotions(Violeta)
    async getPromotions() {
      try {
        const { data } = await api.get("/api/promotions");
        this.promotions = data;
      } catch (error) {
        console.log(error);
      }
    },
    async addPromotions(data) {
      try {
        await api.post("/api/promotions", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getPromotions();
        this.showDialogP = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editPromotions(id) {
      try {
        await api.patch(`/api/promotions/${id}`, this.tempPromotions);
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getPromotions();
        this.showDialogP = false;
        this.tempPromotions = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deletePromotions(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`/api/promotions/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getPromotions();
        });
      } catch (error) {
        Notify.create({
          message: "Error al eliminar",
          icon: "times",
          color: "negative",
        });
      }
    },

    // Tabla Testimonials(Verde)
    async getTestimonials() {
      try {
        const { data } = await api.get("/api/testimonials");
        this.testimonials = data;
      } catch (error) {
        console.log(error);
      }
    },
    async addTestimonials(data) {
      try {
        await api.post("/api/testimonials", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getTestimonials();
        this.showDialogT = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editTestimonials(id) {
      try {
        await api.patch(`/api/testimonials/${id}`, this.tempTestimonials);
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getTestimonials();
        this.showDialogT = false;
        this.tempTestimonials = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deleteTestimonials(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`/api/testimonials/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getTestimonials();
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
