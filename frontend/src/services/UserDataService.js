import api from "./api";

class UserDataService {
  async getAll() {
    return api.get("/users");
  }

  async get(id) {
    return api.get(`/users/${id}`);
  }

  async create(data) {
    return api.post("/users", data);
  }

  async update(id, data) {
    return api.put(`/users/${id}`, data);
  }

  async delete(id) {
    return api.delete(`/users/${id}`);
  }

  async deleteAll() {
    return api.delete(`/users`);
  }

  async findByTitle(title) {
    return api.get(`/users?title=${title}`);
  }
}

export default new UserDataService();
