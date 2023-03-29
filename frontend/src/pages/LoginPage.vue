<template>
  <div class="login-page">
    <q-card class="login-card" flat>
      <q-card-section class="login-card-section">
        <h1 class="login-title">Bienvenido</h1>
        <form>
          <q-input
            v-model="email"
            type="email"
            label="Correo Electrónico"
            dense
            outlined
            class="input"
          />
          <q-input
            v-model="password"
            type="password"
            label="Contraseña"
            dense
            outlined
            class="input"
          />
          <q-checkbox
            v-model="rememberMe"
            label="Recordarme"
            dense
            color="primary"
            class="remember-me"
          />
          <q-btn type="submit" color="primary" label="Iniciar sesión" />
        </form>
        <div class="links-section">
          <q-btn
            @click="forgotPassword"
            label="¿Olvidaste tu contraseña?"
            flat
            text-color="primary"
          />
          <div class="register-link">
            ¿No tienes cuenta?
            <q-btn
              @click="register"
              label="Regístrate aquí"
              color="primary"
              dense
              to="registro"
            />
          </div>
        </div>
      </q-card-section>
    </q-card>
  </div>
</template>

<script setup>
import { defineComponent, ref } from "vue";
const email = ref("");
const password = ref("");
const rememberMe = ref(false);

const forgotPassword = () => {
  // Lógica para redirigir al usuario a la página de recuperación de contraseña
};
</script>

<style scoped lang="scss">
.login-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-image: linear-gradient(to bottom right, #f15a24, #ffcd00);
}

.login-card {
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

.login-card-section {
  padding: 2rem;
}

.login-title {
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

.remember-me {
  margin-top: 1rem;
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

  &:hover {
    transform: scale(1.05);
  }

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

.register-link {
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
