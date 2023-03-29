<template>
  <div class="q-pa-md">
    <q-carousel
      v-model="slide"
      vertical
      transition-prev="flip-down"
      transition-next="flip-up"
      swipeable
      infinite
      animated
      :autoplay="autoplay"
      @mouseenter="autoplay = false"
      @mouseleave="autoplay = true"
      height="200px"
    >
      <q-carousel-slide name="false" class="row no-wrap flex-center">
        <q-card
          class="bg-transparent no-shadow no-border flex-center mycard"
          bordered
        >
          <q-card-section class="q-pa-none">
            <div class="row q-col-gutter-md col-12">
              <div
                v-for="(item, index) in cards.items"
                :key="index"
                class="col-md-3 col-sm-6 col-xs-12"
              >
                <q-item
                  v-if="item.left === false"
                  :style="`background-color: ${item.color1}`"
                  class="q-pa-none"
                >
                  <q-item-section
                    v-if="item.left === 'true'"
                    side
                    :style="`background-color: ${item.color2}`"
                    class="q-pa-md q-mr-none text-white"
                  >
                    <q-icon
                      :name="item.icon"
                      color="white"
                      size="24px"
                    ></q-icon>
                  </q-item-section>
                  <q-item-section class="q-pa-lg q-ml-none text-white">
                    <q-item-label
                      class="text-white text-h6 text-weight-bolder"
                      >{{ item.value }}</q-item-label
                    >
                    <q-item-label>{{ item.title }}</q-item-label>
                  </q-item-section>
                  <q-item-section
                    v-if="item.left === 'true'"
                    side
                    class="q-mr-md text-white"
                  >
                    <q-icon
                      :name="item.icon"
                      color="white"
                      size="44px"
                    ></q-icon>
                  </q-item-section>
                </q-item>
              </div>
            </div>
          </q-card-section>
        </q-card>
      </q-carousel-slide>
      <q-carousel-slide name="true" class="row no-wrap flex-center">
        <q-card
          class="bg-transparent no-shadow no-border flex-center mycard"
          bordered
        >
          <q-card-section class="q-pa-none">
            <div class="row q-col-gutter-md col-12">
              <div
                v-for="(item, index) in cards.items"
                :key="index"
                class="col-md-3 col-sm-6 col-xs-12"
              >
                <q-item
                  v-if="item.left === true"
                  :style="`background-color: ${item.color1}`"
                  class="q-pa-none"
                >
                  <q-item-section
                    v-if="item.left === 'true'"
                    side
                    :style="`background-color: ${item.color2}`"
                    class="q-pa-md q-mr-none text-white"
                  >
                    <q-icon
                      :name="item.icon"
                      color="white"
                      size="24px"
                    ></q-icon>
                  </q-item-section>
                  <q-item-section class="q-pa-lg q-ml-none text-white">
                    <q-item-label
                      class="text-white text-h6 text-weight-bolder"
                      >{{ item.value }}</q-item-label
                    >
                    <q-item-label>{{ item.title }}</q-item-label>
                  </q-item-section>
                  <q-item-section
                    v-if="item.left === 'true'"
                    side
                    class="q-mr-md text-white"
                  >
                    <q-icon
                      :name="item.icon"
                      color="white"
                      size="44px"
                    ></q-icon>
                  </q-item-section>
                </q-item>
              </div>
            </div>
          </q-card-section>
        </q-card>
      </q-carousel-slide>
    </q-carousel>
  </div>
</template>

<script setup>
import { api } from "src/boot/axios";
import { ref, onMounted } from "vue";

onMounted(async () => {
  await getCardSocial();
});
const cards = ref([]);
const getCardSocial = async () => {
  const { data } = await api.get("/collections/cardSocial/records");
  cards.value = data;
};

const slide = ref("style");
const autoplay = ref(true);
</script>

<style scoped lang="scss">
.mycard {
  width: 100%;
  max-width: 1000px;
  transition: box-shadow 0.2s ease-in-out;
}
</style>
