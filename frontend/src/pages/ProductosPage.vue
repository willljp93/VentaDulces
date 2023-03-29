<template>
  <div class="productos">
    <div class="q-pa-md">
      <div class="q-gutter-md">
        <div class="q-col">
          <div class="q-pa-md">
            <h1 class="q-mb-md">Productos</h1>
            <q-input
              outlined
              dense
              v-model="search"
              placeholder="Buscar producto"
              class="q-mb-md"
            />
            <div class="q-mb-md">
              <q-select
                v-model="categoria"
                :options="categorias"
                label="Categoría"
                emit-value
                map-options
                option-value="value"
                option-label="label"
              />
            </div>
          </div>
        </div>
        <div class="q-col">
          <div class="q-pa-md">
            <q-btn
              color="primary"
              size="md"
              class="q-mb-md"
              label="Agregar producto"
            />
          </div>
        </div>
      </div>
      <div class="q-gutter-md">
        <div
          class="q-col"
          v-for="(producto, index) in productosPaginados"
          :key="index"
          :class="{ 'q-mb-md': index % 2 === 0 }"
        >
          <card
            :imagen="producto.imagen"
            :titulo="producto.titulo"
            :descripcion="producto.descripcion"
            :precio="producto.precio"
          />
        </div>
      </div>
      <div class="q-pa-md">
        <q-pagination
          v-model="paginaActual"
          :min="1"
          :max="totalPaginas"
          :color="colorPaginacion"
          :size="sizePaginacion"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Card from '@/components/Card.vue'

export default {
  name: 'Productos',
  components: {
    Card
  },
  data() {
    return {
      search: '',
      categoria: null,
      productos: [
        {
          id: 1,
          imagen: 'https://source.unsplash.com/random/400x300',
          titulo: 'Producto 1',
          descripcion: 'Descripción del producto 1',
          precio: '$50.00'
        },
        {
          id: 2,
          imagen: 'https://source.unsplash.com/random/400x300',
          titulo: 'Producto 2',
          descripcion: 'Descripción del producto 2',
          precio: '$70.00'
        },
        {
          id: 3,
          imagen: 'https://source.unsplash.com/random/400x300',
          titulo: 'Producto 3',
          descripcion: 'Descripción del producto 3',
          precio: '$100.00'
        },
        {
          id: 4,
          imagen: 'https://source.unsplash.com/random/400x300',
          titulo: 'Producto 4',
          descripcion: 'Descripción del producto 4',
          precio: '$25.00'
        },
        {
          id: 5,
          imagen: 'https://source.unsplash.com/random/400x300',
          titulo: 'Producto 5',
          descripcion: 'Descripción del producto 5',
          precio: '$45.00'
        },
        {
