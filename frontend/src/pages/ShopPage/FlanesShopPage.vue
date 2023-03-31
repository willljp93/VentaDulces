<template>
  <div class="q-pa-md">
    <BarraBusquedaComponents :search="search" />

    <CardProductComponents :items="items" :max-price="maxPrice" :per-page="perPage" />

    <PaginationProductComponents
      :current-page="currentPage"
      :total-pages="totalPages"
      color="primary"
      size="md"
      input
      input-style="{ width: '60px' }"
      @update:model-value="currentPage = $event"
    />

    <CarritoComponents :cart="cart" />
  </div>
</template>

<script>
import BarraBusquedaComponents from "src/components/catproduct/BarraBusquedaComponents.vue";
import CardProductComponents from "src/components/catproduct/CardProductComponents.vue";
import PaginationProductComponents from "src/components/catproduct/PaginationProductComponents.vue";
import CarritoComponents from "src/components/catproduct/CarritoComponents.vue";
import { ref } from "vue";

export default {
  name: "App",
  components: {
    SearchBar,
    CardList,
    Pagination,
    Cart,
  },
  setup() {
    const search = ref("");
    const maxPrice = ref(1000);
    const perPage = ref(6);
    const currentPage = ref(1);
    const items = ref([
      {
        id: 1,
        title: "Producto 1",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 200,
        image:
          "https://cdn.pixabay.com/photo/2017/11/07/00/07/fashion-2920322_960_720.jpg",
        rating: 4,
        discount: 10,
      },
      {
        id: 2,
        title: "Producto 2",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 300,
        image:
          "https://cdn.pixabay.com/photo/2015/09/02/13/17/apple-919048_960_720.jpg",
        rating: 5,
      },
      {
        id: 3,
        title: "Producto 3",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 400,
        image:
          "https://cdn.pixabay.com/photo/2017/05/09/13/33/laptop-2298286_960_720.jpg",
      },
      {
        id: 4,
        title: "Producto 4",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 500,
        image:
          "https://cdn.pixabay.com/photo/2016/11/22/19/17/adult-1850264_960_720.jpg",
        rating: 3,
        discount: 20,
      },
      {
        id: 5,
        title: "Producto 5",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 600,
        image:
          "https://cdn.pixabay.com/photo/2015/11/19/21/11/kitchen-1054910_960_720.jpg",
        rating: 4,
      },
      {
        id: 6,
        title: "Producto 6",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 700,
        image:
          "https://cdn.pixabay.com/photo/2015/05/28/23/12/auto-788747_960_720.jpg",
        rating: 5,
      },
      {
        id: 7,
        title: "Producto 7",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 800,
        image:
          "https://cdn.pixabay.com/photo/2016/08/11/23/48/italy-1587287_960_720.jpg",
      },
      {
        id: 8,
        title: "Producto 8",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 900,
        image:
          "https://cdn.pixabay.com/photo/2016/09/04/22/08/office-1645796_960_720.jpg",
        rating: 4,
      },
      {
        id: 9,
        title: "Producto 9",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nunc nec lacus pharetra faucibus. Sed vel laoreet nisi.",
        price: 1000,
        image:
          "https://cdn.pixabay.com/photo/2016/11/21/15/17/attractive-1845814_960_720.jpg",
        rating: 5,
        discount: 15,
      },
    ]);
    const cart = ref({ items: [], total: 0 });

    return {
      search,
      maxPrice,
      perPage,
      currentPage,
      items,
      cart,
    };
  },
};
</script>

<style scoped lang="scss">
</style>
