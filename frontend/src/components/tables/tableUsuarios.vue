<template>
  <div class="q-pa-md">
    <q-table
      class="usersTable"
      :rows="users.users"
      :columns="columnsUsers"
      :filter="filter"
      :rows-per-page-options="[7, 12, 15, 25]"
      row-key="id"
      rows-per-page-label="Productos a Mostrar"
      no-data-label="No encontre nada para ti"
      no-results-label="El filtro no descubrió ningún resultado."
      flat
      dense
      bordered
      separator="cell"
    >
      <template v-slot:top="props">
        <div class="col-2 q-table__title text-white">Usuarios del Sistema</div>
        <q-space />
        <q-input
          rounded
          standout="bg-teal-3 text-white"
          dark
          dense
          input-class="text-right"
          debounce="300"
          color="teal-3"
          v-model="filter"
        >
          <template v-slot:append>
            <q-icon v-if="filter === ''" name="search" />
            <q-icon
              v-else
              name="clear"
              class="cursor-pointer"
              @click="filter = ''"
            />
          </template>
        </q-input>
        <q-btn
          flat
          unelevated
          fab-mini
          color="white"
          icon="add"
          type="submit"
          label="Agregar"
          @click="openAddDialog(props.row)"
          class="q-ml-md"
        />
        <q-btn
          flat
          round
          dense
          :icon="props.inFullscreen ? 'fullscreen_exit' : 'fullscreen'"
          @click="props.toggleFullscreen"
          class="q-ml-md"
        />
      </template>
      <template v-slot:body-cell-photo="props">
        <q-td :props="props">
          <q-img
            style="height: 50px; max-width: 50px"
            :ratio="1"
            :src="props.row.photo"
          />
        </q-td>
      </template>
      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <q-btn
            flat
            round
            dense
            color="accent"
            icon="visibility"
            @click="openViewDialog(props.row)"
          />
          <q-btn
            flat
            round
            dense
            color="primary"
            icon="edit"
            @click="openEditDialog(props.row)"
          />
          <q-btn
            flat
            round
            dense
            color="negative"
            icon="delete"
            @click="deleteUsers(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
    <!-- Añadir - Editar -->
    <q-dialog v-model="showDialogU" persistent>
      <q-card class="dialog addedit">
        <q-card-section>
          <q-form class="row justify-center q-gutter-lg">
            <q-input
              class="col-10"
              bottom-slots
              v-model="tempUsers.photo"
              label="Imagen"
            >
              <template v-slot:before>
                <q-avatar size="100px">
                  <q-img
                    :ratio="1"
                    v-if="tempUsers.photo"
                    :src="tempUsers.photo"
                  />
                </q-avatar>
              </template>
            </q-input>
            <q-input
              class="col-4"
              v-model="tempUsers.name"
              type="text"
              label="Usuario"
            />
            <q-input
              class="col-6"
              v-model="tempUsers.email"
              type="email"
              label="Correo Electronico"
            />
            <q-input
              class="col-5"
              type="password"
              label="Contraseña"
              v-model="tempUsers.password"
              v-if="AddU == true"
              required
            />
            <q-input
              class="col-5"
              type="password"
              label="Confirmar contraseña"
              v-model="tempUsers.password_confirmation"
              v-if="AddU == true"
              required
            />
            <div class="q-mt-md justify-center q-gutter-lg">
              <q-btn
                type="submit"
                label="Guardar"
                color="primary"
                v-if="EditU == true"
                @click="editUsers(tempUsers.id)"
              />
              <q-btn
                type="submit"
                label="Añadir"
                color="primary"
                v-if="AddU == true"
                @click="addUsers(tempUsers)"
              />
              <q-btn label="Cancelar" @click="showDialogU = false" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!-- Ver -->
    <q-dialog v-model="ViewU">
      <q-card class="my-cardroot">
        <q-card>
          <q-card-section align="center">
            <q-img
              style="height: 200px; max-width: 200px"
              :ratio="1"
              :src="tempUsers.photo"
              :alt="tempUsers.name"
            />
          </q-card-section>
          <q-card-section>
            <q-item-section class="text-h6 ellipsis">
              <q-item-label overline>ID:</q-item-label>
              <q-item-label>{{ tempUsers.id }}</q-item-label>
              <q-item-label overline>Usuario:</q-item-label>
              <q-item-label>{{ tempUsers.name }}</q-item-label>
              <q-item-label overline>Correo Electronico:</q-item-label>
              <q-item-label>{{ tempUsers.email }}</q-item-label>
            </q-item-section>
            <q-card-section>
              <q-item-section class="col text-h6 ellipsis">
                <q-item-label overline>Creado:</q-item-label>
                <q-item-label>{{ tempUsers.created_at }}</q-item-label>
                <q-item-label overline>Ultima Actualización:</q-item-label>
                <q-item-label>{{ tempUsers.updated_at }}</q-item-label>
              </q-item-section>
            </q-card-section>
          </q-card-section>
        </q-card>
      </q-card>
    </q-dialog>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { useUserStore } from "src/stores/Auth";
import { storeToRefs } from "pinia";

const { getAllUsers, addUsers, editUsers, deleteUsers } = useUserStore();
const { users, tempUsers, AddU, EditU, ViewU, showDialogU } = storeToRefs(
  useUserStore()
);

const filter = ref("");
const columnsUsers = [
  {
    name: "id",
    required: true,
    label: "Id",
    align: "center",
    field: (row) => row.id,
    sortable: true,
    autoWidth: true,
  },
  {
    name: "photo",
    label: "Imagen de Perfil",
    field: "photo",
    align: "center",
    autoWidth: true,
  },
  {
    name: "name",
    label: "Usuario",
    field: "name",
    align: "left",
    required: true,
    sortable: true,
    autoWidth: true,
  },
  {
    name: "email",
    align: "left",
    label: "Correo Electronico",
    field: "email",
    required: true,
    sortable: true,
    autoWidth: true,
  },
  { name: "actions", label: "Acciones", align: "center", autoWidth: true },
];

onMounted(async () => {
  await getAllUsers();
});

const openViewDialog = (row) => {
  tempUsers.value = { ...row };
  ViewU.value = true;
};
const openEditDialog = (row) => {
  tempUsers.value = { ...row };
  AddU.value = false;
  EditU.value = true;
  showDialogU.value = true;
};
const openAddDialog = () => {
  tempUsers.value = {};
  AddU.value = true;
  EditU.value = false;
  showDialogU.value = true;
};
</script>

<style lang="scss">
.usersTable {
  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th {
    background-color: #b9242a;
  }
  thead tr th {
    position: sticky;
    z-index: 1;
    &.q-table--loading thead tr:last-child th {
      top: 48px;
    }
  }
  &.q-table--loading thead tr:last-child th {
    top: 48px;
  }
  tbody {
    scroll-margin-top: 48px;
  }
}
.my-cardroot {
  width: 380px;
  padding: 1%;
}
.addedit {
  width: 550px;
  padding: 2%;
}
.q-badge {
  margin-right: 8px;
}
</style>
