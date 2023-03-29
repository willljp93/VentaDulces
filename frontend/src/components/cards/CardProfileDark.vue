<template>
  <q-card
    class="text-red no-shadow mycard"
    bordered
    style="background-color: #181c4d"
  >
    <q-card-section>
      <div class="text-h6 q-pa-sm">{{ name }} a</div>
      <div class="q-pa-sm">{{ text }} a</div>
      <div class="q-pa-sm text-red-6">{{ des }} a</div>
    </q-card-section>
  </q-card>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "CardProfileDark",
  props: ["name", "des", "text"],
});
</script>

<style scoped lang="scss">
.mycard {
  width: 100%;
  max-width: 300px;
  transition: box-shadow 0.2s ease-in-out;
}
</style>
