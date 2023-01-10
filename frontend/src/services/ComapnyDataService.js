import api from "./api";

class CompanyDataService {
  getAll() {
    return api.get("/companies");
  }

  get(id) {
    return api.get(`/companies/${id}`);
  }

  create(data) {
    return api.post("/companies", data);
  }

  update(id, data) {
    return api.put(`/companies/${id}`, data);
  }

  delete(id) {
    return api.delete(`/companies/${id}`);
  }

  deleteAll() {
    return api.delete(`/companies`);
  }

  findByTitle(title) {
    return api.get(`/companies?title=${title}`);
  }
}

export default new CompanyDataService();
