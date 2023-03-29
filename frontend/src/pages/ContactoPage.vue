<template>
  <q-page padding class="row justify-center">
    <q-card class="my-card shadow-8">
      <q-card-section>
        <div class="text-h4">Contacto</div>
      </q-card-section>
      <q-separator inset />
      <q-card-section class="q-pt-none text-subtitle1">
        ¡Gracias por visitar nuestra tienda online de pasteles y repostería! Si
        tienes alguna pregunta, comentario o sugerencia, por favor no dudes en
        contactarnos. Estamos aquí para ayudarte y brindarte la mejor
        experiencia de compra posible.
      </q-card-section>
      <q-separator inset />
      <q-card-section>
        <div class="text-h6">Información de contacto</div>
      </q-card-section>
      <q-card-section class="q-pa-lg text-subtitle2">
        <li>Correo electrónico: info@ejemplodetienda.com</li>
        <li>Teléfono: +1 (555) 555-5555</li>
        <li>
          Dirección: Calle Ejemplo #123, Ciudad Ejemplo, País Ejemplo
          <div class="map">
            <iframe
              width="100%"
              height="300"
              frameborder="0"
              scrolling="no"
              marginheight="0"
              marginwidth="0"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3031.571566756834!2d-3.703306284603632!3d40.41686203272629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4227a4b6e785b7%3A0x539dce0d4f43e4e4!2sPuerta%20del%20Sol%2C%20Madrid!5e0!3m2!1sen!2ses!4v1634308138247!5m2!1sen!2ses"
            ></iframe>
          </div>
        </li>
        <li>
          Horario de atención al cliente: Lunes a Viernes de 9:00 am a 6:00 pm
        </li>
      </q-card-section>
      <q-card-section>
        <div class="text-h6">Envíanos un mensaje</div>
      </q-card-section>
      <q-separator inset />
      <q-card-section class="q-pt-none text-subtitle1">
        Si prefieres contactarnos a través de nuestra página web, puedes llenar
        el siguiente formulario y nos pondremos en contacto contigo lo antes
        posible:
      </q-card-section>
      <q-card-section class="q-pt-none">
        <FormContact />
      </q-card-section>
      <q-card-section class="q-pt-none text-subtitle1">
        ¡Gracias por tu interés en nuestra tienda online! Estamos comprometidos
        en brindarte el mejor servicio posible y esperamos poder ayudarte
        pronto.
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import FormContact from "src/components/FormContact.vue";
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 850px
</style>
