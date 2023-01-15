<template>
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
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import {
  CalendarIcon,
  ChartBarIcon,
  FolderIcon,
  HomeIcon,
  InboxIcon,
  UsersIcon,
  MagnifyingGlassIcon,
} from "@heroicons/vue/24/outline";

import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
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

import { ref } from "vue";

import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";

export default {
  components: {
    SidebarComponent,
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
  methods: {
    retrieveCompanies() {
      ComapnyDataService.getAll()
        .then((response) => {
          this.companies = response.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    handleLogout() {
      useAuthStore()
        .logout()
        .then(() => this.$router.push("/login"));
    },
    retrieveSingleCompany(id) {
      ComapnyDataService.get(id)
        .then((response) => {
          this.companies = response.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
};
</script>
