<template>
  <!-- Promociones -->
  <div class="q-pa-md">
    <q-table
      class="mytable2"
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
            @click="deletePromotions(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
    <!-- Add - Edit -->
    <q-dialog v-model="showDialogP" persistent>
      <q-card class="cartel row justify-center">
        <q-card-section>
          <q-form>
            <q-input bottom-slots v-model="tempPromotions.image" label="Imagen">
              <template v-slot:before>
                <q-avatar>
                  <q-img
                    v-if="tempPromotions.image"
                    :src="tempPromotions.image"
                  />
                </q-avatar>
              </template>
            </q-input>
            <q-input v-model="tempPromotions.title" label="Nombre" />
            <q-input v-model="tempPromotions.description" label="Descripción" />
            <q-input
              v-model="tempPromotions.discount"
              type="number"
              label="Valor del descuento"
            />
            <q-input
              v-model="tempPromotions.expires"
              type="date"
              label="Expira"
            />

            <div class="q-mt-md q-gutter-xs">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="EditP == true"
                @click="editPromotions(tempPromotions.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="AddP == true"
                @click="addPromotions(tempPromotions)"
              />
              <q-btn label="Cancelar" @click="showDialogP = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!-- Ver -->
    <q-dialog v-model="ViewP">
      <q-card class="promocion q-pa-sm" flat bordered>
        <q-item class="q-pa-md">
          <q-item-section
            side
            class="text-orange text-weight-bolder text-subtitle1"
          >
            {{ tempPromotions.title }}
          </q-item-section>
          <q-item-section>
            <q-badge color="red" floating transparent>
              <q-item-label class="discount text-weight-bold">
                {{ tempPromotions.discount }}% de descuento
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
                  Válido hasta {{ tempPromotions.expires }}
                </q-item-label>
              </q-chip>
            </q-item-label>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-card-section horizontal>
          <q-card-section class="text-subtitle1 text-dark">
            {{ tempPromotions.description }}
          </q-card-section>
          <q-separator vertical />
          <q-card-section class="col-8 self-center no-padding">
            <q-img
              :ratio="4 / 3"
              fit="cover"
              :src="tempPromotions.image"
              :alt="tempPromotions.title"
            />
          </q-card-section>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { useIndexStore } from "src/stores/IndexStore";
import { storeToRefs } from "pinia";

const { getPromotions, addPromotions, editPromotions, deletePromotions } =
  useIndexStore();
const { promotions, tempPromotions, AddP, EditP, ViewP, showDialogP } =
  storeToRefs(useIndexStore());

const filter = ref("");
const columnspromotions = [
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
    name: "title",
    required: true,
    label: "Título",
    align: "left",
    field: "title",
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
    style: "max-width: 400px",
  },
  {
    name: "discount",
    label: "Descuento",
    field: "discount",
    sortable: true,
    align: "center",
    autoWidth: true,
  },
  {
    name: "expires",
    label: "Expira",
    field: "expires",
    sortable: true,
    align: "center",
    autoWidth: true,
  },
  { name: "actions", label: "Acciones", align: "center", autoWidth: true },
];

onMounted(async () => {
  await getPromotions();
});

const openViewDialog = (row) => {
  tempPromotions.value = { ...row };
  ViewP.value = true;
};
const openEditDialog = (row) => {
  tempPromotions.value = { ...row };
  AddP.value = false;
  EditP.value = true;
  showDialogP.value = true;
};
const openAddDialog = () => {
  tempPromotions.value = {};
  AddP.value = true;
  EditP.value = false;
  showDialogP.value = true;
};
</script>

<style lang="scss">
.mytable2 {
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    background-color: #ff9800;
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
