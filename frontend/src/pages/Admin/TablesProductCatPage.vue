<template>
  <q-page padding>
    <div class="q-gutter-md row justify-center">
      <h5 class="col-6 text-center text-weight-medium">Seleccione la categoria para Editar</h5>
      <q-select
        class="col-6"
        label="Editar Categoría"
        transition-show="scale"
        transition-hide="scale"
        bg-color="secondary"
        rounded
        standout
        v-model="cat"
        :options="options"
        style="width: 200px"
      />
    </div>
    <!-- content -->
    <table-pasteles v-if="cat === 'Pasteles'" />
    <table-flanes v-if="cat === 'Flanes'" />
    <table-panes v-if="cat === 'Panes'" />
    <table-reposteria v-if="cat === 'Reposteria'" />
    <table-decoraciones v-if="cat === 'Decoraciones'" />
  </q-page>
</template>

<script setup>
import { ref } from "vue";
import TablePasteles from "src/components/tables/tablePasteles.vue";
import TableFlanes from "src/components/tables/tableFlanes.vue";
import TablePanes from "src/components/tables/tablePanes.vue";
import TableReposteria from "src/components/tables/tableReposteria.vue";
import TableDecoraciones from "src/components/tables/tableDecoraciones.vue";

const cat = ref("Pasteles");
const options = ["Pasteles", "Flanes", "Panes", "Reposteria", "Decoraciones"];
</script>
