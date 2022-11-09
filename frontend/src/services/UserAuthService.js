import axios from "../plugins/axios";
import api from "./api";
import TokenService from "./TokenService";

class UserAuthService {
    async login(user) {
        const response = await api.post('/auth/login', {
            email: user.email,
            password: user.password
        });
        if (response.data.authorization.access_token)
            //TokenService.setUser(response.data);
            console.log(response.data.authorization.access_token)
        return response.data;
    }

    async logout() {
        const response = await api.post('/auth/logout');
        return response.data;
    }

    async register(user) {
        return api.post('/auth/register', {
            name: user.name,
            surname: user.surname,
            email: user.email,
            password: user.password,
            //password_confirmation: user.password_confirmation
        });
    }

    async userProfile() {
        const response = await api.get('/auth/me');
        return response.data.user;
    }
}

export default new UserAuthService();
