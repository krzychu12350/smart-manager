import api from "./api";

class ApplicationDataService {
  getAll(id, page) {
    return api.get(`/companies/${id}/applications`);
  }
  create(data) {
    return api.post("/applications", data);
  }
  update(id, data) {
    return api.put(`/applications/${id}`, data);
  }
  delete(id) {
    return api.delete(`/applications/${id}`);
  }
}

export default new ApplicationDataService();
