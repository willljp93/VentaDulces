<template>
  <!-- Promociones -->
  <div class="q-pa-md">
    <q-table
      class="my-sticky-header-table"
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
            @click="deleteTestimonial(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
    <q-dialog v-model="showDialogT" persistent>
      <q-card class="dialog">
        <q-card-section>
          <q-form>
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
            <div class="q-mt-md q-gutter-xs">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="showEditDialog == true"
                @click="editTestimonial(tempTestimonials.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="showAddDialog == true"
                @click="addTestimonial(tempTestimonials)"
              />
              <q-btn label="Cancelar" @click="showDialogT = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>

    <q-dialog v-model="showcardDialogT">
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
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { ref, onMounted } from "vue";

const $q = useQuasar();
const testimonials = ref([]);
const filter = ref("");
const showDialogT = ref(false);
const showcardDialogT = ref(false);
const showEditDialog = ref(false);
const showAddDialog = ref(false);
const tempTestimonials = ref({});

const columnstestimonials = [
  {
    name: "id",
    required: true,
    label: "Id",
    align: "left",
    field: (row) => row.id,
    sortable: true,
  },
  { name: "avatar", label: "Avatar", field: "avatar", align: "center" },
  {
    name: "name",
    required: true,
    label: "Nombre y Apellidos",
    align: "left",
    field: (row) => row.name,
    sortable: true,
  },
  {
    name: "text",
    align: "left",
    label: "Texto",
    field: "text",
    sortable: false,
  },
  { name: "actions", label: "Acciones", align: "center" },
];

onMounted(async () => {
  await getTestimonials();
});

const openViewDialog = (row) => {
  tempTestimonials.value = { ...row };
  showcardDialogT.value = true;
};
const openEditDialog = (row) => {
  tempTestimonials.value = { ...row };
  showAddDialog.value = false;
  showEditDialog.value = true;
  showDialogT.value = true;
};
const openAddDialog = () => {
  tempTestimonials.value = {};
  showAddDialog.value = true;
  showEditDialog.value = false;
  showDialogT.value = true;
};

const getTestimonials = async () => {
  const { data } = await api.get("/api/testimonials");
  testimonials.value = data;
};

const addTestimonial = async (newTestimonial) => {
  try {
    await api.post("/api/testimonials", newTestimonial);
    $q.notify({
      message: "Agregado con exito",
      icon: "check",
      color: "positive",
    });
    await getFeatureds();
    showDialogT.value = false;
  } catch (error) {
    $q.notify({
      message: "Error al agregar",
      icon: "times",
      color: "negative",
    });
  }
};

const editTestimonial = async (id) => {
  if (!id) {
    $q.notify({
      message: "Error al editar",
      icon: "times",
      color: "negative",
    });
    return;
  }
  try {
    await api.patch(`/api/testimonials/${id}`, tempTestimonials.value);
    $q.notify({
      message: "Editado con éxito",
      icon: "check",
      color: "positive",
    });
    await getTestimonials();
    showDialogT.value = false;
    tempTestimonials.value = {};
  } catch (error) {
    $q.notify({
      message: "Error al editar",
      icon: "times",
      color: "negative",
    });
  }
};

const deleteTestimonial = async (id) => {
  try {
    $q.dialog({
      html: true,
      title: '<span class="text-red">Eliminar</span>',
      message: "Estas seguro que deseas eliminar la fila",
      cancel: { color: "positive" },
      ok: { color: "negative" },
      persistent: true,
    }).onOk(async () => {
      await api.delete(`/api/testimonials/${id}`);
      $q.notify({
        message: "Eliminado con exito",
        icon: "check",
        color: "positive",
      });
      await getTestimonials();
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

.dialog
  width: 100%
  max-width: 450px
  transition: box-shadow 0.2s ease-in-out
  box-shadow: 0px 0px 10px 5px #00000033

.testimonial-card
  width: 100%
  max-width: 350px
  box-shadow: 0px 0px 10px 5px #00000033
  transition: box-shadow 0.5s ease-in-out

.testimonial-rating
  margin-right: 5px
  transform: translateY(5px)
</style>
