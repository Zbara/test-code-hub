import axiosClient from "@/core/axios-client.js";
class AuthService {
    login(user) {
        return axiosClient
            .post('/api/login', {
                email: user.email,
                password: user.password
            })
            .then(response => {
                if (response.data.access_token) {
                    localStorage.setItem('token-admin', JSON.stringify(response.data));
                }
                return response.data;
            }).catch((e) => {
                return Promise.reject(e.response.data);
            });
    }

    getSession() {
        return axiosClient
            .get(`/api/getSession`)
            .then(response => {
                return response.data;
            });
    }
    logout() {
        localStorage.removeItem('token-admin');
    }
}
export default new AuthService();
