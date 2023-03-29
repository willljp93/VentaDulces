<template>
  <div class="list-product-card">
    <q-input
      v-model="searchQuery"
      outlined
      placeholder="Buscar producto..."
      class="search-bar"
      @keyup.enter="searchProducts"
    />
    <q-pagination
      v-model="currentPage"
      :min="1"
      :max="totalPages"
      :color="color"
      class="pagination"
      @input="paginate"
    />
    <q-card-group class="product-card-group">
      <product-card
        v-for="(product, index) in paginatedProducts"
        :key="index"
        :product="product"
        @update:cartItems="addToCart"
      />
    </q-card-group>
  </div>
</template>

<script>
import ProductCard from "components/ProductCard.vue";
import { ref, computed, watch } from "vue";

export default {
  components: {
    ProductCard,
  },
  setup() {
    // data
    const products = ref([
      {
        id: 1,
        title: "Producto 1",
        description: "Descripción del producto 1",
        price: 10.99,
        image: "https://picsum.photos/300/200?random=1",
      },
      {
        id: 2,
        title: "Producto 2",
        description: "Descripción del producto 2",
        price: 19.99,
        image: "https://picsum.photos/300/200?random=2",
      },
      {
        id: 3,
        title: "Producto 3",
        description: "Descripción del producto 3",
        price: 5.99,
        image: "https://picsum.photos/300/200?random=3",
      },
      {
        id: 4,
        title: "Producto 4",
        description: "Descripción del producto 4",
        price: 14.99,
        image: "https://picsum.photos/300/200?random=4",
      },
      {
        id: 5,
        title: "Producto 5",
        description: "Descripción del producto 5",
        price: 9.99,
        image: "https://picsum.photos/300/200?random=5",
      },
      {
        id: 6,
        title: "Producto 6",
        description: "Descripción del producto 6",
        price: 12.99,
        image: "https://picsum.photos/300/200?random=6",
      },
      {
        id: 7,
        title: "Producto 7",
        description: "Descripción del producto 7",
        price: 7.99,
        image: "https://picsum.photos/300/200?random=7",
      },
      {
        id: 8,
        title: "Producto 8",
        description: "Descripción del producto 8",
        price: 18.99,
        image: "https://picsum.photos/300/200?random=8",
      },
      {
        id: 9,
        title: "Producto 9",
        description: "Descripción del producto 9",
        price: 4.99,
        image: "https://picsum.photos/300/200?random=9",
      },
    ]);

    const searchQuery = ref("");
    const currentPage = ref(1);
    const itemsPerPage = 6;

    const searchedProducts = computed(() => {
      return products.value.filter((product) =>
        product.title.toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    });

    const paginatedProducts = computed(() => {
      const startIndex = (currentPage.value - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      return searchedProducts.value.slice(startIndex, endIndex);
    });

    const totalPages = computed(() =>
      Math.ceil(searchedProducts.value.length / itemsPerPage)
    );

    const paginate = (page) => {
      currentPage.value = page;
    };

    const addToCart = (product) => {
      notify({
        message: `Añadido "${product.title}" al carrito`,
        color: "positive",
      });
      // Agregar la lógica para agregar el producto al carrito aquí
    };

    const color = "primary";

    const searchProducts = () => {
      currentPage.value = 1;
    };

    // watch search query for changes and reset current page when it changes
    watch(searchQuery, () => {
      currentPage.value = 1;
    });

    return {
      searchQuery,
      currentPage,
      itemsPerPage,
      searchedProducts,
      paginatedProducts,
      totalPages,
      color,
      searchProducts,
      addToCart,
      paginate,
    };
  },
};
</script>
<style scoped>
.list-product-card {
  max-width: 800px;
  margin: 0 auto;
  padding: 2rem;
}

.search-bar {
  max-width: 400px;
  margin: 1rem 0;
}

.pagination {
  margin: 1rem 0;
  display: flex;
  justify-content: center;
}

.product-card-group {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1rem;
}

.product-card {
  width: 100%;
}

@media (max-width: 600px) {
  .list-product-card {
    padding: 1rem;
  }
}
</style>
