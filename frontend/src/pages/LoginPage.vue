<template>
  <div class="auth-page">
    <div class="card">
      <h6 v-if="isRegister">Registro de usuario</h6>
      <h6 v-else>Iniciar sesión</h6>
      <q-form v-if="isRegister" @submit.prevent="submitRegister">
        <div class="form-group">
          <label for="name">Nombre:</label>
          <q-input
            dense
            type="text"
            id="name"
            v-model="registerForm.name"
            required
          />
        </div>
        <div class="form-group">
          <label for="email">Correo electrónico:</label>
          <q-input
            dense
            type="email"
            id="email"
            v-model="registerForm.email"
            required
          />
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <q-input
            dense
            type="password"
            id="password"
            v-model="registerForm.password"
            required
          />
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirmar contraseña:</label>
          <q-input
            dense
            type="password"
            id="password_confirmation"
            v-model="registerForm.password_confirmation"
            required
          />
        </div>
        <q-btn
          class="q-ma-xs"
          type="submit"
          color="primary"
          icon="login"
          label="Registrarse"
        />
      </q-form>
      <q-form v-else @submit.prevent="submitLogin">
        <div class="form-group">
          <label for="email">Correo electrónico:</label>
          <q-input
            dense
            type="email"
            id="email"
            v-model="loginForm.email"
            required
          />
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <q-input
            dense
            type="password"
            id="password"
            v-model="loginForm.password"
            required
          />
        </div>
        <q-btn type="submit">Iniciar sesión</q-btn>
      </q-form>
      <div v-if="isRegister">
        ¿Ya tienes una cuenta?
        <a href="#" @click.prevent="toggleForm(false)">Iniciar sesión</a>
      </div>
      <div v-else>
        ¿No tienes una cuenta?
        <a href="#" @click.prevent="toggleForm(true)">Regístrate</a>
      </div>
    </div>
  </div>
</template>
<script setup>
import { reactive, ref } from "vue";
import api from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const isRegister = ref(true);
const loginForm = reactive({
  email: "",
  password: "",
});

const registerForm = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

async function submitLogin() {
  try {
    await api.post("http://localhost:8000/login", loginForm);
    router.push({ path: "/" });
  } catch (error) {
    console.log("MI ERROR: ", error);
  }
}

async function submitRegister() {
  try {
    await api.post("http://localhost:8000/register", registerForm);
    router.push({ path: "/" });
  } catch (error) {
    console.log("MI ERROR: ", error);
  }
}

function toggleForm(value) {
  isRegister.value = value;
}
</script>
<style>
.auth-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.card {
  width: 400px;
  padding: 20px;
  border: 1px solid #000000;
  border-radius: 5px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  background-color: rgb(192, 212, 255);
}

a {
  color: #007bff;
  cursor: pointer;
}
</style>
