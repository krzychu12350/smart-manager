import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPersist from 'pinia-plugin-persist'
const pinia = createPinia()
pinia.use(piniaPersist)

import App from './App.vue'
import router from './router'

import './assets/main.css'

import axios from 'axios'
import VueAxios from 'vue-axios'


import setupInterceptors from './services/setupInterceptors';

setupInterceptors();
//import setup from './plugins/axios'
//setup();
//import auth from './plugins/auth'
const app = createApp(App)
//import './services/axios'

app.use(pinia)
//app.use(auth)
app.use(router)
app.use(VueAxios, axios)
app.mount('#app')
