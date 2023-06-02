<template>
  <q-page padding>

        <!-- content -->
    <table-pasteles />
    <table-flanes/>
    <table-panes/>
    <table-reposteria/>
    <table-decoraciones/>
  </q-page>
</template>

<script setup>
import TablePasteles from 'src/components/tables/tablePasteles.vue';
import TableFlanes from 'src/components/tables/tableFlanes.vue';
import TablePanes from 'src/components/tables/tablePanes.vue';
import TableReposteria from 'src/components/tables/tableReposteria.vue';
import TableDecoraciones from 'src/components/tables/tableDecoraciones.vue';
</script>
