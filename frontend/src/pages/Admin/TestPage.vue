<template>
  <q-page padding class="row q-gutter-lg q-pa-lg text-accent">
    AuthUser =>
    {{ userStore.user.name }}
    <q-separator inset />
    AuthStore =>
    {{ userStore.user.email }}
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
