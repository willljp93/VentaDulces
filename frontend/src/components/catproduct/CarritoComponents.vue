<template>
  <div class="col-4 q-pa-lg">
    <q-card class="my-card">
      <q-card-section>
        <q-item-label class="text-h6">Carrito de compras</q-item-label>
      </q-card-section>

      <q-list bordered>
        <q-item
          v-for="item in cart.items"
          :key="item.product.id"
          clickable
          @click="removeFromCart(item)"
        >
          <q-item-section>
            <q-item-label>{{ item.product.title }}</q-item-label>
            <q-item-label caption>{{ item.product.description }}</q-item-label>
          </q-item-section>

          <q-item-section side>
            <q-item-label>${{ item.product.price }}</q-item-label>
            <q-chip color="primary">{{ item.quantity }}</q-chip>
          </q-item-section>
        </q-item>
      </q-list>

      <q-card-section>
        <div class="row no-wrap items-center justify-between">
          <q-item-label header>Total:</q-item-label>
          <q-item-label header>${{ cart.total }}</q-item-label>
        </div>
      </q-card-section>

      <q-separator />

      <q-card-actions align="center" justify="around">
        <q-btn
          flat
          color="primary"
          label="Vaciar"
          class="col-4"
          @click="clearCart"
        />
        <q-btn
          flat
          color="primary"
          label="Comprar"
          class="col-8"
          @click="buy"
        />
      </q-card-actions>
    </q-card>
  </div>
</template>

<script>
import { ref } from "vue";

export default {
  name: "Cart",
  props: {
    cart: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const cart = ref(props.cart);

    const removeFromCart = (item) => {
      const index = cart.value.items.indexOf(item);
      if (index > -1) {
        cart.value.items.splice(index, 1);
        cart.value.total -= item.product.price * item.quantity;
      }
    };

    const clearCart = () => {
      cart.value.items = [];
      cart.value.total = 0;
    };

    const buy = () => {
      alert("Compra realizada exitosamente!");
      clearCart();
    };

    return {
      cart,
      removeFromCart,
      clearCart,
      buy,
    };
  },
};
</script>

<style scoped lang="scss">
.my-card {
  width: 100%;

  .q-item-section {
    width: 60%;
  }

  .q-item-label {
    display: block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
</style>
