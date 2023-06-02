<template>
  <div class="q-pa-md">
    <q-table
      class="catprod2"
      :rows="flanes"
      :columns="columnsflanes"
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
        <div class="col-2 q-table__title text-white">Categoria Flanes</div>
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
            @click="deleteFlanes(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
    <!-- Añadir - Editar -->
    <q-dialog v-model="showDialogFl" persistent>
      <q-card class="dialog addedit">
        <q-card-section>
          <q-form class="row justify-center">
            <q-input
              class="col-10"
              bottom-slots
              v-model="tempFlanes.image"
              label="Imagen"
            >
              <template v-slot:before>
                <q-avatar size="100px">
                  <q-img
                    :ratio="1"
                    v-if="tempFlanes.image"
                    :src="tempFlanes.image"
                  />
                </q-avatar>
              </template>
            </q-input>
            <q-input
              class="col-12"
              v-model="tempFlanes.title"
              type="text"
              label="Título"
            />
            <div class="row q-col-gutter-xs justify-between">
              <q-input
                class="col-3"
                v-model="tempFlanes.discount"
                type="number"
                label="Descuento"
              />
              <q-input
                class="col-3"
                v-model="tempFlanes.price"
                type="number"
                label="Precio"
              />
              <q-select
                class="col-3"
                v-model="tempFlanes.rating"
                label="Valoración"
                :options="[1, 2, 3, 4, 5]"
              />
              <q-select
                class="col-3"
                v-model="tempFlanes.available"
                label="Disponible"
                :options="[true, false]"
              />
            </div>
            <q-input
              class="col-12"
              v-model="tempFlanes.description"
              type="textarea"
              label="Descripción"
            />
            <div class="q-mt-md justify-center q-gutter-lg">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="EditFl == true"
                @click="editFlanes(tempFlanes.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="AddFl == true"
                @click="addFlanes(tempFlanes)"
              />
              <q-btn label="Cancelar" @click="showDialogFl = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!-- Ver -->
    <q-dialog v-model="ViewFl">
      <q-card class="my-cardroot">
        <q-card>
          <q-img
            class="q-img1"
            :src="tempFlanes.image"
            :alt="tempFlanes.title"
          />
          <q-badge
            class="q-badge"
            v-if="tempFlanes.discount"
            color="info"
            floating
            transparent
          >
            {{ tempFlanes.discount }}%
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
                {{ tempFlanes.title }}
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
                v-if="tempFlanes.rating"
                :value="tempFlanes.rating"
                :readonly="false"
              />
            </div>
          </q-card-section>
          <q-card-section class="q-pt-none">
            <div class="text-subtitle1 text-right">
              $ {{ tempFlanes.price }}
            </div>
            <div class="text-caption text-grey text-center">
              {{ tempFlanes.description }}
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

const { getFlanes, addFlanes, editFlanes, deleteFlanes } = useProductStore();
const { flanes, tempFlanes, AddFl, EditFl, ViewFl, showDialogFl } = storeToRefs(
  useProductStore()
);

const filter = ref("");
const stars = ref(0);
const columnsflanes = [
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
  await getFlanes();
});

const openViewDialog = (row) => {
  tempFlanes.value = { ...row };
  ViewFl.value = true;
};
const openEditDialog = (row) => {
  tempFlanes.value = { ...row };
  AddFl.value = false;
  EditFl.value = true;
  showDialogFl.value = true;
};
const openAddDialog = () => {
  tempFlanes.value = {};
  AddFl.value = true;
  EditFl.value = false;
  showDialogFl.value = true;
};
</script>

<style lang="scss">
.catprod2 {
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    background-color: #b9242a;
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
