import { useErrorStore } from "../stores/useError";
import router from "../router";
import axios from "axios";

axios.defaults.baseURL = "http://localhost:8000/api";
axios.defaults.headers.common["Authorization"] = localStorage.getItem("token");
//axios.defaults.withCredentials = true;
const setup = () => {
  // Add a request interceptor
  axios.interceptors.request.use(
    function (config) {
      // Do something before request is sent

      useErrorStore().$reset();

      return config;
    },
    function (error) {
      // Do something with request error
      return Promise.reject(error);
    }
  );

  axios.interceptors.response.use(
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


  axios.interceptors.request.use(
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

  // Add a response interceptor
  axios.interceptors.response.use(
    function (response) {
      // Any status code that lie within the range of 2xx cause this function to trigger
      // Do something with response data
      return response;
    },
    function (error) {
      // Any status codes that falls outside the range of 2xx cause this function to trigger
      // Do something with response error
      switch (error.response.status) {
        case 401:
          //localStorage.removeItem("token");
          window.location.reload();
          break;
        case 403:
        case 404:
          router.push({
            name: "error",
            props: {
              error: {
                message: error.response.data.message,
                status: error.status,
              },
            },
          });
          break;
        case 422:
          useErrorStore().$state = error.response.data;
          break;
        default:
          console.log(error.response.data);
      }

      return Promise.reject(error);
    }
  );
};

export default setup;