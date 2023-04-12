<template>
  <div class="q-pa-none q-ma-none">
    <q-table
      hide-header
      hide-bottom
      flat
      dense
      bordered
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
            @click="deletecarrito(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
  </div>
</template>

<script setup>
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { ref, onMounted } from "vue";
import { useUserStore } from "src/stores/Auth";

const userStore = useUserStore();
onMounted(async () => {
  await userStore.getUser();
});

const $q = useQuasar();
const carrito = ref([]);

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

onMounted(async () => {
  await getCarrito();
});

const getCarrito = async () => {
  const { data } = await api.get(`/api/carrito/${userStore.user.id}`);
  carrito.value = data;
};


// const addCarrito = async (newcarrito) => {
//   try {
//     await api.post("/api/carrito", newcarrito);
//     $q.notify({
//       message: "Agregado con exito",
//       icon: "check",
//       color: "positive",
//     });
//     await getCarrito();
//     showDialogF.value = false;
//   } catch (error) {
//     $q.notify({
//       message: "Error al agregar",
//       icon: "times",
//       color: "negative",
//     });
//   }
// };


const ComprarYa = async () => {
  try {
    loading.value = true;
    // Agrega aquí la lógica para realizar la compra
    await api.post('/api/comprar', carrito.value);
    await VaciarCarrito();
    $q.notify({
      message: 'Compra realizada con éxito',
      icon: 'check',
      color: 'positive',
    });
  } catch (error) {
    $q.notify({
      message: 'Error al realizar la compra',
      icon: 'times',
      color: 'negative',
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
      message: 'Estás seguro que deseas vaciar el carrito?',
      cancel: { color: 'positive' },
      ok: { color: 'negative' },
      persistent: true,
    }).onOk(async () => {
      await api.delete('/api/vaciarCarrito');
      await getCarrito();
      $q.notify({
        message: 'Carrito vaciado',
        icon: 'check',
        color: 'positive',
      });
    });
  } catch (error) {
    $q.notify({
      message: 'Error al vaciar el carrito',
      icon: 'times',
      color: 'negative',
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
      await getCarrito();
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
