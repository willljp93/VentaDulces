<template>
  <div class="register-page">
    <q-card class="register-card" flat>
      <q-card-section class="register-card-section">
        <h1 class="register-title">Regístrate</h1>
        <form>
          <q-input
            v-model="name"
            type="text"
            label="Nombre completo"
            dense
            outlined
            class="input"
            :rules="[(val) => !!val || 'Por favor ingresa tu nombre']"
          />
          <q-input
            v-model="email"
            type="email"
            label="Correo Electrónico"
            dense
            outlined
            class="input"
            :rules="[
              (val) => !!val || 'Por favor ingresa tu correo electrónico',
              (val) =>
                /.+@.+\..+/.test(val) ||
                'Por favor ingresa un correo electrónico válido',
            ]"
          />
          <q-input
            v-model="password"
            type="password"
            label="Contraseña"
            dense
            outlined
            class="input"
            :rules="[(val) => !!val || 'Por favor ingresa tu contraseña']"
          />
          <q-input
            v-model="confirmPassword"
            type="password"
            label="Confirmar contraseña"
            dense
            outlined
            class="input"
            :rules="[
              (val) => !!val || 'Por favor confirma tu contraseña',
              (val) => val === password || 'Las contraseñas no coinciden',
            ]"
          />
          <q-btn type="submit" color="primary" label="Registrarme" />
        </form>
        <div class="links-section">
          <div class="login-link">
            ¿Ya tienes cuenta?
            <q-btn
              @click="login"
              label="Inicia sesión aquí"
              color="primary"
              dense
              to="login"
            />
          </div>
        </div>
      </q-card-section>
    </q-card>
  </div>
</template>

<script setup>
import { ref } from "vue";

const name = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");
</script>

<style scoped lang="scss">
.register-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-image: linear-gradient(to bottom right, #f15a24, #ffcd00);
}

.register-card {
  max-width: 400px;
  width: 100%;
  background-color: #fff;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
  border-radius: 4px;
  transition: transform 0.3s ease-in-out;

  &:hover {
    transform: scale(1.05);
  }
}

.register-card-section {
  padding: 2rem;
}

.register-title {
  font-size: 2rem;
  margin-bottom: 2rem;
  text-align: center;
  color: #1976d2;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;
}

.input {
  margin-bottom: 1rem;
  width: 100%;

  q-inner {
    border-color: #1976d2;
  }

  q-label {
    color: #1976d2;
  }
}

button[type="submit"] {
  margin-top: 2rem;
  width: 100%;
  max-width: 300px;
  text-transform: uppercase;
  font-size: 1rem;
  font-weight: 600;
  letter-spacing: 0.1rem;
  background-color: #1976d2;
  color: #fff;
  border-radius: 4px;
  border: none;
  transition: transform 0.3s ease-in-out;

  &:focus {
    outline: none;
  }
}

.links-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 1rem;
}

.login-link {
  margin-top: 2rem;
  text-align: center;

  q-btn {
    margin-left: 0.5rem;
    background-color: #fff;
    color: #1976d2;
    border: 2px solid #1976d2;
    border-radius: 4px;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.1rem;
    transition: transform 0.3s ease-in-out;

    &:hover {
      transform: scale(1.05);
    }
  }
}
</style>
