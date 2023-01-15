import { createApp } from 'vue'
import 'vue3-easy-data-table/dist/style.css';
import { createPinia } from 'pinia'
import piniaPersist from 'pinia-plugin-persist'
const pinia = createPinia()
pinia.use(piniaPersist)
import SmartTable from 'vuejs-smart-table'
import App from './App.vue'
import router from './router'
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
import './assets/main.css'
import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import axios from 'axios'
import VueAxios from 'vue-axios'
import setupInterceptors from './services/setupInterceptors';

setupInterceptors();

const app = createApp(App)

app.use(pinia).use(LoadingPlugin, {
    canCancel: false, // default false
    color: "#4338ca",
    loader: "spinner",
    width: 64,
    height: 64,
    backgroundColor: "#ffffff",
    opacity: 0.5,
    zIndex: 999,
}, {
    // slots
}).use(VueTailwindDatepicker).use(router).use(VueAxios, axios).use(SmartTable)
app.mount('#app')
