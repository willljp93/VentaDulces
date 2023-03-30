<template>
  <div class="col-4 q-pa-lg flex flex-center">
    <q-pagination
      v-model="currentPage"
      :min="1"
      :max="totalPages"
      :color="paginationColor"
      :size="paginationSize"
      :input="paginationInput"
      input-class="secondary"
    >
    </q-pagination>
  </div>
</template>

<script>
import { ref, computed } from "vue";
export default {
  name: "ListCardProductComponents",
  props: {
    perPage: {
      type: Number,
      default: 6,
    },
    paginationColor: {
      type: String,
      default: "primary",
    },
    paginationSize: {
      type: String,
      default: "md",
    },
    paginationInput: {
      type: Boolean,
      default: true,
    },
  },
  setup(props) {
    const currentPage = ref(1);

    const totalPages = computed(() => {
      return Math.ceil(filteredItems.value.length / props.perPage);
    });

    const displayedItems = computed(() => {
      const startIndex = (currentPage.value - 1) * props.perPage;
      const endIndex = startIndex + props.perPage;
      return filteredItems.value.slice(startIndex, endIndex);
    });
    return {
      currentPage,
      filteredItems,
      totalPages,
      displayedItems,
    };
  },
};
</script>
