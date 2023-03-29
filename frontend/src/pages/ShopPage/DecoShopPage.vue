<template>
  <div>
    <h4 class="text-center">Decoraciones</h4>
    <ListCardProductComponents :items="products" />
  </div>
</template>

<script>
import ListCardProductComponents from "src/components/ListCardProductComponents.vue";

export default {
  name: "DecoShopPage",
  components: {
    ListCardProductComponents,
  },
  data() {
    return {
      products: [
        {
          id: 1,
          title: "Decoracion 1",
          description: "Descripción del Decoracion 1",
          image: "src/assets/decoraciones.jpg",
          price: 9.99,
          available: true,
          rating: 4,
        },
        {
          id: 2,
          title: "Decoracion 2",
          description: "Descripción del Decoracion 2",
          image: "src/assets/decoraciones.jpg",
          price: 12.99,
          available: false,
          rating: 2,
          discount: 20,
        },
        {
          id: 3,
          title: "Decoracion 3",
          description: "Descripción del Decoracion 3",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 4,
          title: "Decoracion 4",
          description: "Descripción del Decoracion 4",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 5,
          title: "Decoracion 5",
          description: "Descripción del Decoracion 5",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 6,
          title: "Decoracion 6",
          description: "Descripción del Decoracion 6",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 7,
          title: "Decoracion 7",
          description: "Descripción del Decoracion 7",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 8,
          title: "Decoracion 8",
          description: "Descripción del Decoracion 8",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 9,
          title: "Decoracion 9",
          description: "Descripción del Decoracion 9",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 10,
          title: "Decoracion 10",
          description: "Descripción del Decoracion 10",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 11,
          title: "Decoracion 11",
          description: "Descripción del Decoracion 11",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
        {
          id: 12,
          title: "Decoracion 12",
          description: "Descripción del Decoracion 12",
          image: "src/assets/decoraciones.jpg",
          price: 24.99,
          available: true,
          rating: 5,
        },
      ],
    };
  },
};
</script>

<style scoped lang="scss"></style>
