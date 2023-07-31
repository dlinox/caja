<template>
  <v-card
    :loading="postulantLoading"
    class="mx-auto mb-5 border"
    style="width: 500px"
  >
    <v-toolbar class="bg-blue-darken-4">
      <v-tabs v-model="typeMat">
        <v-tab value="entrants"> Ingresantes </v-tab>
        <v-tab value="regular" disabled> Regulares </v-tab>
      </v-tabs>
    </v-toolbar>
    <v-container>
<<<<<<< HEAD
      <v-form ref="formSearch" @submit.prevent="searchPostulant">
=======
      <v-form ref="formSearch" @submit.prevent="searchIngresante">
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
        <div class="text-subtitle-1 mb-1">Buscar / DNI</div>
        <v-text-field
          v-model="search"
          density="compact"
          placeholder="Buscar"
          hide-details="auto"
          variant="outlined"
          :rules="rules"
          counter
          maxlength="8"
          ref="inputSearch"
          :disabled="form.person ? true : false"
        />

        <template v-if="form.person">
          <v-btn
            class="mt-1"
            color="red"
            block
            type="button"
            :loading="postulantLoading"
            @click="restForm()"
          >
            CANCELAR / TERMINATAR <small class="ms-2">[ESC]</small>
          </v-btn>
        </template>

        <template v-else>
          <v-btn
            class="mt-1"
            color="blue"
            block
            type="submit"
            :loading="postulantLoading"
          >
            Buscar postulante <small class="ms-2">[ENTER]</small>
          </v-btn>
        </template>
      </v-form>
    </v-container>
  </v-card>

<<<<<<< HEAD
  <v-row v-if="form.person" justify="center">
    <!-- <v-col cols="12" md="5">
      <v-card class="border">
        <v-card-title>Conceptos de pago </v-card-title>
        <v-divider></v-divider>

        <v-list-item
          density="compact"
          v-for="(item, index) in conceptItems"
          :key="index"
          :title="item.title"
        >
          <v-switch
            v-if="item.options"
            v-for="option in item.options"
            :value="option.price"
            density="compact"
            color="black"
            hide-details
            class="px-7 text-black font-weight-bold"
            v-model="item.price"
            :label="option.title"
            :readonly="item.price === option.price"
          ></v-switch>
          <template v-slot:append>
            <v-switch
              :value="item"
              v-model="form.details"
              inset
              @update:modelValue="validateDetails()"
              hide-details
              color="blue"
            ></v-switch>
          </template>
        </v-list-item>
      </v-card>
    </v-col> -->
    <v-col cols="12" md="7">
      <v-card class="border">
        <v-card-title class="font-weight-bold">
          <small>
            {{
              `${form.person.nro_documento} | ${form.person.nombres}  ${form.person.primer_apellido}  ${form.person.segundo_apellido}`
            }}
          </small>
=======
  <v-row v-if="form.person">
    <v-col cols="12" md="8" class="mx-auto">
      <v-card class="border">
        <v-card-title class="font-weight-bold">
          {{
            `${form.person.nro_documento} | ${form.person.nombres}  ${form.person.primer_apellido}  ${form.person.segundo_apellido}`
          }}
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
        </v-card-title>
        <v-divider></v-divider>

        <v-card-item>
          <v-list-item v-for="(item, index) in form.details" :key="index">
            <v-list-item-title class="text-h5">
              {{ item.title }}
            </v-list-item-title>
            <v-list-item-subtitle class="text-h6">
              <v-chip class="ma-2 text-blue-darken-5" size="x-large" label>
<<<<<<< HEAD
                <strong> {{ "S/. " + item.price }}</strong>
              </v-chip>
            </v-list-item-subtitle>
            <template v-slot:append>
              <template v-if="item.hasPrint">
                <v-btn
                  block
                  variant="flat"
                  color="orange"
                  @click="printPDF(item, index)"
                >
                  imprimir
                </v-btn>
              </template>
              <template v-else>
                <v-btn
                  block
                  variant="flat"
                  color="success"
                  @click="savePay(item, index)"
                >
                  Pagar
                </v-btn>
              </template>
              <!-- <v-chip class="ma-2" size="x-large" label>
                <strong> {{ "S/. " + item.price }}</strong>
              </v-chip> -->
            </template>
            <v-divider v-if="index === 0" class="mt-4"></v-divider>
          </v-list-item>

          <!-- <v-divider></v-divider> -->
          <!-- <v-list-item>
            <v-list-item-subtitle class="text-end me-4">
              <strong>Total a pagar</strong>
            </v-list-item-subtitle>

            <v-list-item-title class="text-end me-4 text-red">
              <strong>{{ detalleError }}</strong>
            </v-list-item-title>

            <template v-slot:append>
              <v-chip
                class="ma-2 text-h4"
                size="x-large"
                label
                :class="detalleError !== null ? 'text-red' : ''"
              >
                <strong
                  :class="detalleError !== null ? 'text-red' : 'text-blue'"
                >
                  {{ "S/. " + total }}</strong
=======
                <strong>
                  {{
                    "S/. " + Number.parseFloat(item.price).toFixed(2)
                  }}</strong
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
                >
              </v-chip>
            </v-list-item-subtitle>
            <template v-slot:append>
              <template v-if="item.hasPrint">
                <v-btn
                  block
                  variant="flat"
                  color="orange"
                  @click="printPDF(item, index)"
                >
                  imprimir
                </v-btn>
              </template>
              <template v-else>
                <v-btn
                  block
                  variant="flat"
                  color="success"
                  :loading="item.loading"
                  @click="savePay(item, index)"
                >
                  Pagar
                </v-btn>
              </template>
            </template>
<<<<<<< HEAD
          </v-list-item> -->
        </v-card-item>
        <v-divider></v-divider>
        <!-- <v-card-actions class="">
          <template v-if="hasPrint">
            <v-btn block variant="flat" color="orange" @click="printPDF">
              imprimir <small class="ms-3">[ ESPACIO + I]</small>
            </v-btn>
          </template>
          <template v-else>
            <v-btn block variant="flat" color="success" @click="savePay">
              Pagar <small class="ms-3">[ ESPACIO + P ]</small>
            </v-btn>
          </template>
        </v-card-actions> -->
=======
            <v-divider v-if="index === 0" class="mt-4"></v-divider>
          </v-list-item>
        </v-card-item>
        <v-divider></v-divider>
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
      </v-card>
    </v-col>
  </v-row>
  <v-snackbar multiline v-model="snakbar.show" :color="snakbar.type">
    <h4>
      <strong>
        {{ snakbar.title }}
      </strong>
    </h4>
    <p>{{ snakbar.text }}</p>

    <template v-slot:actions>
      <v-btn @click="snakbar.show = false"> x </v-btn>
    </template>
  </v-snackbar>
</template>
<script setup>
import { ref, watch } from "vue";
import { AdmitionService, PayService } from "../services/";
import { useMagicKeys } from "@vueuse/core";

const { escape, space, p, i } = useMagicKeys();

const admitionService = new AdmitionService();
const payService = new PayService();

const emit = defineEmits(["onSuccess"]);

const typeMat = ref("entrants");

const formSearch = ref(null);
const inputSearch = ref(null);

const search = ref("72735152");

const rules = ref([
  (value) => {
    if (value) return true;
    return "Ingrese el DNI.";
  },
]);

const snakbar = ref({
  show: false,
  title: null,
  text: null,
  type: null,
});

const postulant = ref(null);
const postulantLoading = ref(false);

const conceptItems = ref([
  {
<<<<<<< HEAD
    value: "0075",
=======
    value: "0091",
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
    title: "Matricula",
    price: 75.0,
  },
  {
<<<<<<< HEAD
    value: "0219",
=======
    value: "0225",
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
    title: "Carné Universitario",
    price: 11.5,
  },
]);

//tarifas carne : 0091, 0225

const form = ref({
  // code: "",
  person: postulant.value,
  details: [],
});

watch(escape, (val) => {
  if (val) {
    restForm();
  }
});

const restForm = () => {
  form.value.person = null;
  form.value.details = [];

  search.value = null;
  inputSearch.value.focus();
};

<<<<<<< HEAD
const payPrint = ref(null);

const hasPrint = ref(false);

=======
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
const urlBase = import.meta.env.VITE_APP_BASE_URL;

const urlPrint = ref(null);

const printPDF = (item) => {
  urlPrint.value = urlBase + "php/pdf_papeleta.php?id=" + item.payPrint.idpadre;
<<<<<<< HEAD

  window.open(urlPrint.value);
};

const detalleError = ref(null);

const validateDetails = async () => {
  if (form.value.details.length < 1) {
    detalleError.value = "Seleccion al menos un concepto.";
    return false;
  } else {
    detalleError.value = null;
    return true;
  }
};

const searchPostulant = async () => {
=======
  window.open(urlPrint.value);
};

const searchIngresante = async () => {
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
  postulantLoading.value = true;

  const { valid } = await formSearch.value.validate();
  if (!valid) {
    snakbar.value.show = true;
    snakbar.value.title = "Error";
    snakbar.value.text = "Ingrese un DNI valido (8 digitos )";
    snakbar.value.type = "red";
    postulantLoading.value = false;
    return;
  }
  let res = await admitionService.getEntrantsPayMat(search.value);

  if (res.ok) {
    if (res.status) {
      form.value.person = null;
      form.value.details = [];
      form.value.person = res.data;

      conceptItems.value.forEach((item) => {
        form.value.details.push(item);
      });
    } else {
      snakbar.value.show = true;
      snakbar.value.title = "Datos incorrectos";
      snakbar.value.text = res.message;
      snakbar.value.type = "red";
    }
  } else {
    snakbar.value.show = true;
    snakbar.value.title = "Error:";
    snakbar.value.text = "(a)  Error Desconocido";
    snakbar.value.type = "red";
  }
  postulantLoading.value = false;
};

const savePay = async (item, index) => {
<<<<<<< HEAD
  payPrint.value = null;

  //   let validDetails = await validateDetails();
  //   if (!validDetails) {
  //     snakbar.value.show = true;
  //     snakbar.value.title = "Error";
  //     snakbar.value.text = "Seleccion al menos un concepto de pago";
  //     snakbar.value.type = "red";
  //     return;
  //   }

  let data = {
    details: [item],
    person: form.value.person,
  };

  let res = await payService.savePayMat(data);

  if (res.success) {
    // form.value.person = res.data;

=======
  let data = {
    details: [item],
    person: form.value.person,
  };

  let res = await payService.savePayMat(data);

  if (res.success) {
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
    form.value.details[index].hasPrint = true;
    form.value.details[index].payPrint = res.data;

    snakbar.value.show = true;
    snakbar.value.title = "Exito.";
    snakbar.value.text = res.message;
    snakbar.value.type = "green";
    // payPrint.value = res.data;
    hasPrint.value = true;
  } else {
    snakbar.value.show = true;
    snakbar.value.title = "Ocurrion un error";
    snakbar.value.text = res.message;
    snakbar.value.type = "red";
  }
};
</script>
