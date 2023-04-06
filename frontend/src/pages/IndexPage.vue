<template>
  <div>
    <!-- Banner principal -->
    <div class="q-pa-md">
      <q-carousel
        class="bg-secondary shadow-20 shadow-transition"
        padding="padding"
        height="200px"
        animated
        v-model="slide"
        navigation
        infinite
        :autoplay="autoplay"
        arrows
        transition-prev="slide-right"
        transition-next="slide-left"
        @mouseenter="autoplay = false"
        @mouseleave="autoplay = true"
      >
        <!-- <q-carousel-slide name="1" class="column no-wrap flex-center">
          <q-icon name="cake" size="56px" />
          <div class="q-mt-md text-h4 text-center">
            Descubre nuestros increíbles productos y disfruta del envío gratuito
            en todos los pedidos.
          </div>
        </q-carousel-slide> -->
        <q-carousel-slide
          :name="1"
          img-src="~/assets/azucar-leche-huevo.webp"
        />
        <q-carousel-slide
          :name="2"
          img-src="~/assets/ChocolateCakeForTwo_Featured.jpg"
        />
        <q-carousel-slide :name="3" img-src="~/assets/dulces_finos.jpg" />
        <q-carousel-slide :name="4" img-src="~/assets/panes_dulces.jpg" />
        <template v-slot:control>
          <q-carousel-control
            position="top"
            :offset="[16, 8]"
            class="text-primary text-subtitle1 text-center rounded-borders"
            style="background: rgba(255, 255, 255, 0.5); padding: 4px 8px"
          >
            Descubre nuestros increíbles productos y disfruta del envío gratuito
            en todos los pedidos.
          </q-carousel-control>
        </template>
      </q-carousel>
    </div>

    <!-- Qtab -->
    <div class="q-pa-md" align="center">
      <div style="max-width: 1200px">
        <q-tabs v-model="tab" align="justify" narrow-indicator class="q-mb-lg">
          <q-tab
            class="text-purple"
            name="productosdestacados"
            label="Productos destacados"
          />
          <q-tab
            class="text-orange"
            name="promotions"
            label="Promociones y descuentos"
          />
          <q-tab
            class="text-teal"
            name="testimonials"
            label="Testimonios de clientes satisfechos"
          />
        </q-tabs>

        <div class="q-gutter-y-sm">
          <q-tab-panels
            v-model="tab"
            animated
            infinite
            swipeable
            transition-prev="scale"
            transition-next="scale"
            class="text-white text-center"
          >
            <!-- Sección de productos destacados -->
            <q-tab-panel
              name="productosdestacados"
              class="bg-purple text-white text-center row q-gutter-md justify-evenly"
            >
              <div class="text-h4 col-12">Productos Destacados</div>
              <!-- +++++++++++++++++++++++++ -->
              <div
                class="featuredcard"
                v-for="(featured, index) in featureds"
                :key="index"
              >
                <q-card
                  @mouseover="hoveredCard = featured.id"
                  @mouseleave="hoveredCard = null"
                  :class="{ 'shadow-2': hoveredCard === featured.id }"
                >
                  <q-img
                    class="featuredcardimg"
                    :ratio="16 / 9"
                    fit="cover"
                    :src="featured.image"
                    :alt="featured.name"
                  />

                  <q-badge
                    class="q-badge"
                    v-if="featured.discount"
                    color="positive"
                    floating
                    transparent
                  >
                    {{ featured.discount }}%
                  </q-badge>

                  <q-badge
                    class="q-badge"
                    v-else
                    color="negative"
                    floating
                    transparent
                    label="Agotado"
                  />
                  <q-card-section>
                    <q-btn
                      fab
                      color="primary"
                      icon="shopping_bag"
                      class="absolute"
                      style="top: 0; right: 12px; transform: translateY(-50%)"
                      @click="buyItem(featured)"
                    />
                    <div class="row no-wrap items-center">
                      <q-item-label
                        header=""
                        class="col text-h6 text-left ellipsis text-purple q-pt-none"
                      >
                        {{ featured.name }}
                      </q-item-label>
                      <div
                        class="col-auto text-grey text-caption row no-wrap items-center"
                      >
                        Comprar
                      </div>
                    </div>
                    <q-rating
                      self-end
                      v-model="featured.rating"
                      icon="star_border"
                      icon-selected="star"
                      :max="5"
                      size="1.5em"
                      v-if="featured.rating"
                      readonly="true"
                    />
                  </q-card-section>
                  <q-card-section class="q-pt-none">
                    <div class="text-subtitle1 text-right text-dark">
                      $ {{ featured.price }}
                    </div>
                    <div class="text-caption text-grey">
                      {{ featured.description }}
                    </div>
                  </q-card-section>
                  <q-separator />
                  <q-card-actions
                    vertical
                    align="center"
                    class="q-pa-none q-ma-xs"
                  >
                    <q-btn
                      stretch
                      flat
                      icon="shopping_cart"
                      color="primary"
                      label="Agregar al carrito"
                      @click="addToCart(featured)"
                    />
                  </q-card-actions>
                </q-card>
              </div>
            </q-tab-panel>
            <!-- Sección de promociones y descuentos -->
            <q-tab-panel
              name="promotions"
              class="bg-orange text-white text-center row q-gutter-md justify-evenly"
            >
              <div class="text-h4 col-12">Promociones y Descuentos</div>
              <!-- ================================== -->
              <q-card
                class="promocion"
                flat
                bordered
                v-for="(promotion, index) in promotions"
                :key="index"
              >
                <q-item class="q-pa-md">
                  <q-item-section
                    side
                    class="text-orange text-weight-bolder text-subtitle1"
                  >
                    {{ promotion.title }}
                  </q-item-section>
                  <q-item-section>
                    <q-badge color="red" floating transparent>
                      <q-item-label class="discount text-weight-bold">
                        <!-- {{ promotion.discount }}% de descuento -->
                        {{ promotion.discount }}% de descuento
                      </q-item-label>
                    </q-badge>
                    <q-item-label caption>
                      <q-chip
                        dense
                        outline
                        size="15px"
                        class="glossy"
                        color="orange"
                        text-color="dark"
                        icon="event"
                      >
                        <q-item-label caption class="text-dark">
                          Válido hasta {{ promotion.expires }}
                        </q-item-label>
                      </q-chip>
                    </q-item-label>
                  </q-item-section>
                </q-item>
                <q-separator />
                <q-card-section horizontal>
                  <q-card-section class="text-subtitle1 text-dark">
                    {{ promotion.description }}
                  </q-card-section>
                  <q-separator vertical />
                  <q-card-section class="col-8 self-center no-padding">
                    <q-img
                      :ratio="4 / 3"
                      fit="cover"
                      :src="promotion.image"
                      :alt="promotion.title"
                    />
                  </q-card-section>
                </q-card-section>
              </q-card>
            </q-tab-panel>
            <!-- Testimonios de clientes satisfechos -->
            <q-tab-panel
              name="testimonials"
              class="bg-teal text-white text-center row q-gutter-md justify-evenly"
            >
              <div class="text-h4 col-12">
                Testimonios de Clientes Satisfechos
              </div>

              <q-card
                class="testimonial-card text-dark col-4"
                v-for="(testimonial, id) in testimonials"
                :key="id"
              >
                <q-item>
                  <q-item-section avatar>
                    <q-avatar>
                      <img :src="testimonial.avatar" />
                    </q-avatar>
                  </q-item-section>
                  <q-item-section side class="text-weight-bold">
                    {{ testimonial.name }}
                  </q-item-section>
                  <div>
                    <q-badge color="transparent" floating outline>
                      <q-rating
                        class="testimonial-rating"
                        v-model="testimonial.rating"
                        readonly
                        size="1.6em"
                        icon="thumb_up"
                    /></q-badge>
                  </div>
                </q-item>
                <q-separator inset />
                <q-card-section class="q-pt-none">
                  {{ testimonial.text }}
                </q-card-section>
              </q-card>
            </q-tab-panel>
          </q-tab-panels>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { api } from "src/boot/axios";
import { ref, onMounted } from "vue";

onMounted(async () => {
  await getFeatureds();
});
onMounted(async () => {
  await getPromotions();
});
onMounted(async () => {
  await getTestimonials();
});

const hoveredCard = ref(null);
const slide = ref(1);
const autoplay = ref(true);

const featureds = ref([]);
const promotions = ref([]);
const testimonials = ref([]);

const getFeatureds = async () => {
  const { data } = await api.get("/api/featureds");
  featureds.value = data;
};
const getPromotions = async () => {
  const { data } = await api.get("/api/promotions");
  promotions.value = data;
};
const getTestimonials = async () => {
  const { data } = await api.get("/api/testimonials");
  testimonials.value = data;
};

const tab = ref("promotions");

function addToCart(product) {
  console.log(`Agregado al carrito: ${(product.id, product.name)}`);
}
function buyItem(product) {
  console.log(`Comprado: ${(product.id, product.name)}`);
}
</script>

<style scoped lang="scss">
.testimonial-card {
  width: 100%;
  max-width: 350px;
}
.promocion {
  width: 100%;
  max-width: 450px;
}
.featuredcard {
  width: 100%;
  max-width: 300px;
  transition: box-shadow 0.5s ease-in-out;
}
.shadow-2 {
  box-shadow: 0px 0px 10px 5px #00000033;
  transform: translateY(-5px);
}
.testimonial-rating {
  margin-right: 5px;
  transform: translateY(5px);
}
</style>
