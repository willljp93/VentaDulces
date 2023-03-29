<template>
  <q-page padding class="row q-gutter-lg q-pa-lg text-accent">
    <!-- content -->

    <q-separator dark />
    <CardBasic />
    <!-- content -->
    <q-separator dark />
    <CardCafe />

    <!-- content -->
    <q-separator dark />
    <CardCompany />
    <!-- content -->
    <q-separator dark />
    <CardItem />
    <!-- content -->
    <q-separator dark />
    <CardPricing />
    <!-- content -->
    <q-separator dark />
    <!-- <CardProduct /> -->
    <!-- content -->
    <q-separator dark />
    <CardProfile />
    <!-- content -->
    <q-separator dark />
    <CardProfileDark />
    <!-- content -->
    <q-separator dark />
    <CardSocial />
    <!-- content -->
    <q-separator dark />
    <CardTimeLine />
    <!-- content -->
    <q-separator dark />
    <CardWithImage />
    <!-- content -->
    <q-separator dark />
    <DirectoryCard />
    <!-- content -->
  </q-page>
</template>

<script>
import { defineComponent, defineAsyncComponent, ref } from "vue";
import CardBasic from "src/components/cards/CardBasic.vue";
import CardCafe from "src/components/cards/CardCafe.vue";
import CardCompany from "src/components/cards/CardCompany.vue";
import CardItem from "src/components/cards/CardItem.vue";
import CardPricing from "src/components/cards/CardPricing.vue";
// import CardProduct from "src/components/cards/CardProduct.vue";
import CardProfile from "src/components/cards/CardProfile.vue";
import CardProfileDark from "src/components/cards/CardProfileDark.vue";
import CardSocial from "src/components/cards/CardSocial.vue";
import CardTimeLine from "src/components/cards/CardTimeLine.vue";
import CardWithImage from "src/components/cards/CardWithImage.vue";
import DirectoryCard from "src/components/cards/DirectoryCard.vue";

export default {
  name: "TestPage",
  components: {
    CardBasic,
    CardCafe,
    CardCompany,
    CardItem,
    CardPricing,
    // CardProduct,
    CardProfile,
    CardProfileDark,
    CardSocial,
    CardTimeLine,
    CardWithImage,
    DirectoryCard,
  },
};
</script>
