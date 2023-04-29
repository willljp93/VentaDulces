<template>
  <q-layout view="hHh Lpr fFr">
    <q-header reveal elevated class="bg-primary text-white">
      <q-toolbar class="row justify-between">
        <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />

        <q-toolbar-title class="col-3">
          <q-avatar>
            <img src="~/assets/logo_shop.png" />
          </q-avatar>
          Eccomerce William
        </q-toolbar-title>

        <div class="row col justify-end items-center content-end">
          <q-btn
            dense
            stretch
            unelevated
            padding="2px"
            icon-right="settings_applications"
            to="/admin/dashboard"
            v-if="userStore.user"
          />
          <q-btn
            unelevated
            dense
            padding="5px"
            label="Iniciar sesión"
            to="login"
            v-if="!userStore.user"
          >
            <q-avatar size="42px" class="q-ml-xs">
              <img fit="fill" src="~/assets/no_user_logo.png" />
            </q-avatar>
          </q-btn>
          <q-btn
            unelevated
            dense
            padding="5px"
            :label="user?.email"
            @click="logout()"
            v-else
          >
            <q-avatar size="42px" class="q-ml-xs">
              <img fit="fill" src="~/assets/no_user_logo.png" />
            </q-avatar>
          </q-btn>

          <q-btn
            dense
            stretch
            unelevated
            padding="5px"
            label="Mi Carrito"
            icon-right="shopping_cart"
            v-if="userStore.user"
            @click="toggleRightDrawer"
          >
            <q-badge style="margin-top: 0.4rem" color="red" transparent floating
              >{{ cantidadDulces }}</q-badge
            >
          </q-btn>
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered>
      <q-list>
        <!-- <q-item-label header>dfg </q-item-label> -->
        <LeftDrawerMenu />
      </q-list>
    </q-drawer>

    <q-drawer v-model="rightDrawerOpen" side="right" overlay bordered>
      <RightDrawerMenu />
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
    <q-footer reveal elevated class="row bg-dark text-white q-pa-xs">
      <q-toolbar>
        <q-toolbar-title>
          <div class="col-2 q-pa-xs">
            <q-avatar>
              <img src="~/assets/logo_shop.png" />
            </q-avatar>
          </div>
        </q-toolbar-title>
        <div class="col-6 q-pa-xs q-gutter-lg" align="center">
          <q-btn
            round
            flat
            padding="none"
            icon="lab la-facebook"
            size="lg"
            target="_blank"
            href="https://www.facebook.com/"
          />
          <q-btn
            round
            flat
            padding="none"
            icon="lab la-whatsapp"
            size="lg"
            target="_blank"
            href="https://web.whatsapp.com/"
          />
          <q-btn
            round
            flat
            padding="none"
            icon="lab la-telegram"
            size="lg"
            target="_blank"
            href="https://t.me/Will_l"
          />
        </div>
        <q-separator spaced />
        <div class="col-3 justify-center text-center">
          {{ new Date().getFullYear() }} —
          <strong>Copyright: @willl_l</strong>
        </div>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script setup>
import LeftDrawerMenu from "src/components/LeftDrawerMenu.vue";
import RightDrawerMenu from "src/components/RightDrawerMenu.vue";
import { ref, onMounted } from "vue";
import { useUserStore } from "src/stores/Auth";

import { storeToRefs } from "pinia";
import { api } from "src/boot/axios";
import { useGetCarritoStore } from "src/stores/runGetCarrito";

const userStore = useUserStore();
const { getUser } = useUserStore();
const { cantidadDulces} = storeToRefs(useGetCarritoStore())
const { user } = storeToRefs(useUserStore());
onMounted(async () => {
  await getUser();
});

const logout = async () => {
  try {
    await api.post("/logout");
    userStore.user = null;
  } catch (error) {
    console.error(error);
  }
};
const leftDrawerOpen = ref(false);
const rightDrawerOpen = ref(false);

function toggleLeftDrawer() {
  leftDrawerOpen.value = !leftDrawerOpen.value;
}

function toggleRightDrawer() {
  rightDrawerOpen.value = !rightDrawerOpen.value;
}
</script>
