import axiosInstance from "./api";
import TokenService from "./TokenService";

const setup = () => {
    axiosInstance.interceptors.request.use(
        (config) => {
            const token = localStorage.getItem("token");
            //const userStore = useAuthStore()
            //console.log(userStore)
            if (token) {
                config.headers["Authorization"] = 'Bearer ' + token;
            }
            return config;
        },
        (error) => {
            return Promise.reject(error);
        }
    );
    axiosInstance.interceptors.response.use(
        (res) => {
            return res;
        },
        async (err) => {
            const originalConfig = err.config;
            if (originalConfig.url !== "/logout" && err.response) {
                // Access Token was expired
                if (err.response.status === 401 && !originalConfig._retry) {
                    originalConfig._retry = true;
                    try {
                        const rs = await axiosInstance.post("/auth/refresh", {
                            refreshToken: TokenService.getLocalRefreshToken(),
                        });
                        const {access_token} = rs.data.authorization;
                        //store.dispatch('auth/refreshToken', accessToken);
                        TokenService.updateLocalAccessToken(access_token);
                        return axiosInstance(originalConfig);
                    } catch (_error) {
                        return Promise.reject(_error);
                    }
                }
            }
            return Promise.reject(err);
        }
    );
};
export default setup;
