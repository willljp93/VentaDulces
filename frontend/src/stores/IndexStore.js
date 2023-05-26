import { defineStore } from "pinia";
import { api } from "src/boot/axios";

export const useIndexStore = defineStore("IndexStore", {
  state: () => ({
    featureds: [],
    promotions: [],
    testimonials: [],

  }),

  getters: {},

  actions: {
    async getFeatureds() {
      const { data } = await api.get("/api/featureds");
      this.featureds = data;
    },
    async getPromotions() {
      const { data } = await api.get("/api/promotions");
      this.promotions = data;
    },
    async getTestimonials() {
      const { data } = await api.get("/api/testimonials");
      this.testimonials = data;
    },
  },
});
