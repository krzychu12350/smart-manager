<template>
  <TransitionRoot as="template" :show="sidebarOpen">
    <Dialog
      as="div"
      class="fixed inset-0 flex z-40 md:hidden"
      @close="sidebarOpen = false"
    >
      <TransitionChild
        as="template"
        enter="transition-opacity ease-linear duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity ease-linear duration-300"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
      </TransitionChild>
      <TransitionChild
        as="template"
        enter="transition ease-in-out duration-300 transform"
        enter-from="-translate-x-full"
        enter-to="translate-x-0"
        leave="transition ease-in-out duration-300 transform"
        leave-from="translate-x-0"
        leave-to="-translate-x-full"
      >
        <div
          class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-indigo-700"
        >
          <TransitionChild
            as="template"
            enter="ease-in-out duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="ease-in-out duration-300"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <div class="absolute top-0 right-0 -mr-12 pt-2">
              <button
                type="button"
                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                @click="sidebarOpen = false"
              >
                <span class="sr-only">Close sidebar</span>
                <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
              </button>
            </div>
          </TransitionChild>
          <div
            class="text-white flex-shrink-0 flex items-center px-4 py-2 text-lg font-medium rounded-md"
          >
            <img class="h-8 w-auto" src="../assets/logo.png" alt="Smart Manager" />
            <h1 class="mx-4">Smart Manager</h1>
          </div>
          <div class="mt-5 flex-1 h-0 overflow-y-auto">
            <nav class="px-2 space-y-1">
              <div v-for="item in navigation" :key="item.name">
                <a
                  v-if="item.is_onwner_logged_in"
                  :href="item.href"
                  :class="[
                    item.current
                      ? 'bg-indigo-800 text-white'
                      : 'text-indigo-100 hover:bg-indigo-600',
                    'group flex items-center px-2 py-2 text-base font-medium rounded-md',
                  ]"
                  @click="setThisAsCurrent(item.name)"
                >
                  <component
                    :is="item.icon"
                    class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"
                    aria-hidden="true"
                  />
                  {{ item.name }}
                </a>
              </div>
            </nav>
          </div>
        </div>
      </TransitionChild>
      <div class="flex-shrink-0 w-14" aria-hidden="true"></div>
    </Dialog>
  </TransitionRoot>

  <!-- Static sidebar for desktop -->
  <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
    <div class="flex flex-col flex-grow pt-5 bg-indigo-700 overflow-y-auto">
      <div class="flex items-center flex-shrink-0 px-4">
        <RouterLink
          to="/"
          class="text-white group flex items-center px-2 py-2 text-lg font-medium rounded-md"
        >
          <img class="h-8 w-auto" src="../assets/logo.png" alt="Smart Manager" />
          <h1 class="mx-4">Smart Manager</h1>
        </RouterLink>
      </div>
      <div class="mt-5 flex-1 flex flex-col">
        <nav class="flex-1 px-2 pb-4 space-y-1">
          <div v-for="item in navigation" :key="item.name">
            <a
              v-if="item.is_onwner_logged_in"
              :class="[
                item.current
                  ? 'bg-indigo-800 text-white'
                  : 'text-indigo-100 hover:bg-indigo-600',
                'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
              ]"
              @click="emit('routerPush', { to: item.href, name: item.name })"
            >
              <component
                :is="item.icon"
                class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300"
                aria-hidden="true"
              />
              {{ item.name }}
            </a>
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, computed, reactive } from "vue";
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from "@headlessui/vue";
import {
  ChartBarIcon,
  HomeIcon,
  InboxIcon,
  UsersIcon,
  XMarkIcon,
} from "@heroicons/vue/24/outline";

import useEventsBus from "@/composables/eventBus";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";
const router = useRouter();

const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const isUserOwner = ref(userData.value.is_owner);

const navigation = ref([
  {
    name: "Dashboard",
    href: "/",
    icon: HomeIcon,
    current: true,
    is_onwner_logged_in: true,
  },
  {
    name: "Employees",
    href: "/admin/employees",
    icon: UsersIcon,
    current: false,
    is_onwner_logged_in: isUserOwner,
  },
  {
    name: "Applications",
    href: "/admin/applications",
    icon: InboxIcon,
    current: false,
    is_onwner_logged_in: true,
  },
  {
    name: "Reports",
    href: "/admin/reports",
    icon: ChartBarIcon,
    current: false,
    is_onwner_logged_in: isUserOwner,
  },
]);

const adults = computed(() => {
  return navigation.filter((item) => item.visible_for_owner === true);
});

const setThisAsCurrent = async (name) => {
  const currentTab = navigation.value.filter((item) => {
    item.current = false;
    return item.name === name;
  });

  currentTab[0].current = !currentTab[0].current;
};

const userNavigation = ref([
  { name: "Your Profile", href: "#" },
  { name: "Settings", href: "#" },
  { name: "Sign out", href: "/logout" },
]);

const sidebarOpen = ref(false);

const { emit, bus } = useEventsBus();

function showSidebar() {
  sidebarOpen.value = true;
}

watch(
  () => bus.value.get("showSidebar"),
  (val, open) => {
    showSidebar();
  }
);

watch(
  () => bus.value.get("routerPush"),
  async (to) => {
    router.push(to[0].to);
  }
);
</script>
