<template>
  <router-view />
</template>

<script setup>
import { onMounted } from 'vue'
import { useUserStore } from './stores/Auth';
import { storeToRefs } from 'pinia';

const {getUser} = useUserStore()
const { user } = storeToRefs(useUserStore())

  onMounted(async() => {
    await getUser();
  });

</script>
