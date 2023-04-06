<template>
  <div class="q-pa-md">
    <q-table
      class="my-sticky-header-table"
      :rows="featureds"
      :columns="columnsfeatureds"
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
        <div class="col-2 q-table__title text-white">Productos Destacados</div>
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
    <q-dialog v-model="showDialogF" persistent>
      <q-card class="cartel row justify-center">
        <q-card-section>
          <q-form>
            <q-input v-model="tempFeatured.name" label="Nombre" />
            <q-input v-model="tempFeatured.description" label="Descripción" />
            <q-input
              v-model="tempFeatured.price"
              label="Precio"
              type="number"
            />
            <q-select
              v-model="tempFeatured.rating"
              label="Valoración"
              :options="[1, 2, 3, 4, 5]"
            />
            <q-checkbox v-model="tempFeatured.discount" label="Descuento" />
            <q-input
              v-if="tempFeatured.discount"
              v-model="tempFeatured.discountValue"
              type="number"
              label="Valor del descuento"
            />
            <q-input bottom-slots v-model="tempFeatured.image" label="Imagen">
              <template v-slot:before>
                <q-avatar>
                  <q-img v-if="tempFeatured.image" :src="tempFeatured.image" />
                </q-avatar>
              </template>
            </q-input>
            <div class="q-mt-md q-gutter-xs">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="showEditDialog == true"
                @click="editFeatured(tempFeatured.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="showAddDialog == true"
                @click="addFeatured(tempFeatured)"
              />
              <q-btn label="Cancelar" @click="showDialogF = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <q-dialog v-model="showcardDialogF">
      <div class="q-pa-sm">
        <q-card class="featuredcard">
          <q-img
            class="featuredcardimg"
            :ratio="16 / 9"
            fit="cover"
            :src="tempFeatured.image"
            :alt="tempFeatured.name"
          />

          <q-badge
            class="q-badge"
            v-if="tempFeatured.discount"
            color="positive"
            floating
            transparent
          >
            {{ tempFeatured.discount }}%
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
            <div class="row no-wrap items-center">
              <q-item-label
                header=""
                class="col text-h6 text-left ellipsis text-purple q-pt-none"
              >
                {{ tempFeatured.name }}
              </q-item-label>
            </div>
            <q-rating
              self-end
              v-model="tempFeatured.rating"
              icon="star_border"
              icon-selected="star"
              :max="5"
              size="1.5em"
              v-if="tempFeatured.rating"
              readonly="true"
            />
          </q-card-section>
          <q-card-section class="q-pt-none">
            <div class="text-subtitle1 text-right text-dark">
              $ {{ tempFeatured.price }}
            </div>
            <div class="text-caption text-grey">
              {{ tempFeatured.description }}
            </div>
          </q-card-section>
        </q-card>
      </div>
    </q-dialog>
  </div>
</template>
<script setup>
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { ref, onMounted } from "vue";

const $q = useQuasar();
const featureds = ref([]);
const filter = ref("");
const showDialogF = ref(false);
const showcardDialogF = ref(false);
const showEditDialog = ref(false);
const showAddDialog = ref(false);
const tempFeatured = ref({});

const columnsfeatureds = [
  {
    name: "id",
    required: true,
    label: "Id",
    align: "left",
    field: (row) => row.id,
    sortable: true,
  },
  {
    name: "name",
    required: true,
    label: "Nombre",
    align: "left",
    field: (row) => row.name,
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
    name: "price",
    label: "Precio",
    field: "price",
    format: (val) => `${val}`,
    align: "center",
    sortable: true,
  },
  {
    name: "rating",
    label: "Valoración",
    field: "rating",
    sortable: true,
    align: "center",
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
  tempFeatured.value = { ...row };
  showcardDialogF.value = true;
};
const openEditDialog = (row) => {
  tempFeatured.value = { ...row };
  showAddDialog.value = false;
  showEditDialog.value = true;
  showDialogF.value = true;
};
const openAddDialog = () => {
  tempFeatured.value = {};
  showAddDialog.value = true;
  showEditDialog.value = false;
  showDialogF.value = true;
};

const getFeatureds = async () => {
  const { data } = await api.get("/api/featureds");
  featureds.value = data;
};

const addFeatured = async (newFeatured) => {
  try {
    await api.post("/api/featureds", newFeatured);
    $q.notify({
      message: "Agregado con exito",
      icon: "check",
      color: "positive",
    });
    await getFeatureds();
    showDialogF.value = false;
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
      message: "Error al editar ;)",
      icon: "times",
      color: "negative",
    });
    return;
  }
  try {
    await api.patch(`/api/featureds/${id}`, tempFeatured.value);
    $q.notify({
      message: "Editado con éxito",
      icon: "check",
      color: "positive",
    });
    await getFeatureds();
    showDialogF.value = false;
    tempFeatured.value = {};
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
      await api.delete(`/api/featureds/${id}`);
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

.featuredcard
  width: 100%
  max-width: 300px
  box-shadow: 0px 0px 10px 5px #00000033
  transition: box-shadow 0.5s ease-in-out
</style>
