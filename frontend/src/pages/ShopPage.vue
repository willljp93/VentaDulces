<template>
  <div class="product-container">
    <h4 class="text-center">Productos</h4>

    <div class="product-list">
      <ProductCardList :items="products" />
    </div>
  </div>
</template>

<script setup>
import ProductCardList from "components/ProductCardList.vue";

const products = [
  {
    id: 1,
    title: "Producto 1",
    description: "Descripción del producto 1",
    image: "https://via.placeholder.com/150",
    price: 9.99,
    available: true,
    rating: 4,
  },
  {
    id: 2,
    title: "Producto 2",
    description: "Descripción del producto 2",
    image: "https://via.placeholder.com/150",
    price: 12.99,
    available: false,
    discount: 20,
  },
  {
    id: 3,
    title: "Producto 3",
    description: "Descripción del producto 3",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 4,
    title: "Producto 4",
    description: "Descripción del producto 4",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 5,
    title: "Producto 5",
    description: "Descripción del producto 5",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 6,
    title: "Producto 6",
    description: "Descripción del producto 6",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 7,
    title: "Producto 7",
    description: "Descripción del producto 7",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 8,
    title: "Producto 8",
    description: "Descripción del producto 8",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 9,
    title: "Producto 9",
    description: "Descripción del producto 9",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 10,
    title: "Producto 10",
    description: "Descripción del producto 10",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 11,
    title: "Producto 11",
    description: "Descripción del producto 11",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
  {
    id: 12,
    title: "Producto 12",
    description: "Descripción del producto 12",
    image: "https://via.placeholder.com/150",
    price: 24.99,
    available: true,
    rating: 5,
  },
];
</script>

<style scoped lang="scss">
.product-container {
  padding: 20px;
}
.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
</style>
