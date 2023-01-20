import api from "./api";

class UserAuthService {
    async login(user) {
        const response = await api.post('/auth/login', {
            email: user.email,
            password: user.password
        });
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
            password_confirmation: user.password_confirmation,
            is_owner: user.is_owner,
        });
    }

    async userProfile() {
        const response = await api.get('/auth/me');
        return response.data.user;
    }

    async sendPasswordResetEmail(email) {
        return api.post('/auth/reset-password-request', {
            email: email.email
        });
    }

    async passwordResetUpdate(updatePasswordData, token) {
        const response = await api.post('/auth/change-password', {
            email: updatePasswordData.email,
            token: token,
            password: updatePasswordData.password,
            password_confirmation: updatePasswordData.password_confirmation
        });
        return response.data;
    }
}

export default new UserAuthService();
