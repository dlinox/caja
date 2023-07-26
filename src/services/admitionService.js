import { httpAdmition } from "../utils/https";

class AdmitionService {
  searchPostulant = async (document) => {
    try {
      httpAdmition.defaults.headers["Authorization"] =
        "Bearer " + import.meta.env.VITE_APP_BASE_URL_API_ADMITION_TOKEN;
      let res = await httpAdmition.get(
        `get-postulante-pago/${document}/2023/2`
      );
      // let res = await httpAdmition.get(`get-ingresante-pago/${document}/${anio}/${ciclo}`);
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
        message: error,
        data: null,
      };
    }
  };
}
export default AdmitionService;
