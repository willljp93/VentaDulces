<template>
  <div>
    <h4 class="text-center">Pasteles</h4>
    <ListCardProductComponents :items="products" />
  </div>
</template>

<script>
import ListCardProductComponents from "src/components/ListCardProductComponents.vue";

export default {
  name: "PastelesShopPage",
  components: {
    ListCardProductComponents,
  },
  data() {
    return {
      products: [
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
