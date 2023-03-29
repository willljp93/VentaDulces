<template>
  <div>
    <h4 class="text-center">Flanes</h4>
    <ProductCard :products="catFlanes.value" />
  </div>
</template>

<script setup>
import ProductCard from "src/components/ProductCard.vue";
import { api } from "src/boot/axios";
import { ref, onMounted } from "vue";

onMounted(async () => {
  await getcatFlanes();
});
const catFlanes = ref([]);
const getcatFlanes = async () => {
  const { data } = await api.get("/collections/catFlanes/records");
  catFlanes.value = data;
};
</script>

<style scoped lang="scss"></style>
