import { httpAdmition } from "../utils/https";

class AdmitionService {
  searchPostulant = async (document) => {
    try {
      httpAdmition.defaults.headers["Authorization"] =
        "Bearer " + import.meta.env.VITE_APP_BASE_URL_API_ADMITION_TOKEN;
      let res = await httpAdmition.get(`get-postulante-pago/${document}/5`);
<<<<<<< HEAD
      // let res = await httpAdmition.get(`get-ingresante-pago/${document}/5`);
      // let res = await httpAdmition.get(`get-ingresante-pago/${document}/${anio}/${}`);

      console.log(res.status);
=======
      // let res = await httpAdmition.get(`get-ingresante-pago/${document}/${anio}/${ciclo}`);
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
      return {
        ok: true,
        status: res.data.status,
        message: res.data.mensaje,
        data: res.data?.data,
      };
    } catch (error) {
      return {
        ok: false,
        status: false,
        message: error.response.data.mensaje,
        data: null,
      };
    }
  };

<<<<<<< HEAD
  getEntrantsPayMat = async (document) => {
    try {
      httpAdmition.defaults.headers["Authorization"] =
        "Bearer " + import.meta.env.VITE_APP_BASE_URL_API_ADMITION_TOKEN;
=======
  getEntrantsPayMat  = async (document) => {
    try {
      httpAdmition.defaults.headers["Authorization"] =
        "Bearer " + import.meta.env.VITE_APP_BASE_URL_API_ADMITION_TOKEN;

>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
      let res = await httpAdmition.get(
        `get-ingresante-pago/${document}/2023/2`
      );

<<<<<<< HEAD
=======
      console.log(res.data);
>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
      return {
        ok: true,
        status: res.data.status,
        message: res.data.mensaje,
        data: res.data?.data,
      };
    } catch (error) {
      return {
        ok: false,
        status: false,
        message: error.response.data.mensaje,
        data: null,
      };
    }
  };
<<<<<<< HEAD
=======

>>>>>>> 9304058633a81b8247d4762d5a6205506b02046e
  getRegularPayMat = () => {};
}
export default AdmitionService;
