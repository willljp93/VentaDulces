<template>
  <q-page padding>
    <div class="q-pa-md">
      <q-table
        class="my-sticky-header-table"
        title="Productos Destacados"
        :rows="featureds"
        :columns="columnsfeatureds"
        row-key="id"
        flat
        dense
        bordered
        separator="cell"
        no-data-label="No encontre nada para ti"
        no-results-label="El filtro no descubrió ningún resultado."
      >
        <template v-slot:top="props">
          <div class="col-2 q-table__title text-white">
            Productos Destacados
          </div>
          <q-space />
          <q-btn
            flat
            round
            dense
            :icon="props.inFullscreen ? 'fullscreen_exit' : 'fullscreen'"
            @click="props.toggleFullscreen"
            class="q-ml-md"
          />
        </template>
        <template v-slot:body="props">
          <q-tr :props="props">
            <q-td key="id" :props="props">
              {{ props.row.id }}
              <q-popup-edit v-model="props.row.id" v-slot="scope">
                <q-input v-model="scope.value" dense autofocus counter />
              </q-popup-edit>
            </q-td>
            <q-td key="name" :props="props">
              {{ props.row.name }}
              <q-popup-edit
                v-model="props.row.name"
                title="Actualizar Nombre"
                buttons
                auto-save
                v-slot="scope"
              >
                <q-input type="text" v-model="scope.value" dense autofocus />
              </q-popup-edit>
            </q-td>
            <q-td key="fat" :props="props">
              <div class="text-pre-wrap">{{ props.row.fat }}</div>
              <q-popup-edit v-model="props.row.fat" v-slot="scope">
                <q-input
                  type="textarea"
                  v-model="scope.value"
                  dense
                  autofocus
                />
              </q-popup-edit>
            </q-td>
            <q-td key="carbs" :props="props">
              {{ props.row.carbs }}
              <q-popup-edit
                v-model="props.row.carbs"
                title="Update carbs"
                buttons
                persistent
                v-slot="scope"
              >
                <q-input
                  type="number"
                  v-model="scope.value"
                  dense
                  autofocus
                  hint="Use buttons to close"
                />
              </q-popup-edit>
            </q-td>
            <q-td key="protein" :props="props">{{ props.row.protein }}</q-td>
            <q-td key="sodium" :props="props">{{ props.row.sodium }}</q-td>
            <q-td key="calcium" :props="props">{{ props.row.calcium }}</q-td>
            <q-td key="iron" :props="props">{{ props.row.iron }}</q-td>
          </q-tr>
        </template>
      </q-table>
      <!-- -------------------- -->
    </div>
  </q-page>
</template>

<script setup>
import { api } from "src/boot/axios";
import { ref, onMounted } from "vue";

const featureds = ref([]);

onMounted(async () => {
  await getFeatureds();
});

const getFeatureds = async () => {
  const { data } = await api.get("/collections/featureds/records");
  featureds.value = data.items;
};

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
  { name: "image", label: "Imagen", field: "image" },
];
</script>
<style lang="scss">
.my-sticky-header-table {
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    background-color: #26a69a;
  }
  thead tr th {
    position: sticky;
    z-index: 1;
  }
  thead tr:first-child th {
    top: 0;
  }
  &.q-table--loading thead tr:last-child th {
    top: 48px;
  }
}
</style>
