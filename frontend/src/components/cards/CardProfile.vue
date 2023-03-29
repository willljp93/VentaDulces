<template>
  <q-card class="no-shadow mycard" bordered>
    <q-card-section class="text-center">
      <q-avatar size="100px" class="shadow-10">
        <img :src="avatar" />
      </q-avatar>
    </q-card-section>

    <q-card-section class="q-pt-none text-center">
      <div class="text-h6 text-grey-8">
        {{ name }}
      </div>
      <div class="text-caption text-grey-8">
        {{ des }}
      </div>
    </q-card-section>

    <q-card-actions align="center">
      <q-btn flat round icon="lab la-facebook" class="bg-indigo-7 text-white" />
      <q-btn flat round icon="lab la-twitter" class="bg-info text-white" />
      <q-btn
        flat
        round
        icon="lab la-instagram"
        class="bg-indigo-8 text-white"
      />
    </q-card-actions>
  </q-card>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "CardProfile",
  props: ["avatar", "name", "des"],
});
</script>

<style scoped lang="scss">
.mycard {
  width: 100%;
  max-width: 400px;
  transition: box-shadow 0.2s ease-in-out;
}
</style>
