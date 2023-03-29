<template>
  <!-- nombre -->
  <div>
    <h4 class="text-center">Pasteles</h4>
  </div>

  <!-- barra de busqueda -->
  <div class="col-8 q-pa-lg flex-center">
    <q-input
      dense
      standout="bg-primary text-white"
      rounded
      type="search"
      placeholder="Buscar"
      v-model="search"
      input-class="text-right"
      class="q-ml-xs"
    >
      <template v-slot:append>
        <q-icon v-if="search === ''" name="search" />
        <q-icon
          v-else
          name="clear"
          class="cursor-pointer"
          @click="search = ''"
        />
      </template>
    </q-input>
  </div>

  <!-- lista de cards -->
  <ProductCard :props="products" />
  <!-- paginacion -->
  <div class="col-4 q-pa-lg flex flex-center">
    <q-pagination
      v-model="currentPage"
      :min="1"
      :max="totalPages"
      :color="paginationColor"
      :size="paginationSize"
      :input="paginationInput"
      input-class="secondary"
    >
    </q-pagination>
  </div>
</template>

<script setup>
import ProductCard from "src/components/ProductCard.vue";

// export default {
//   name: "PastelesShopPage",
//   components: {
//     ProductCard,
//   },
//   data() {
//     return {
const products = [
  {
    id: 1,
    title: "Pastel 1",
    description: "Descripción del Pastel 1",
    image: "/src/assets/pasteles.jpeg",
    price: 9.99,
    available: true,
    rating: 4,
  },
  {
    id: 2,
    title: "Pastel 2",
    description: "Descripción del Pastel 2",
    image: "/src/assets/pasteles.jpeg",
    price: 12.99,
    available: false,
    rating: 2,
    discount: 20,
  },
  {
    id: 3,
    title: "Pastel 3",
    description: "Descripción del Pastel 3",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 4,
    title: "Pastel 4",
    description: "Descripción del Pastel 4",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 5,
    title: "Pastel 5",
    description: "Descripción del Pastel 5",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 6,
    title: "Pastel 6",
    description: "Descripción del Pastel 6",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 7,
    title: "Pastel 7",
    description: "Descripción del Pastel 7",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 8,
    title: "Pastel 8",
    description: "Descripción del Pastel 8",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 9,
    title: "Pastel 9",
    description: "Descripción del Pastel 9",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 10,
    title: "Pastel 10",
    description: "Descripción del Pastel 10",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 11,
    title: "Pastel 11",
    description: "Descripción del Pastel 11",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 12,
    title: "Pastel 12",
    description: "Descripción del Pastel 12",
    image: "/src/assets/pasteles.jpeg",
    price: 24.99,
    available: true,
    rating: 5,
  },
];
// };
// },
// };
</script>

<style scoped lang="scss">
.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
</style>
