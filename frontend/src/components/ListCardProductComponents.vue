<template>
  <div class="fit row wrap justify-center items-center content-center">
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
    <div
      class="row q-gutter-md justify-evenly items-center content-center col-11"
    >
      <q-card
        class="my-card"
        v-for="item in displayedItems"
        :key="item.id"
        @mouseover="hoveredCard = item.id"
        @mouseleave="hoveredCard = null"
        :class="{ 'shadow-2': hoveredCard === item.id }"
      >
        <q-img class="q-img" :src="item.image" :alt="item.title" />

        <q-badge
          class="q-badge"
          v-if="item.discount"
          color="info"
          floating
          transparent
        >
          {{ item.discount }}%
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
            <q-item-label header="" class="col text-h6 ellipsis">
              {{ item.title }}
            </q-item-label>
            <div
              class="col-auto text-grey text-caption row no-wrap items-center"
            >
              Comprar
            </div>
          </div>

          <div align="center">
            <q-rating
              v-model="stars"
              icon="star_border"
              icon-selected="star"
              :max="5"
              size="1.5em"
              v-if="item.rating"
              :value="item.rating"
              :readonly="false"
            />
          </div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <div class="text-subtitle1 text-right">$ {{ item.price }}</div>
          <div class="text-caption text-grey text-center">
            {{ item.description }}
          </div>
        </q-card-section>

        <q-separator />

        <q-card-actions vertical align="center">
          <q-btn
            flat
            icon="shopping_cart"
            color="primary"
            label="Agregar al carrito"
            @click="addToCart(item)"
          />
        </q-card-actions>
      </q-card>
    </div>
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
  </div>
</template>

<script>
import { ref, computed } from "vue";
export default {
  name: "ListCardProductComponents",
  props: {
    items: {
      type: Array,
      required: true,
    },
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
  },
  setup(props) {
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
    return {
      search,
      cart,
      stars: ref(5),
      hoveredCard,
      currentPage,
      filteredItems,
      totalPages,
      displayedItems,
      addToCart,
    };
  },
};
</script>

<style scoped lang="scss">
.my-card {
  width: 100%;
  max-width: 300px;
  transition: box-shadow 0.2s ease-in-out;
}
.q-img {
  height: 150px;
  object-fit: cover;
}
.shadow-2 {
  box-shadow: 0px 0px 10px 2px #00000033;
  transform: translateY(-5px);
}
.q-badge {
  margin-right: 8px;
}
</style>
