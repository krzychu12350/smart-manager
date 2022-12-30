import api from "./api";

class EmployeeDataService {
  async getAll(page) {
    return api.get("/employees?page=" + page);
  }

  async get(id) {
    return api.get(`/employees/${id}`);
  }

  async create(data) {
    return api.post("/employees", data);
  }

  async update(id, data) {
    return api.put(`/employees/${id}`, data);
  }

  async delete(id) {
    return api.delete(`/employees/${id}`);
  }

  async deleteAll() {
    return api.delete(`/employees`);
  }

  async findByTitle(title) {
    return api.get(`/employees?title=${title}`);
  }
}

export default new EmployeeDataService();
