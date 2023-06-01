<template>
  <div class="q-pa-md">
    <q-table
      class="mytable"
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
    <!-- Añadir - Editar -->
    <q-dialog v-model="showDialogF" persistent>
      <q-card class="cartel row justify-center">
        <q-card-section>
          <q-form>
            <q-input v-model="tempFeatureds.name" label="Nombre" />
            <q-input v-model="tempFeatureds.description" label="Descripción" />
            <q-input
              v-model="tempFeatureds.price"
              label="Precio"
              type="number"
            />
            <q-select
              v-model="tempFeatureds.rating"
              label="Valoración"
              :options="[1, 2, 3, 4, 5]"
            />
            <q-checkbox v-model="tempFeatureds.discount" label="Descuento" />
            <q-input
              v-if="tempFeatureds.discount"
              v-model="tempFeatureds.discountValue"
              type="number"
              label="Valor del descuento"
            />
            <q-input bottom-slots v-model="tempFeatureds.image" label="Imagen">
              <template v-slot:before>
                <q-avatar>
                  <q-img
                    v-if="tempFeatureds.image"
                    :src="tempFeatureds.image"
                  />
                </q-avatar>
              </template>
            </q-input>
            <div class="q-mt-md q-gutter-xs">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="EditF"
                @click="editFeatured(tempFeatureds.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="AddF"
                @click="addFeatured(tempFeatureds)"
              />
              <q-btn label="Cancelar" @click="showDialogF = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!-- Ver -->
    <q-dialog v-model="ViewF">
      <div class="q-pa-sm">
        <q-card class="featuredcard">
          <q-img
            class="featuredcardimg"
            :ratio="16 / 9"
            fit="cover"
            :src="tempFeatureds.image"
            :alt="tempFeatureds.name"
          />

          <q-badge
            class="q-badge"
            v-if="tempFeatureds.discount"
            color="positive"
            floating
            transparent
          >
            {{ tempFeatureds.discount }}%
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
                {{ tempFeatureds.name }}
              </q-item-label>
            </div>
            <q-rating
              self-end
              v-model="tempFeatureds.rating"
              icon="star_border"
              icon-selected="star"
              :max="5"
              size="1.5em"
              v-if="tempFeatureds.rating"
              readonly="true"
            />
          </q-card-section>
          <q-card-section class="q-pt-none">
            <div class="text-subtitle1 text-right text-dark">
              $ {{ tempFeatureds.price }}
            </div>
            <div class="text-caption text-grey">
              {{ tempFeatureds.description }}
            </div>
          </q-card-section>
        </q-card>
      </div>
    </q-dialog>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { useIndexStore } from "src/stores/IndexStore";
import { storeToRefs } from "pinia";

const { getFeatureds, addFeatured, editFeatured, deleteFeatured } =
  useIndexStore();
const { featureds, tempFeatureds, AddF, EditF, ViewF, showDialogF } =
  storeToRefs(useIndexStore());

const filter = ref("");
const columnsfeatureds = [
  {
    name: "id",
    required: true,
    label: "Id",
    align: "center",
    field: (row) => row.id,
    sortable: true,
    autoWidth: true,
  },
  {
    name: "image",
    label: "Imagen",
    field: "image",
    align: "center",
    autoWidth: true,
  },
  {
    name: "name",
    required: true,
    label: "Nombre",
    align: "left",
    field: (row) => row.name,
    sortable: true,
    autoWidth: true,
  },
  {
    name: "description",
    align: "left",
    label: "Descripción",
    field: "description",
    sortable: false,
    classes: "ellipsis",
    style: "max-width: 300px",
  },
  {
    name: "price",
    label: "Precio",
    field: "price",
    format: (val) => `${val}`,
    align: "center",
    sortable: true,
    autoWidth: true,
  },
  {
    name: "rating",
    label: "Valoración",
    field: "rating",
    sortable: true,
    align: "center",
    autoWidth: true,
  },
  {
    name: "discount",
    label: "Descuento",
    field: "discount",
    sortable: true,
    align: "center",
    autoWidth: true,
  },

  { name: "actions", label: "Acciones", align: "center", autoWidth: true },
];

onMounted(async () => {
  await getFeatureds();
});

const openViewDialog = (row) => {
  tempFeatureds.value = { ...row };
  ViewF.value = true;
};
const openEditDialog = (row) => {
  tempFeatureds.value = { ...row };
  AddF.value = false;
  EditF.value = true;
  showDialogF.value = true;
};
const openAddDialog = () => {
  tempFeatureds.value = {};
  AddF.value = true;
  EditF.value = false;
  showDialogF.value = true;
};
</script>
<style lang="scss">
.mytable {
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    background-color: #9c27b0;
  }
  thead tr th {
    position: sticky;
    z-index: 1;
    &.q-table--loading thead tr:last-child th {
      top: 48px;
    }
  }
  &.q-table--loading thead tr:last-child th {
    top: 48px;
  }
  tbody {
    scroll-margin-top: 48px;
  }
}
</style>
