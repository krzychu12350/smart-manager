<template>
  <header class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
    <button
      type="button"
      class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
      @click="emit('showSidebar')"
    >
      <span class="sr-only">Open sidebar</span>
      <Bars3BottomRightIcon class="h-6 w-6" aria-hidden="true" />
    </button>
    <div class="flex-1 px-4 flex justify-between">
      <div class="flex-1 flex"></div>
      <div class="ml-4 flex items-center md:ml-6">
        <button
          type="button"
          class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          <span class="sr-only">View notifications</span>
        </button>

        <!-- Profile dropdown -->
        <Menu as="div" class="ml-3 relative">
          <div class="flex">
            <MenuButton
              class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              <span class="sr-only">Open user menu</span>

              <vue-avatar
                v-bind:username="userName"
                :size="40"
                border-radius="50%"
                :lighten="200"
              />
            </MenuButton>
            <div class="flex items-center mx-2">{{ userName }}</div>
          </div>
          <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
          >
            <MenuItems
              class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
              <MenuItem :key="1" v-slot="{ active }">
                <a
                  @click="this.$router.push('/admin/my-profile')"
                  :class="[
                    active ? 'bg-gray-100' : '',
                    'block px-4 py-2 text-sm text-gray-700',
                  ]"
                  >Your Profile</a
                >
              </MenuItem>

              <MenuItem :key="2" v-slot="{ active }">
                <a
                  @click="handleLogout"
                  :class="[
                    active ? 'bg-gray-100' : '',
                    'block px-4 py-2 text-sm text-gray-700',
                  ]"
                  >Sign out</a
                >
              </MenuItem>
            </MenuItems>
          </transition>
        </Menu>
      </div>
    </div>
  </header>
</template>
<script setup>
import { Bars3BottomRightIcon } from "@heroicons/vue/24/outline";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ref } from "vue";
import VueAvatar from "@webzlodimir/vue-avatar";
import "@webzlodimir/vue-avatar/dist/style.css";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";
import { useRouter } from "vue-router";
import useEventsBus from "@/composables/eventBus";

const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const router = useRouter();
const { emit } = useEventsBus();
const user = userData.value;
const userName = ref(user.user_name + " " + user.user_surname);

async function handleLogout() {
  useAuthStore()
    .logout()
    .then(() => router.push("/login"));
}
</script>
