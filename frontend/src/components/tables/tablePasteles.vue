<template>
  <div class="q-pa-md">
    <q-table
      class="catprod1"
      :rows="pasteles"
      :columns="columnspasteles"
      :filter="filter"
      :rows-per-page-options="[7, 12, 15, 25]"
      row-key="id"
      rows-per-page-label="Productos a Mostrar"
      no-data-label="No encontre nada para ti"
      no-results-label="El filtro no descubrió ningún resultado."
      flat
      dense
      bordered
      separator="cell"
    >
      <template v-slot:top="props">
        <div class="col-2 q-table__title text-white">Categoria Pasteles</div>
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
            @click="deletePasteles(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
    <!-- Añadir - Editar -->
    <q-dialog v-model="showDialogPt" persistent>
      <q-card class="dialog addedit">
        <q-card-section>
          <q-form class="row justify-center">
            <q-input
              class="col-10"
              bottom-slots
              v-model="tempPasteles.image"
              label="Imagen"
            >
              <template v-slot:before>
                <q-avatar size="100px">
                  <q-img
                    :ratio="1"
                    v-if="tempPasteles.image"
                    :src="tempPasteles.image"
                  />
                </q-avatar>
              </template>
            </q-input>
            <q-input
              class="col-12"
              v-model="tempPasteles.title"
              type="text"
              label="Título"
            />
            <div class="row q-col-gutter-xs justify-between">
              <q-input
                class="col-3"
                v-model="tempPasteles.discount"
                type="number"
                label="Descuento"
              />
              <q-input
                class="col-3"
                v-model="tempPasteles.price"
                type="number"
                label="Precio"
              />
              <q-select
                class="col-3"
                v-model="tempPasteles.rating"
                label="Valoración"
                :options="[1, 2, 3, 4, 5]"
              />
              <q-select
                class="col-3"
                v-model="tempPasteles.available"
                label="Disponible"
                :options="[true, false]"
              />
            </div>
            <q-input
              class="col-12"
              v-model="tempPasteles.description"
              type="textarea"
              label="Descripción"
            />
            <div class="q-mt-md justify-center q-gutter-lg">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="EditPt == true"
                @click="editPasteles(tempPasteles.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="AddPt == true"
                @click="addPasteles(tempPasteles)"
              />
              <q-btn label="Cancelar" @click="showDialogPt = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!-- Ver -->
    <q-dialog v-model="ViewPt">
      <q-card class="my-cardroot">
        <q-card>
          <q-img
            class="q-img1"
            :src="tempPasteles.image"
            :alt="tempPasteles.title"
          />
          <q-badge
            class="q-badge"
            v-if="tempPasteles.discount"
            color="info"
            floating
            transparent
          >
            {{ tempPasteles.discount }}%
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
            />
            <div class="row no-wrap items-center">
              <q-item-label header="" class="col text-h6 ellipsis">
                {{ tempPasteles.title }}
              </q-item-label>
              <div
                class="col-auto text-grey text-caption row no-wrap items-center"
              >
                Comprar
              </div>
            </div>
            <div align="center">
              <q-rating
                v-model="stars"
                icon="star_border"
                icon-selected="star"
                :max="5"
                size="1.5em"
                v-if="tempPasteles.rating"
                :value="tempPasteles.rating"
                :readonly="false"
              />
            </div>
          </q-card-section>
          <q-card-section class="q-pt-none">
            <div class="text-subtitle1 text-right">
              $ {{ tempPasteles.price }}
            </div>
            <div class="text-caption text-grey text-center">
              {{ tempPasteles.description }}
            </div>
          </q-card-section>
          <q-separator />
          <q-card-actions vertical align="center">
            <q-btn
              flat
              icon="shopping_cart"
              color="primary"
              label="Agregar al carrito"
            />
          </q-card-actions>
        </q-card>
      </q-card>
    </q-dialog>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { useProductStore } from "src/stores/ProductStore";
import { storeToRefs } from "pinia";

const { getPasteles, addPasteles, editPasteles, deletePasteles } =
  useProductStore();
const { pasteles, tempPasteles, AddPt, EditPt, ViewPt, showDialogPt } =
  storeToRefs(useProductStore());

const filter = ref("");
const stars = ref(0);
const columnspasteles = [
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
    label: "Título",
    field: "title",
    align: "left",
    required: true,
    sortable: true,
    autoWidth: true,
  },
  {
    name: "discount",
    align: "center",
    label: "Descuento",
    field: "discount",
    required: true,
    sortable: true,
    autoWidth: true,
  },
  {
    name: "price",
    align: "center",
    label: "Precio",
    field: "price",
    required: true,
    sortable: true,
    autoWidth: true,
  },
  {
    name: "rating",
    align: "center",
    label: "Valoración",
    field: "rating",
    sortable: true,
    autoWidth: true,
  },
  {
    name: "description",
    align: "left",
    label: "Descripción",
    field: "description",
    classes: "ellipsis",
    style: "max-width: 350px",
  },
  {
    name: "available",
    align: "center",
    label: "Disponible",
    field: "available",
    sortable: true,
    autoWidth: true,
  },
  { name: "actions", label: "Acciones", align: "center", autoWidth: true },
];

onMounted(async () => {
  await getPasteles();
});

const openViewDialog = (row) => {
  tempPasteles.value = { ...row };
  ViewPt.value = true;
};
const openEditDialog = (row) => {
  tempPasteles.value = { ...row };
  AddPt.value = false;
  EditPt.value = true;
  showDialogPt.value = true;
};
const openAddDialog = () => {
  tempPasteles.value = {};
  AddPt.value = true;
  EditPt.value = false;
  showDialogPt.value = true;
};
</script>

<style lang="scss">
.catprod1 {
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    background-color: #b9142a;
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
.my-cardroot {
  width: 300px;
  padding: 1%;
}
.addedit {
  width: 500px;
  padding: 2%;
}
.q-img1 {
  height: 150px;
  object-fit: cover;
}
.q-badge {
  margin-right: 8px;
}
</style>
