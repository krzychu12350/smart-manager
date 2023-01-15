import axios from "axios";

const API_URL="http://localhost:8000";

const instance = axios.create({
    baseURL: API_URL + "/api",
    headers: {
       "Content-Type": "application/json",
       "Access-Control-Allow-Private-Network": "true",
        "ngrok-skip-browser-warning": "69420",
    },
});

export default instance;
