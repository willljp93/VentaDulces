<template>
  <div class="q-pa-none q-ma-none">
    <q-table
      hide-header
      hide-bottom
      flat
      bordered
      dense
      title="Carrito de Compras"
      :rows="carrito"
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
            :disable="loading || carrito.length === 0"
            label="Vaciar"
            @click="VaciarCarrito"
          />
          <q-btn
            class=""
            color="positive"
            :disable="loading || carrito.length === 0"
            label="Comprar"
            @click="ComprarYa"
          />
          <q-btn dense icon="update" color="info" @click="actualizarCarrito" />
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
import { useGetCarritoStore } from "src/stores/runGetCarrito";

const { getUser } = useUserStore();
const { getDulces, getCarritosByID } = useGetCarritoStore();
const { dulces, carrito } = storeToRefs(useGetCarritoStore());
const { user } = storeToRefs(useUserStore())
onMounted(async () => {
  await getUser();
  // await getCarrito();
  await getDulces();
  await getCarritosByID(user.value.id)

});

const $q = useQuasar();
// const carrito = ref([]);

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

// const getCarrito = async () => {
//   const { data } = await api.get(`/api/carrito/${ user?.id}`);
//   carrito.value = data;
// };
const actualizarCarrito = async()=>{
  await getCarritosByID(user.value.id)

}

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
      await getCarritosByID(user.value.id)
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
      await getCarritosByID(user.value.id)
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
