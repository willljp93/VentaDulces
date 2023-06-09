import { defineStore } from "pinia";
import axios from "axios";
import { api } from "src/boot/axios";
import { Notify, Dialog, Cookies } from "quasar";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: null,
    cookies: {},
    token: null,

    users: [],
    tempUsers: [],
    showDialogU: false,
    EditU: false,
    AddU: false,
    ViewU: false,

    loginForm: {
      email: "",
      password: "",
    },
    registerForm: {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      photo: null,
    },
  }),

  actions: {
    async lookCookie() {
      return Cookies.has("laravel_session");
    },

    async getAllCookies() {
      this.cookies = Cookies.getAll();
    },

    async getUser() {
      try {
        const { data } = await axios.get("http://localhost:8000/api/user");
        this.user = data;
      } catch (error) {}
    },

    async submitLogin() {
      try {
        await api.post("http://localhost:8000/login", this.loginForm);
        this.router.push("/");
      } catch (error) {
        console.log("MI ERROR login: ", error);
      }
    },

    async submitRegister() {
      try {
        const formData = new FormData();
        formData.append("name", this.registerForm.email);
        formData.append("email", this.registerForm.email);
        formData.append("password", this.registerForm.password);
        formData.append("rol", "usuario");
        formData.append(
          "password_confirmation",
          this.registerForm.password_confirmation
        );
        formData.append("photo", this.registerForm.photo);

        const response = await api.post(
          "http://localhost:8000/register",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );

        if (response.status === 201) {
          Notify.create({
            color: "positive",
            message: "Usuario registrado exitosamente",
            position: "top",
            icon: "check",
          });
          this.router.push("/");
        }
      } catch (error) {
        console.log("MI ERROR Registro: ", error);
        Notify.create({
          color: "negative",
          message: "Error al registrar usuario",
          position: "top",
          icon: "report_problem",
        });
      }
    },

    // -----------------------------
    async getAllUsers() {
      try {
        const { data } = await axios.get("http://localhost:8000/api/users");
        this.users = data;
        console.log("Usuarios: ", data);
      } catch (error) {
        console.log("Error: ", error);
      }
    },
    async addUsers(data) {
      try {
        await api.post("http://localhost:8000/api/users", data);
        Notify.create({
          message: "Agregado con exito",
          icon: "check",
          color: "positive",
        });
        await this.getAllUsers();
        this.showDialogU = false;
      } catch (error) {
        Notify.create({
          message: "Error al agregar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async editUsers(id) {
      try {
        await api.patch(
          `http://localhost:8000/api/users/${id}`,
          this.tempUsers,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        Notify.create({
          message: "Editado con éxito",
          icon: "check",
          color: "positive",
        });
        await this.getAllUsers();
        this.showDialogU = false;
        this.tempUsers = [];
      } catch (error) {
        Notify.create({
          message: "Error al editar",
          icon: "times",
          color: "negative",
        });
      }
    },
    async deleteUsers(id) {
      try {
        Dialog.create({
          html: true,
          title: '<span class="text-red">Eliminar</span>',
          message: "Estas seguro que deseas eliminar la fila",
          cancel: { color: "positive" },
          ok: { color: "negative" },
          persistent: true,
        }).onOk(async () => {
          await api.delete(`http://localhost:8000/api/users/${id}`);
          Notify.create({
            message: "Eliminado con exito",
            icon: "check",
            color: "positive",
          });
          await this.getAllUsers();
        });
      } catch (error) {
        Notify.create({
          message: "Error al eliminar",
          icon: "times",
          color: "negative",
        });
      }
    },
    // -----------------------------
  },
});
