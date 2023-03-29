<template>
  <div class="justify-center q-pa-md">
    <q-form @submit="submitForm" class="q-pa-md">
      <q-input
        class="q-pa-xs"
        outlined
        v-model="form.name"
        label="Nombre"
        required
      />
      <q-input
        class="q-pa-xs"
        outlined
        v-model="form.email"
        label="Correo electrónico"
        type="email"
        required
      />
      <q-input
        class="q-pa-xs"
        type="textarea"
        outlined
        v-model="form.message"
        label="Mensaje"
        required
      />
      <div align="center">
        <q-btn
          class="q-pa-xs"
          type="submit"
          color="primary"
          label="Enviar mensaje"
        />
      </div>
    </q-form>
  </div>
</template>

<script setup>
import { reactive } from "vue";

const form = reactive({
  name: "",
  email: "",
  message: "",
});

const submitForm = () => {
  console.log("Formulario enviado");
};
</script>

<style>
/* Estilos para el componente */
.q-pa-md {
  padding: 16px;
}
</style>
