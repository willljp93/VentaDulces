<template>
  <div class="q-pa-md">
    <q-table
      class="catprod5"
      :rows="decoraciones"
      :columns="columnsdecoraciones"
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
        <div class="col-2 q-table__title text-white">
          Categoria Decoraciones
        </div>
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
            @click="deleteDecoraciones(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
    <!-- Añadir - Editar -->
    <q-dialog v-model="showDialogDc" persistent>
      <q-card class="dialog addedit">
        <q-card-section>
          <q-form class="row justify-center">
            <q-input
              class="col-10"
              bottom-slots
              v-model="tempDecoraciones.image"
              label="Imagen"
            >
              <template v-slot:before>
                <q-avatar size="100px">
                  <q-img
                    :ratio="1"
                    v-if="tempDecoraciones.image"
                    :src="tempDecoraciones.image"
                  />
                </q-avatar>
              </template>
            </q-input>
            <q-input
              class="col-12"
              v-model="tempDecoraciones.title"
              type="text"
              label="Título"
            />
            <div class="row q-col-gutter-xs justify-between">
              <q-input
                class="col-3"
                v-model="tempDecoraciones.discount"
                type="number"
                label="Descuento"
              />
              <q-input
                class="col-3"
                v-model="tempDecoraciones.price"
                type="number"
                label="Precio"
              />
              <q-select
                class="col-3"
                v-model="tempDecoraciones.rating"
                label="Valoración"
                :options="[1, 2, 3, 4, 5]"
              />
              <q-select
                class="col-3"
                v-model="tempDecoraciones.available"
                label="Disponible"
                :options="[true, false]"
              />
            </div>
            <q-input
              class="col-12"
              v-model="tempDecoraciones.description"
              type="textarea"
              label="Descripción"
            />
            <div class="q-mt-md justify-center q-gutter-lg">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="EditDc == true"
                @click="editDecoraciones(tempDecoraciones.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="AddDc == true"
                @click="addDecoraciones(tempDecoraciones)"
              />
              <q-btn label="Cancelar" @click="showDialogDc = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!-- Ver -->
    <q-dialog v-model="ViewDc">
      <q-card class="my-cardroot">
        <q-card>
          <q-img
            class="q-img1"
            :src="tempDecoraciones.image"
            :alt="tempDecoraciones.title"
          />
          <q-badge
            class="q-badge"
            v-if="tempDecoraciones.discount"
            color="info"
            floating
            transparent
          >
            {{ tempDecoraciones.discount }}%
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
                {{ tempDecoraciones.title }}
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
                v-if="tempDecoraciones.rating"
                :value="tempDecoraciones.rating"
                :readonly="false"
              />
            </div>
          </q-card-section>
          <q-card-section class="q-pt-none">
            <div class="text-subtitle1 text-right">
              $ {{ tempDecoraciones.price }}
            </div>
            <div class="text-caption text-grey text-center">
              {{ tempDecoraciones.description }}
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

const {
  getDecoraciones,
  addDecoraciones,
  editDecoraciones,
  deleteDecoraciones,
} = useProductStore();
const { decoraciones, tempDecoraciones, AddDc, EditDc, ViewDc, showDialogDc } =
  storeToRefs(useProductStore());

const filter = ref("");
const stars = ref(0);
const columnsdecoraciones = [
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
  await getDecoraciones();
});

const openViewDialog = (row) => {
  tempDecoraciones.value = { ...row };
  ViewDc.value = true;
};
const openEditDialog = (row) => {
  tempDecoraciones.value = { ...row };
  AddDc.value = false;
  EditDc.value = true;
  showDialogDc.value = true;
};
const openAddDialog = () => {
  tempDecoraciones.value = {};
  AddDc.value = true;
  EditDc.value = false;
  showDialogDc.value = true;
};
</script>

<style lang="scss">
.catprod5 {
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    background-color: #b9582a;
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
