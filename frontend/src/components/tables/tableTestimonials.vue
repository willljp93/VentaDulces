<template>
  <div class="q-pa-md">
    <q-table
      class="mytable3"
      :rows="testimonials"
      :columns="columnstestimonials"
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
        <div class="col-2 q-table__title text-white">Testimonios</div>
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
      <template v-slot:body-cell-avatar="props">
        <q-td :props="props">
          <q-img :src="props.row.avatar" />
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
            @click="deleteTestimonials(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
    <!-- Añadir - Editar -->
    <q-dialog v-model="showDialogT" persistent>
      <q-card class="dialog">
        <q-card-section>
          <q-form>
            <q-input
              bottom-slots
              v-model="tempTestimonials.avatar"
              label="Avatar"
            >
              <template v-slot:before>
                <q-avatar>
                  <q-img
                    v-if="tempTestimonials.avatar"
                    :src="tempTestimonials.avatar"
                  />
                </q-avatar>
              </template>
            </q-input>
            <q-input v-model="tempTestimonials.name" label="Nombre" />
            <q-input
              v-model="tempTestimonials.text"
              type="textarea"
              label="Descripción"
            />
            <q-select
              v-model="tempTestimonials.rating"
              label="Valoración"
              :options="[1, 2, 3, 4, 5]"
            />

            <div class="q-mt-md q-gutter-xs">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="EditT == true"
                @click="editTestimonials(tempTestimonials.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="AddT == true"
                @click="addTestimonials(tempTestimonials)"
              />
              <q-btn label="Cancelar" @click="showDialogT = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!-- Ver -->
    <q-dialog v-model="ViewT">
      <q-card class="testimonial-card text-dark col-6 q-pa-sm">
        <q-item>
          <q-item-section avatar>
            <q-avatar>
              <img :src="tempTestimonials.avatar" />
            </q-avatar>
          </q-item-section>
          <q-item-section side class="text-weight-bold">
            {{ tempTestimonials.name }}
          </q-item-section>
          <div>
            <q-badge color="transparent" floating outline>
              <q-rating
                class="testimonial-rating"
                v-model="tempTestimonials.rating"
                readonly
                size="1.6em"
                icon="thumb_up"
            /></q-badge>
          </div>
        </q-item>
        <q-separator inset />
        <q-card-section class="q-pt-none">
          {{ tempTestimonials.text }}
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { useIndexStore } from "src/stores/IndexStore";
import { storeToRefs } from "pinia";

const {
  getTestimonials,
  addTestimonials,
  editTestimonials,
  deleteTestimonials,
} = useIndexStore();
const { testimonials, tempTestimonials, AddT, EditT, ViewT, showDialogT } =
  storeToRefs(useIndexStore());

const filter = ref("");
const columnstestimonials = [
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
    name: "avatar",
    label: "Avatar",
    field: "avatar",
    align: "center",
    autoWidth: true,
  },
  {
    name: "name",
    required: true,
    label: "Nombre y Apellidos",
    align: "left",
    field: (row) => row.name,
    sortable: true,
    autoWidth: true,
  },
  {
    name: "text",
    align: "left",
    label: "Texto",
    field: "text",
    sortable: false,
    classes: "ellipsis",
    style: "max-width: 520px",
  },
  {
    name: "rating",
    align: "center",
    label: "Valoración",
    field: "rating",
    sortable: true,
    autoWidth: true,
  },
  { name: "actions", label: "Acciones", align: "center", autoWidth: true },
];

onMounted(async () => {
  await getTestimonials();
});

const openViewDialog = (row) => {
  tempTestimonials.value = { ...row };
  ViewT.value = true;
};
const openEditDialog = (row) => {
  tempTestimonials.value = { ...row };
  AddT.value = false;
  EditT.value = true;
  showDialogT.value = true;
};
const openAddDialog = () => {
  tempTestimonials.value = {};
  AddT.value = true;
  EditT.value = false;
  showDialogT.value = true;
};
</script>

<style lang="scss">
.mytable3 {
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    background-color: #009688;
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
