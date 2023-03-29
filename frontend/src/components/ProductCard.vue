<template>
  <div class="my-card">
    <q-card
      @mouseover="hoveredCard = localProduct.id"
      @mouseleave="hoveredCard = null"
      :class="{ 'shadow-2': hoveredCard === localProduct.id }"
    >
      <q-img
        class="featuredcardimg"
        :ratio="16 / 9"
        fit="cover"
        :src="localProduct.image"
        :alt="localProduct.name"
      />

      <q-badge
        class="q-badge"
        v-if="localProduct.discount"
        color="positive"
        floating
        transparent
      >
        {{ localProduct.discount }}%
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
          @click="buyItem(localProduct)"
        />
        <div class="row no-wrap items-center">
          <q-item-label
            header=""
            class="col text-h6 text-left ellipsis text-purple q-pt-none"
          >
            {{ localProduct.name }}
          </q-item-label>
          <div class="col-auto text-grey text-caption row no-wrap items-center">
            Comprar
          </div>
        </div>
        <q-rating
          self-end
          v-model="localProduct.rating"
          icon="star_border"
          icon-selected="star"
          :max="5"
          size="1.5em"
          v-if="localProduct.rating"
          readonly="true"
        />
      </q-card-section>
      <q-card-section class="q-pt-none">
        <div class="text-subtitle1 text-right text-dark">
          $ {{ localProduct.price }}
        </div>
        <div class="text-caption text-grey">
          {{ localProduct.description }}
        </div>
      </q-card-section>
      <q-separator />
      <q-card-actions vertical align="center" class="q-pa-none q-ma-xs">
        <q-btn
          stretch
          flat
          icon="shopping_cart"
          color="primary"
          label="Agregar al carrito"
          @click="addToCart(localProduct)"
        />
      </q-card-actions>
    </q-card>
  </div>
</template>

<script setup>
import { ref, defineProps } from "vue";

const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
});

const localProduct = ref(props.product);
const hoveredCard = ref(null);

const addToCart = (product) => {
  console.log(`Agregado al carrito: ${product.id}, ${product.name}`);
};

function buyItem(product) {
  console.log(`Comprado: ${product.id}, ${product.name}`);
}
</script>

<style scoped>
.my-card {
  max-width: 300px;
}
.shadow-2 {
  box-shadow: 0px 0px 10px 5px #00000033;
  transform: translateY(-5px);
}
</style>
