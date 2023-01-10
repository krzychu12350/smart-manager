import axios from "axios";
import { useAuthStore } from '../stores/useAuth'

const instance = axios.create({
    //baseURL: "https://slow-chicken-divide-37-225-90-16.loca.lt/api",
    //baseURL: "http://4.tcp.eu.ngrok.io:10840/api",
    baseURL: "http://localhost:8000/api",
    headers: {
       "Content-Type": "application/json",
       "Access-Control-Allow-Private-Network": "true",
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
