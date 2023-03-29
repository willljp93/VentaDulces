<template>
  <div>
    <h4 class="text-center">Panaderia</h4>
    <ListCardProductComponents :items="products" />
  </div>
</template>

<script>
import ListCardProductComponents from "src/components/ListCardProductComponents.vue";

export default {
  name: "PanShopPage",
  components: {
    ListCardProductComponents,
  },
  data() {
    return {
      products: [
        {
          id: 1,
          title: "Pan 1",
          description: "Descripción del Pan 1",
          image: "src/assets/panes.jpg",
          price: 9.99,
          available: true,
          rating: 4,
        },
        {
          id: 2,
          title: "Pan 2",
          description: "Descripción del Pan 2",
          image: "src/assets/panes.jpg",
          price: 12.99,
          available: false,
          rating: 2,
          discount: 20,
        },
        {
          id: 3,
          title: "Pan 3",
          description: "Descripción del Pan 3",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 4,
          title: "Pan 4",
          description: "Descripción del Pan 4",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 5,
          title: "Pan 5",
          description: "Descripción del Pan 5",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 6,
          title: "Pan 6",
          description: "Descripción del Pan 6",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 7,
          title: "Pan 7",
          description: "Descripción del Pan 7",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 8,
          title: "Pan 8",
          description: "Descripción del Pan 8",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 9,
          title: "Pan 9",
          description: "Descripción del Pan 9",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 10,
          title: "Pan 10",
          description: "Descripción del Pan 10",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 11,
          title: "Pan 11",
          description: "Descripción del Pan 11",
          image: "src/assets/panes.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 12,
          title: "Pan 12",
          description: "Descripción del Pan 12",
          image: "src/assets/panes.jpg",
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
