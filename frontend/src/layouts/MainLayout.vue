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

          />
          <q-btn
            unelevated
            dense
            padding="5px"
            label="Iniciar sesión"
            to="login"

          >
            <q-avatar size="42px" class="q-ml-xs">
              <img fit="fill" src="~/assets/no_user_logo.png" />
            </q-avatar>
          </q-btn>
          <q-btn-dropdown

            dense
            stretch
            unelevated
            padding="5px"
            :label="user?.email"
          >
            <div class="row no-wrap q-pa-md">
              <div class="column">
                <div class="text-h6 q-mb-md">Ajustes</div>

                <q-list>
                  <q-item clickable v-ripple>
                    <q-item-section avatar>
                      <q-icon color="primary" name="account_circle" />
                    </q-item-section>
                    <q-item-section>Cambiar Foto de Perfil</q-item-section>
                  </q-item>

                  <q-item clickable v-ripple>
                    <q-item-section avatar>
                      <q-icon color="primary" name="password" />
                    </q-item-section>
                    <q-item-section>Cambiar Contraseña</q-item-section>
                  </q-item>
                </q-list>
              </div>

              <q-separator vertical inset class="q-mx-lg" />

              <div class="column items-center">
                <q-avatar size="72px">
                  <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
                </q-avatar>

                <div class="text-subtitle1 q-mt-md q-mb-xs">
                  {{ user?.name }}
                </div>

                <q-btn
                  color="primary"
                  label="Salir"
                  push
                  size="sm"
                  @click="logout()"
                  v-close-popup
                />
              </div>
            </div>
          </q-btn-dropdown>

          <q-btn
            dense
            stretch
            unelevated
            padding="5px"
            label="Mi Carrito"
            icon-right="shopping_cart"

            @click="toggleRightDrawer"
          >
            <q-badge
            style="margin-top: -0.1rem"
              floating
              transparent
              color="red"
              >{{ carritoCantidad }}</q-badge
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
import { useProductStore } from "src/stores/ProductStore";
import { useQuasar } from "quasar";

// const userStore = useUserStore();
const $q = useQuasar();
const { getUser } = useUserStore();
const { carritoCantidad } = storeToRefs(useProductStore());
const { user } = storeToRefs(useUserStore());
onMounted(async () => {
  // const cookie = q.cookie.
  if(cookie.length > 0){
    await getUser();
  }
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
