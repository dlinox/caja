import { server } from "../utils/https";

export default class PayService {
  savePay = async (data) => {
    try {
      let formData = new FormData();
      formData.append("person", JSON.stringify(data.person));
      formData.append("details", JSON.stringify(data.details));
      let res = await server.post("papeleta/", formData);
      return res.data;
    } catch (error) {
      return res.data;
    }
  };

  savePayMat = async (data) => {
    try {
      let formData = new FormData();
      formData.append("person", JSON.stringify(data.person));
      formData.append("details", JSON.stringify(data.details));
      let res = await server.post("papeletamatricula/", formData);
      return res.data;
    } catch (error) {
      return res.data;
    }
  };
}
