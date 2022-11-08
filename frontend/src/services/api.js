import axios from "axios";
import { useAuthStore } from '../stores/useAuth'

const instance = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
        "Content-Type": "application/json",
    },
});
/*
instance.interceptors.request.use((request) => {
    const userStore = useAuthStore()
    console.log(userStore)
    request.headers.Authorization = userStore.user.access_token
    console.log('Adding token to header', userStore.user.access_token)
  })

*/



export default instance;
