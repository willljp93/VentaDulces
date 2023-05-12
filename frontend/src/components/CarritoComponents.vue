<template>
  <div class="q-pa-none q-ma-none">
    <!-- hide-bottom -->
    <q-table
      hide-header
      flat
      bordered
      dense
      wrap-cells
      table-colspan
      rows-per-page-options="0"
      title="Carrito de Compras"
      :rows="carrito"
      :columns="columns"
      row-key="id"
      class="my-sticky-header-table"
      no-data-label="No encontre nada para ti"
    >
      <template v-slot:top>
        <div class="justify-center row">
          <p class="q-pa-xs col-12 text-center carrito-titulo">
            Carrito de Compras
          </p>
          <div class="q-gutter-xs">
            <q-btn
              dense
              color="negative"
              :disable="loading || carrito.length === 0"
              label="Vaciar"
              @click="VaciarCarrito"
            />
            <q-btn
              dense
              color="positive"
              :disable="loading || carrito.length === 0"
              label="Comprar"
              @click="ComprarYa"
            />
            <q-btn
              dense
              icon="update"
              color="info"
              @click="actualizarCarrito"
            />
          </div>
        </div>
      </template>

      <template v-slot:body-cell-image="props">
        <q-td :props="props">
          <q-avatar>
            <img fit="cover" :ratio="1" :src="props.row.image" />
          </q-avatar>
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
            @click="deletecarrito(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
  </div>
</template>

<script setup>
import { api } from "src/boot/axios";
import { ref, onMounted } from "vue";
import { useQuasar } from "quasar";
import { storeToRefs } from "pinia";
import { useUserStore } from "src/stores/Auth";
import { useProductStore } from "src/stores/ProductStore";

const { getUser } = useUserStore();
const { getCartByID } = useProductStore();
const { carrito } = storeToRefs(useProductStore());
const { user } = storeToRefs(useUserStore());
onMounted(async () => {
  await getUser();
  await getCartByID(user.value.id);
});

const $q = useQuasar();
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

const actualizarCarrito = async () => {
  await getCartByID(user.value.id);
};

const ComprarYa = async () => {
  try {
    loading.value = true;
    // Agrega aquí la lógica para realizar la compra
    await api.post("/api/comprar", carrito.value);
    await VaciarCarrito();
    $q.notify({
      message: "Compra realizada con éxito",
      icon: "check",
      color: "positive",
    });
  } catch (error) {
    $q.notify({
      message: "Error al realizar la compra",
      icon: "times",
      color: "negative",
    });
  } finally {
    loading.value = false;
  }
};

const VaciarCarrito = async () => {
  try {
    $q.dialog({
      html: true,
      title: '<span class="text-red">Vaciar carrito</span>',
      message: "Estás seguro que deseas vaciar el carrito?",
      cancel: { color: "positive" },
      ok: { color: "negative" },
      persistent: true,
    }).onOk(async () => {
      await api.delete(`/api/ccarrito/${user.value?.id}`);
      await getCartByID(user.value.id);
      $q.notify({
        message: "Carrito vaciado",
        icon: "check",
        color: "positive",
      });
    });
  } catch (error) {
    $q.notify({
      message: "Error al vaciar el carrito",
      icon: "times",
      color: "negative",
    });
  }
};

const deletecarrito = async (id) => {
  try {
    $q.dialog({
      html: true,
      title: '<span class="text-red">Eliminar</span>',
      message: "Estas seguro que deseas eliminar el producto",
      cancel: { color: "positive" },
      ok: { color: "negative" },
      persistent: true,
    }).onOk(async () => {
      await api.delete(`/api/carrito/${id}`);
      $q.notify({
        message: "Eliminado con exito",
        icon: "check",
        color: "positive",
      });
      await getCartByID(user.value.id);
    });
  } catch (error) {
    $q.notify({
      message: "Error al eliminar",
      icon: "times",
      color: "negative",
    });
  }
};
</script>
<style lang="scss">
.carrito-titulo {
  font-size: 20px;
  color: #333;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(255, 255, 255, 1);
}

.my-sticky-header-table {
  /* height or max-height is important */
  height: 560px;

  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    /* bg color is important for th; just specify one */
    background-color: #26a69a;
  }

  thead tr th {
    position: sticky;
    z-index: 1;
  }

  thead tr:first-child th {
    top: 0;
  }

  /* this is when the loading indicator appears */
  &.q-table--loading thead tr:last-child th {
    /* height of all previous header rows */
    top: 48px;
  }

  /* prevent scrolling behind sticky top row on focus */
  tbody {
    /* height of all previous header rows */
    scroll-margin-top: 48px;
  }
}
</style>
