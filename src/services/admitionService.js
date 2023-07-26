import { httpAdmition } from "../utils/https";

class AdmitionService {
  searchPostulant = async (document) => {
    try {
      httpAdmition.defaults.headers["Authorization"] =
        "Bearer " + import.meta.env.VITE_APP_BASE_URL_API_ADMITION_TOKEN;
      let res = await httpAdmition.get(`get-postulante-pago/${document}/5`);
      // let res = await httpAdmition.get(`get-ingresante-pago/${document}/5`);
      // let res = await httpAdmition.get(`get-ingresante-pago/${document}/${anio}/${}`);

      console.log(res.status);
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

  getEntrantsPayMat = async (document) => {
    try {
      httpAdmition.defaults.headers["Authorization"] =
        "Bearer " + import.meta.env.VITE_APP_BASE_URL_API_ADMITION_TOKEN;
      let res = await httpAdmition.get(
        `get-ingresante-pago/${document}/2023/2`
      );

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
  getRegularPayMat = () => {};
}
export default AdmitionService;
