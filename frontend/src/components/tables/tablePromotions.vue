<template>
  <!-- Promociones -->
  <div class="q-pa-md">
    <q-table
      class="my-sticky-header-table"
      :rows="promotions"
      :columns="columnspromotions"
      :filter="filter"
      row-key="id"
      no-data-label="No encontre nada para ti"
      no-results-label="El filtro no descubrió ningún resultado."
      flat
      dense
      bordered
      separator="cell"
    >
      <template v-slot:top="props">
        <div class="col-2 q-table__title text-white">Promociones</div>
        <q-space />
        <q-input
          rounded
          standout="bg-teal-3 text-white"
          dark
          dense
          input-class="text-right"
          debounce="300"
          color="teal-3"
          v-model="filter"
        >
          <template v-slot:append>
            <q-icon v-if="filter === ''" name="search" />
            <q-icon
              v-else
              name="clear"
              class="cursor-pointer"
              @click="filter = ''"
            />
          </template>
        </q-input>
        <q-btn
          flat
          unelevated
          fab-mini
          color="white"
          icon="add"
          type="submit"
          label="Agregar"
          @click="openAddDialog(props.row)"
          class="q-ml-md"
        />
        <q-btn
          flat
          round
          dense
          :icon="props.inFullscreen ? 'fullscreen_exit' : 'fullscreen'"
          @click="props.toggleFullscreen"
          class="q-ml-md"
        />
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
            color="accent"
            icon="visibility"
            @click="openViewDialog(props.row)"
          />
          <q-btn
            flat
            round
            dense
            color="primary"
            icon="edit"
            @click="openEditDialog(props.row)"
          />
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
    <q-dialog v-model="showDialogP" persistent>
      <q-card class="cartel row justify-center">
        <q-card-section>
          <q-form>
            <q-input v-model="tempPromotion.name" label="Nombre" />
            <q-input v-model="tempPromotion.description" label="Descripción" />
            <q-input
              v-model="tempPromotion.price"
              label="Precio"
              type="number"
            />
            <q-select
              v-model="tempPromotion.rating"
              label="Valoración"
              :options="[1, 2, 3, 4, 5]"
            />
            <q-checkbox v-model="tempPromotion.discount" label="Descuento" />
            <q-input
              v-if="tempPromotion.discount"
              v-model="tempPromotion.discountValue"
              type="number"
              label="Valor del descuento"
            />
            <q-input bottom-slots v-model="tempPromotion.image" label="Imagen">
              <template v-slot:before>
                <q-avatar>
                  <q-img
                    v-if="tempPromotion.image"
                    :src="tempPromotion.image"
                  />
                </q-avatar>
              </template>
            </q-input>
            <div class="q-mt-md q-gutter-xs">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="showEditDialog == true"
                @click="editFeatured(tempPromotion.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="showAddDialog == true"
                @click="addFeatured(tempPromotion)"
              />
              <q-btn label="Cancelar" @click="showDialogP = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <q-dialog v-model="showcardDialogP">
      <q-card class="promocion q-pa-sm" flat bordered>
        <q-item class="q-pa-md">
          <q-item-section
            side
            class="text-orange text-weight-bolder text-subtitle1"
          >
            {{ tempPromotion.title }}
          </q-item-section>
          <q-item-section>
            <q-badge color="red" floating transparent>
              <q-item-label class="discount text-weight-bold">
                {{ tempPromotion.discount }}% de descuento
              </q-item-label>
            </q-badge>
            <q-item-label caption>
              <q-chip
                dense
                outline
                size="15px"
                class="glossy"
                color="orange"
                text-color="dark"
                icon="event"
              >
                <q-item-label caption class="text-dark">
                  Válido hasta {{ tempPromotion.expires }}
                </q-item-label>
              </q-chip>
            </q-item-label>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-card-section horizontal>
          <q-card-section class="text-subtitle1 text-dark">
            {{ tempPromotion.description }}
          </q-card-section>
          <q-separator vertical />
          <q-card-section class="col-8 self-center no-padding">
            <q-img
              :ratio="4 / 3"
              fit="cover"
              :src="tempPromotion.image"
              :alt="tempPromotion.title"
            />
          </q-card-section>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script setup>
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { ref, onMounted } from "vue";

const $q = useQuasar();
const promotions = ref([]);
const filter = ref("");
const showDialogP = ref(false);
const showcardDialogP = ref(false);
const showEditDialog = ref(false);
const showAddDialog = ref(false);
const tempPromotion = ref({});

const columnspromotions = [
  {
    name: "id",
    required: true,
    label: "Id",
    align: "left",
    field: (row) => row.id,
    sortable: true,
  },
  {
    name: "title",
    required: true,
    label: "Título",
    align: "left",
    field: (row) => row.title,
    sortable: true,
  },
  {
    name: "description",
    align: "left",
    label: "Descripción",
    field: "description",
    sortable: false,
  },
  {
    name: "discount",
    label: "Descuento",
    field: "discount",
    sortable: true,
    align: "center",
  },
  { name: "image", label: "Imagen", field: "image", align: "center" },
  { name: "actions", label: "Acciones", align: "center" },
];

onMounted(async () => {
  await getFeatureds();
});

const openViewDialog = (row) => {
  tempPromotion.value = { ...row };
  showcardDialogP.value = true;
};
const openEditDialog = (row) => {
  tempPromotion.value = { ...row };
  showAddDialog.value = false;
  showEditDialog.value = true;
  showDialogP.value = true;
};
const openAddDialog = () => {
  tempPromotion.value = {};
  showAddDialog.value = true;
  showEditDialog.value = false;
  showDialogP.value = true;
};

const getFeatureds = async () => {
  const { data } = await api.get("promotions");
  promotions.value = data;
};

const addFeatured = async (newFeatured) => {
  try {
    await api.post("promotions", newFeatured);
    $q.notify({
      message: "Agregado con exito",
      icon: "check",
      color: "positive",
    });
    await getFeatureds();
    showDialogP.value = false;
  } catch (error) {
    $q.notify({
      message: "Error al agregar",
      icon: "times",
      color: "negative",
    });
  }
};

const editFeatured = async (id) => {
  if (!id) {
    $q.notify({
      message: "Error al editar",
      icon: "times",
      color: "negative",
    });
    return;
  }
  try {
    await api.patch(`promotions/${id}`, tempPromotion.value);
    $q.notify({
      message: "Editado con éxito",
      icon: "check",
      color: "positive",
    });
    await getFeatureds();
    showDialogP.value = false;
    tempPromotion.value = {};
  } catch (error) {
    $q.notify({
      message: "Error al editar",
      icon: "times",
      color: "negative",
    });
  }
};

const deleteFeatured = async (id) => {
  try {
    $q.dialog({
      html: true,
      title: '<span class="text-red">Eliminar</span>',
      message: "Estas seguro que deseas eliminar la fila",
      cancel: { color: "positive" },
      ok: { color: "negative" },
      persistent: true,
    }).onOk(async () => {
      await api.delete(`promotions/${id}`);
      $q.notify({
        message: "Eliminado con exito",
        icon: "check",
        color: "positive",
      });
      await getFeatureds();
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
<style lang="sass">
.my-sticky-header-table
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th
    background-color: #26a69a

  thead tr th
    position: sticky
    z-index: 1
  thead tr:first-child th
    top: 0

  &.q-table--loading thead tr:last-child th
    top: 48px

  tbody
    scroll-margin-top: 48px

.dialog-custom-class
  .dialog-details
    img.dialog-image
      max-width: 300px
      max-height: 300px

.cartel
  width: 100%
  max-width: 150px
  transition: box-shadow 0.2s ease-in-out
  box-shadow: 0px 0px 10px 5px #00000033

.promocion
  width: 100%
  max-width: 450px
  box-shadow: 0px 0px 10px 5px #00000033
  transition: box-shadow 0.5s ease-in-out
</style>
