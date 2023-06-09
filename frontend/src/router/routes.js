const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/IndexPage.vue") },
      {
        path: "pasteles",
        component: () => import("src/pages/ShopPage/PastelesShopPage.vue"),
      },
      {
        path: "flanes",
        component: () => import("src/pages/ShopPage/FlanesShopPage.vue"),
      },
      {
        path: "reposteria",
        component: () => import("src/pages/ShopPage/ReposteriaShopPage.vue"),
      },
      {
        path: "panaderia",
        component: () => import("src/pages/ShopPage/PanShopPage.vue"),
      },
      {
        path: "decoraciones",
        component: () => import("src/pages/ShopPage/DecoShopPage.vue"),
      },
      {
        path: "sobrenosotros",
        component: () => import("pages/SobreNosotrosPage.vue"),
      },
      {
        path: "preguntasfrecuentes",
        component: () => import("pages/PreguntasFrecuentesPage.vue"),
      },
      {
        path: "contacto",
        component: () => import("pages/ContactoPage.vue"),
      },
    ],
  },
  {
    path: "/",
    children: [
      { path: "login", component: () => import("pages/LoginPage.vue") },
    ],
  },
  {
    path: "/admin",
    component: () => import("layouts/AdminLayout.vue"),
    children: [
      {
        path: "dashboard",
        component: () => import("pages/Admin/DashboardPage.vue"),
      },
      {
        path: "test",
        component: () => import("pages/Admin/TestPage.vue"),
      },
      {
        path: "tablesdata",
        component: () => import("pages/Admin/TablesDataPage.vue"),
      },
      {
        path: "tablesproduct",
        component: () => import("pages/Admin/TablesProductCatPage.vue"),
      },
      {
        path: "tableusers",
        component: () => import("pages/Admin/TableUsersPage.vue"),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
