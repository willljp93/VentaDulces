<template>
  <div>
    <h4 class="text-center">Repostería</h4>
    <ListCardProductComponents :items="products" />
  </div>
</template>

<script>
import ListCardProductComponents from "src/components/ListCardProductComponents.vue";

export default {
  name: "ReposteriaShopPage",
  components: {
    ListCardProductComponents,
  },
  data() {
    return {
      products: [
        {
          id: 1,
          title: "Producto 1",
          description: "Descripción del producto 1",
          image: "src/assets/reposteria.jpg",
          price: 9.99,
          available: true,
          rating: 4,
        },
        {
          id: 2,
          title: "Producto 2",
          description: "Descripción del producto 2",
          image: "src/assets/reposteria.jpg",
          price: 12.99,
          available: false,
          rating: 2,
          discount: 20,
        },
        {
          id: 3,
          title: "Producto 3",
          description: "Descripción del producto 3",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 4,
          title: "Producto 4",
          description: "Descripción del producto 4",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 5,
          title: "Producto 5",
          description: "Descripción del producto 5",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 6,
          title: "Producto 6",
          description: "Descripción del producto 6",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 7,
          title: "Producto 7",
          description: "Descripción del producto 7",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 8,
          title: "Producto 8",
          description: "Descripción del producto 8",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 9,
          title: "Producto 9",
          description: "Descripción del producto 9",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 10,
          title: "Producto 10",
          description: "Descripción del producto 10",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 11,
          title: "Producto 11",
          description: "Descripción del producto 11",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 12,
          title: "Producto 12",
          description: "Descripción del producto 12",
          image: "src/assets/reposteria.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
      ],
    };
  },
};
</script>

<style scoped lang="scss">
.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
</style>
