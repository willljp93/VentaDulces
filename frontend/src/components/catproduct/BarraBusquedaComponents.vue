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

<script>
import { ref, computed } from "vue";
export default {
  name: "ListCardProductComponents",
  props: {
    maxPrice: {
      type: Number,
      default: Infinity,
    },
  },
  setup(props) {
    const search = ref("");

    const filteredItems = computed(() => {
      return props.items.filter(
        (item) =>
          item.title.toLowerCase().includes(search.value.toLowerCase()) &&
          item.price <= props.maxPrice
      );
    });

    return {
      search,
        };
  },
};
</script>