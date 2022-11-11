import api from "./api";

class EmployeeDataService {
  getAll() {
    return api.get("/employees");
  }

  get(id) {
    return api.get(`/employees/${id}`);
  }

  create(data) {
    return api.post("/employees", data);
  }

  update(id, data) {
    return api.put(`/employees/${id}`, data);
  }

  delete(id) {
    return api.delete(`/employees/${id}`);
  }

  deleteAll() {
    return api.delete(`/employees`);
  }

  findByTitle(title) {
    return api.get(`/employees?title=${title}`);
  }
}

export default new EmployeeDataService();
