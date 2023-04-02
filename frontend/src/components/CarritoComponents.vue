<template>
  <div class="q-pa-none q-ma-none">
    <q-table
      hide-header
      hide-bottom
      flat
      dense
      bordered
      title="Carrito de Compras"
      :rows="rows"
      :columns="columns"
      row-key="id"
      no-data-label="No encontre nada para ti"
    >
      <template v-slot:top>
        <p class="q-pa-xs col-12">Carrito de Compras</p>
        <div class="q-gutter-xs flex-center">
          <q-btn
            class=""
            color="negative"
            :disable="loading"
            label="Vaciar"
            @click="cleanCart"
          />
          <q-btn
            class=""
            color="positive"
            :disable="loading"
            label="Comprar"
            @click="buyCart"
          />
        </div>
      </template>

      <template v-slot:body-cell-image="props">
        <q-td :props="props">
          <q-img :src="props.row.image" />
        </q-td>
      </template>
      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <q-btn
            flat
            round
            dense
            color="negative"
            icon="delete"
            @click="deleteFeatured(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
  </div>
</template>

<script>
import { ref } from "vue";
const loading = ref(false);

const columns = [
  { name: "image", align: "center", label: "image", field: "image" },
  {
    name: "title",
    align: "center",
    label: "title",
    field: "title",
    sortable: true,
  },
  { name: "price", label: "price", field: "price", sortable: true },
  { name: "actions", label: "actions", field: "actions" },
];

const rows = [
  {
    id: 1,
    image: "https://via.placeholder.com/150",
    title: "hola1",
    price: 1,
    description: "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq",
  },
  {
    id: 2,
    image: "https://via.placeholder.com/150",
    title: "hola2",
    price: 2,
    description: "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq",
  },
  {
    id: 3,
    image: "https://via.placeholder.com/150",
    title: "hola3",
    price: 3,
    description: "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq",
  },
  {
    id: 4,
    image: "https://via.placeholder.com/150",
    title: "hola4",
    price: 4,
    description: "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq",
  },
  {
    id: 5,
    image: "https://via.placeholder.com/150",
    title: "hola5",
    price: 5,
    description: "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq",
  },
  {
    id: 6,
    image: "https://via.placeholder.com/150",
    title: "hola6",
    price: 6,
    description: "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq",
  },
  {
    id: 7,
    image: "Frozen Yogurt",
    title: "hola",
    price: 7,
    description: "qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq",
  },
];

export default {
  setup() {
    return {
      columns,
      rows,
    };
  },
};
</script>
