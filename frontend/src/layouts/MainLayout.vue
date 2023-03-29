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

        <q-input
          class="q-pa-xs col-5"
          v-model="search"
          rounded
          dark
          standout
          dense
          type="search"
        >
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>

        <div class="row col justify-end items-center content-end">
          <q-btn
            dense
            stretch
            unelevated
            padding="2px"
            icon-right="settings_applications"
            to="/admin/dashboard"
          />
          <q-btn
            unelevated
            dense
            padding="5px"
            label="Iniciar sesión  "
            to="login"
          >
            <q-avatar size="42px">
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
            @click="toggleRightDrawer"
          >
            <q-badge style="margin-top: 0.4rem" color="red" transparent floating
              >0</q-badge
            >
          </q-btn>
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered>
      <q-list>
        <q-item-label header> </q-item-label>

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

<script>
import LeftDrawerMenu from "src/components/LeftDrawerMenu.vue";
import RightDrawerMenu from "src/components/RightDrawerMenu.vue";
import { ref } from "vue";

export default {
  name: "MainLayout",
  components: {
    LeftDrawerMenu,
    RightDrawerMenu,
  },
  setup() {
    const leftDrawerOpen = ref(false);
    const rightDrawerOpen = ref(false);

    return {
      search: ref(""),

      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },

      rightDrawerOpen,
      toggleRightDrawer() {
        rightDrawerOpen.value = !rightDrawerOpen.value;
      },
    };
  },
};
</script>
