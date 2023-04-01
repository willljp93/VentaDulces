<template>
  <div class="fit row wrap justify-center items-center content-center">
    <BarraBusquedaComponentsVue v-model="search" />

    <CardProductComponentsVue
       v-for="item in displayedItems"
      :key="item.id"
      :items="products"
      :max-price="maxPrice"
      :per-page="perPage"
      @add-to-cart="addToCart"
    />
    <PaginationProductComponentsVue
      :current-page="currentPage"
      :total-pages="totalPages"
      @update:current-page="currentPage = $event"
    />
  </div>
</template>

<script>
const {
  default: BarraBusquedaComponentsVue,
} = require("src/components/catproduct/BarraBusquedaComponents.vue");
const {
  default: CardProductComponentsVue,
} = require("src/components/catproduct/CardProductComponents.vue");
const {
  default: PaginationProductComponentsVue,
} = require("src/components/catproduct/PaginationProductComponents.vue");

const products = ref([
  {
    id: 1,
    title: "Producto 1",
    image: "https://via.placeholder.com/150",
    description: "Descripción del producto 1",
    price: 20.0,
    rating: 4.5,
    discount: 10,
  },
  {
    id: 2,
    title: "Producto 2",
    image: "https://via.placeholder.com/150",
    description: "Descripción del producto 2",
    price: 30.0,
    rating: 3.5,
    discount: null,
  },
  {
    id: 3,
    title: "Producto 3",
    image: "https://via.placeholder.com/150",
    description: "Descripción del producto 3",
    price: 25.0,
    rating: 3.0,
    discount: null,
  },
  {
    id: 4,
    title: "Producto 4",
    image: "https://via.placeholder.com/150",
    description: "Descripción del producto 4",
    price: 15.0,
    rating: 4.0,
    discount: 5,
  },
  {
    id: 5,
    title: "Producto 5",
    image: "https://via.placeholder.com/150",
    description: "Descripción del producto 5",
    price: 40.0,
    rating: null,
    discount: null,
  },
]);

const maxPrice = ref(30);
const perPage = ref(3);
const currentPage = ref(1);

const addToCart = (cart) => {
  console.log(cart);
};
</script>

<style scoped lang="scss"></style>
