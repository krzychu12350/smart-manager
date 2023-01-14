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

  getAllCompanyEmployees(id, page) {
    return api.get(`/companies/${id}/users?page=` + page);
  }

  addUserForTheCompany(companyId, userId) {
    return api.put(`/companies/${companyId}/users/${userId}`);
  }

  removeUserFromTheCompany(companyId, userId) {
    return api.delete(`/companies/${companyId}/users/${userId}`);
  }
}

export default new CompanyDataService();
