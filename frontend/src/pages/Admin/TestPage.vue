<template>
  <q-page
    padding
    class="row q-gutter-lg q-pa-lg text-accent"
    v-if="userStore.user"
  >
    <q-img
      src="\public\profile_photos\647e57d32fec1.jpg"
      :ratio="16/9"
      spinner-color="primary"
      spinner-size="82px"
    />
    <q-separator inset />
  </q-page>
</template>

<script setup>
import { useUserStore } from "src/stores/Auth";
import { onMounted } from "vue";

const userStore = useUserStore();
onMounted(async () => {
  await userStore.getUser();
});
</script>
