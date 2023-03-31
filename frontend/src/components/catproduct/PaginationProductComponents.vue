<template>
  <div class="col-4 q-pa-lg flex flex-center">
    <q-pagination
      v-model="currentPage"
      :min="1"
      :max="totalPages"
      :color="color"
      :size="size"
      :input="input"
      input-class="secondary"
    >
    </q-pagination>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, watch } from "vue";

const props = defineProps({
  currentPage: {
    type: Number,
    required: true,
  },
  totalPages: {
    type: Number,
    required: true,
  },
  color: {
    type: String,
    default: "primary",
  },
  size: {
    type: String,
    default: "md",
  },
  input: {
    type: Boolean,
    default: true,
  },
});

const emit = defineEmits(["update:currentPage"]);

const currentPage = ref(props.currentPage);

watch(currentPage, (newValue) => emit("update:currentPage", newValue));
</script>
