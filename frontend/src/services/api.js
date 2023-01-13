import axios from "axios";
import { useAuthStore } from '../stores/useAuth'

const instance = axios.create({
    //baseURL: "https://slow-chicken-divide-37-225-90-16.loca.lt/api",
    //baseURL: "https://eb8d-176-221-121-81.eu.ngrok.io/api",
    //baseURL: "https://8573-176-221-121-81.eu.ngrok.io/api",
    baseURL: "http://localhost:8000/api",
    headers: {
       "Content-Type": "application/json",
       "Access-Control-Allow-Private-Network": "true",
        "ngrok-skip-browser-warning": "69420",
        //"User-Agent": "Mozilaa"   

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
