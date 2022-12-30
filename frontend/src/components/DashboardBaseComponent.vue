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
      <TopBarComponent></TopBarComponent>

      <main>
        <div class="py-6">
          <div class="max-w-12xl mx-auto px-4 sm:px-6 md:px-8">
            <slot name="subpage-header"></slot>
          </div>
          <div class="max-w-12xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-4">
              <slot name="subpage-content"></slot>
              <!--
              <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
                {{ this.companies }}
              </div>
              -->
            </div>
          </div>
        </div>
      </main>
      <!--
      <div class="flex items-center flex-row">
        <button
          @click="handleLogout"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-25 max-w-sm content-center"
        >
          Logout
        </button>
        <button
          @click="retrieveSingleCompany(1)"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-25 max-w-sm"
        >
          Test Fetch
        </button>
        <div>test user {{ user }}</div>
      </div>
        -->
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
  MagnifyingGlassIcon,
} from "@heroicons/vue/24/outline";

import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
//import { SearchIcon } from '@heroicons/vue/24/solid'

import SidebarComponent from "@/components/SidebarComponent.vue";
import TableComponent from "./employees/EmployeesTableComponent.vue";
import TopBarComponent from "./TopBarComponent.vue";

const navigation = [
  { name: "Dashboard", href: "#", icon: HomeIcon, current: true },
  { name: "Team", href: "#", icon: UsersIcon, current: false },
  { name: "Projects", href: "#", icon: FolderIcon, current: false },
  { name: "Calendar", href: "#", icon: CalendarIcon, current: false },
  { name: "Documents", href: "#", icon: InboxIcon, current: false },
  { name: "Reports", href: "#", icon: ChartBarIcon, current: false },
];
const userNavigation = [
  { name: "Your Profile", href: "#" },
  { name: "Settings", href: "#" },
  { name: "Sign out", href: "#" },
];
import ComapnyDataService from "../services/ComapnyDataService";
import { useRouter } from "vue-router";

import { useErrorStore } from "../stores/useError";
import { ref, onBeforeUnmount } from "vue";
import router from "../router";

import { storeToRefs } from "pinia";
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
    TableComponent,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    MagnifyingGlassIcon,
    TopBarComponent,
  },
  setup() {
    const sidebarOpen = ref(false);
    const loading = ref(false);

    const userStore = useAuthStore();
    const { user } = storeToRefs(userStore);

    //const user = userStore.user;
    return {
      navigation,
      userNavigation,
      sidebarOpen,
      loading,
      user,
    };
  },
  data() {
    return {
      companies: [],
      loading: false,
    };
  },
  mounted() {
    //this.retrieveCompanies();
    //console.log("testtt");
    const userStore = useAuthStore();
    //console.log(userStore.user);

    //alert('geegge');
  },
  methods: {
    retrieveCompanies() {
      ComapnyDataService.getAll()
        .then((response) => {
          this.companies = response.data;
          //console.log(response.data);
        })
        .catch((e) => {
          console.log(e);
        });
    },
    handleLogout() {
      //alert('wffww')

      //loading.value = !loading.value;
      useAuthStore()
        .logout()
        .then(() => this.$router.push("/login"));
      //.catch(() => (loading.value = !loading.value));
    },
    retrieveSingleCompany(id) {
      ComapnyDataService.get(id)
        .then((response) => {
          this.companies = response.data;
          console.log(response.data);
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
};
</script>
