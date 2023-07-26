<template>
  <v-app id="inspire">
    <v-app-bar app density="prominent" class="bg-blue-darken-4">
      <div class="pa-2">
        <img src="@/assets/logo.png" width="50" alt="" />
      </div>
      <v-toolbar-title>
        <small>CAJA - UNA PUNO</small>
      </v-toolbar-title>

      <v-chip label> Examen General 2023</v-chip>
      <v-spacer></v-spacer>
      <v-btn >
        <a :href="baseUrl" target="blank" class=" text-decoration-none text-white"> Ir a caja </a>
      </v-btn>
    </v-app-bar>

    <template v-if="!isLogged">
      <v-row>
        <v-col cols="12" class="text-center">
          <span class="text-sm"> No autorizado </span>
        </v-col>
        <v-col cols="12" class="text-center">
          <span class="text-h4"> Iniciar sesion </span>
        </v-col>
        <v-col cols="12" class="text-center">
          <a :href="baseUrl" target="blank"> - IR AL LOGIN - </a>
        </v-col>

        <v-col cols="12" class="text-center">
          Ya inicié sesion:
          <v-btn variant="tonal" @click="init">Actualizar</v-btn>
        </v-col>
      </v-row>
    </template>
    <template v-else>
      <v-main>
        <v-toolbar>
          <v-tabs v-model="tab">
            <v-tab value="ins"> Inscripciones </v-tab>
            <v-tab value="mat"> Matriculas </v-tab>
          </v-tabs>
        </v-toolbar>
        <v-container>
          <v-window v-model="tab">
            <v-window-item value="ins">
              <SearchPostulant />
            </v-window-item>
            <v-window-item value="mat" class="pa-0">  
              <FormMatricula />
            </v-window-item>
          </v-window>
        </v-container>
      </v-main>
    </template>
  </v-app>
</template>
<script setup>
import { ref } from "vue";
import SearchPostulant from "@/components/SearchPostulant.vue";
import FormMatricula from "@/components/FormMatricula.vue";
import { AuthService } from "./services/index";

const baseUrl = import.meta.env.VITE_APP_BASE_URL;

const tab = ref("ins");

const authService = new AuthService();
const isLogged = ref(true);
const mode = import.meta.env.VITE_APP_MODE;
const init = async () => {
  if (mode === "production") {
    let res = await authService.validateAuth();
    isLogged.value = res.success;
  }
};

init();
</script>

<style>
.app-wrapper {
  min-height: 100vh;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: azure;
}
</style>
