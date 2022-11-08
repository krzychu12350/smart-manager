<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
  <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-100">
    <body class="h-full">
    ```
  -->
  <div>
    <SidebarComponent />




    
    <div class="md:pl-64 flex flex-col flex-1">

      <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
        <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden" @click="sidebarOpen = true">
          <span class="sr-only">Open sidebar</span>
          <MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
        </button>
        <div class="flex-1 px-4 flex justify-between">
          <div class="flex-1 flex">
            <form class="w-full flex md:ml-0" action="#" method="GET">
              <label for="search-field" class="sr-only">Search</label>
              <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                  <SearchIcon class="h-5 w-5" aria-hidden="true" />
                </div>
                <input id="search-field" class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm" placeholder="Search" type="search" name="search" />
              </div>
            </form>
          </div>
        </div>
      </div>

      <main>
        <div class="py-6">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard, Hi {{ user.name }} {{ user.surname }}</h1>
          </div>
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
         
            <div class="py-4">
              <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
                {{ this.companies }}
              </div>
            </div>
          
          </div>
        </div>
      </main>
     
      <div class="flex items-center flex-row">
        <button @click="handleLogout" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-25 max-w-sm content-center">Logout</button>
        <button @click="retrieveSingleCompany(1)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-25 max-w-sm">Test Fetch</button>
      </div>
      
      <div>
        test user
        {{user}}
      </div>

    </div>
    
  </div>
</template>

<script>
/*
import {
  Dialog,
  DialogOverlay,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
*/
import {
 // BellIcon,
  CalendarIcon,
  ChartBarIcon,
  FolderIcon,
  HomeIcon,
  InboxIcon,
  //MenuAlt2Icon,
  UsersIcon,
  //XIcon,
} from '@heroicons/vue/24/outline'
//import { SearchIcon } from '@heroicons/vue/24/solid'

import SidebarComponent from '@/components/SidebarComponent.vue'

const navigation = [
  { name: 'Dashboard', href: '#', icon: HomeIcon, current: true },
  { name: 'Team', href: '#', icon: UsersIcon, current: false },
  { name: 'Projects', href: '#', icon: FolderIcon, current: false },
  { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
  { name: 'Documents', href: '#', icon: InboxIcon, current: false },
  { name: 'Reports', href: '#', icon: ChartBarIcon, current: false },
]
const userNavigation = [
  { name: 'Your Profile', href: '#' },
  { name: 'Settings', href: '#' },
  { name: 'Sign out', href: '#' },
]
import ComapnyDataService from "../services/ComapnyDataService";
import { useRouter } from "vue-router";

import { useErrorStore } from "../stores/useError";
import { ref, onBeforeUnmount } from "vue";
import router from '../router';

import { storeToRefs } from 'pinia';
import { useAuthStore } from "../stores/useAuth";



export default {
  components: {
    SidebarComponent,
    /*
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
    BellIcon,
    */
    //MenuAlt2Icon,
    //SearchIcon,
   // XIcon,
  },
  setup() {
    const sidebarOpen = ref(false)
    const loading = ref(false);


    const userStore = useAuthStore();
    const {user} = storeToRefs(userStore);

    //const user = userStore.user;
    return {
      navigation,
      userNavigation,
      sidebarOpen,
      loading,
      user
    }
  },
  data() {
    return {
      companies: [],
      loading: false,
    };
  },
  mounted() {
    this.retrieveCompanies()
    //console.log("testtt");
    const userStore = useAuthStore()
    console.log(userStore.user)

    //alert('geegge');
  },
  methods: {
    retrieveCompanies() {
      ComapnyDataService.getAll()
        .then(response => {
          this.companies = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },
    handleLogout() {
      //alert('wffww')
      
      //loading.value = !loading.value;
      useAuthStore()
        .logout()
        .then(() => this.$router.push("/login"))
        //.catch(() => (loading.value = !loading.value));
        
    },
    retrieveSingleCompany(id) {
      ComapnyDataService.get(id)
        .then(response => {
          this.companies = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
}
</script>