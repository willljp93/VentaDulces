<template>
  <div class="col-8 q-pa-lg flex-center">
    <q-input
      dense
      standout="bg-primary text-white"
      rounded
      type="search"
      placeholder="Buscar"
      v-model="search"
      input-class="text-right"
      class="q-ml-xs"
    >
      <template v-slot:append>
        <q-icon v-if="search === ''" name="search" />
        <q-icon
          v-else
          name="clear"
          class="cursor-pointer"
          @click="search = ''"
        />
      </template>
    </q-input>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  value: {
    type: String,
    default: "",
  },
});

const emit = defineEmits(["update:value"]);

const search = ref(props.value);

watch(search, (newValue) => emit("update:value", newValue));
</script>
