<template>
  <q-card
    class="my-card"
    @mouseover="hoveredCard = props.id"
    @mouseleave="hoveredCard = null"
    :class="{ 'shadow-2': hoveredCard === props.id }"
  >
    <q-img
      ratio="1"
      fit="cover"
      class="q-img"
      :src="props.item.image"
      :alt="props.items.title"
    />

    <q-badge
      class="q-badge"
      v-if="props.items.discount"
      color="info"
      floating
      transparent
    >
      {{ props.items.discount }}%
    </q-badge>

    <q-badge
      class="q-badge"
      v-else
      color="negative"
      floating
      transparent
      label="Agotado"
    />

    <q-card-section>
      <q-btn
        fab
        color="primary"
        icon="shopping_bag"
        class="absolute"
        style="top: 0; right: 12px; transform: translateY(-50%)"
      />

      <div class="row no-wrap items-center">
        <q-item-label header="" class="col text-h6 ellipsis">{{
          props.items.title
        }}</q-item-label>
        <div class="col-auto text-grey text-caption row no-wrap items-center">
          Comprar
        </div>
      </div>

      <q-rating
        v-model="stars"
        icon="star_border"
        icon-selected="star"
        :max="5"
        size="1.5em"
        v-if="props.items.rating"
        :value="props.items.rating"
        :readonly="false"
      />
    </q-card-section>

    <q-card-section class="q-pt-none">
      <div class="text-subtitle1">$ {{ props.items.price }}</div>
      <div class="text-caption text-grey">
        {{ props.items.description }}
      </div>
    </q-card-section>

    <q-separator />

    <q-card-actions vertical align="center">
      <q-btn
        flat
        icon="shopping_cart"
        color="primary"
        label="Agregar al carrito"
        @click="addToCart(props.items)"
      />
    </q-card-actions>
  </q-card>
  <div>{{ props.products }}</div>
</template>
<script setup>
import { ref, defineProps, computed } from "vue";
const props = defineProps({
  // products: {
  //   type: Array,
  //   required: true,
  // },
  products: Object,
  maxPrice: {
    type: Number,
    default: Infinity,
  },
  perPage: {
    type: Number,
    default: 6,
  },
  paginationColor: {
    type: String,
    default: "primary",
  },
  paginationSize: {
    type: String,
    default: "md",
  },
  paginationInput: {
    type: Boolean,
    default: true,
  },
});

// FUNCIONES y VARIABLES
const search = ref("");
const cart = ref({
  items: [],
  total: 0,
});
const hoveredCard = ref(null);
const currentPage = ref(1);

const filteredItems = computed(() => {
  return props.items.filter(
    (item) =>
      item.title.toLowerCase().includes(search.value.toLowerCase()) &&
      item.price <= props.maxPrice
  );
});
const totalPages = computed(() => {
  return Math.ceil(filteredItems.value.length / props.perPage);
});

const displayedItems = computed(() => {
  const startIndex = (currentPage.value - 1) * props.perPage;
  const endIndex = startIndex + props.perPage;
  return filteredItems.value.slice(startIndex, endIndex);
});

const addToCart = (product) => {
  cart.value.items.push({
    product: product,
    quantity: 1,
  });
  cart.value.total += product.price;
};

const stars = ref(5);
</script>
<style scoped>
.my-card {
  max-width: 300px;
}

.q-img {
  height: 200px;
  object-fit: cover;
}
</style>
