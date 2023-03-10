<template>
  <TransitionRoot as="template" :show="open" @after-leave="query = ''">
    <Dialog
      as="div"
      class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 md:p-20"
      @close="open = false"
    >
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <DialogOverlay
          class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity"
        />
      </TransitionChild>

      <TransitionChild
        as="div"
        enter="ease-out duration-300"
        enter-from="opacity-0 scale-95"
        enter-to="opacity-100 scale-100"
        leave="ease-in duration-200"
        leave-from="opacity-100 scale-100"
        leave-to="opacity-0 scale-95"
      >
        <Combobox
          as="div"
          class="mx-auto max-w-3xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all"
          v-slot="{ activeOption }"
          @update:modelValue="onSelect"
        >
          <div class="relative">
            <MagnifyingGlassIcon
              class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400"
              aria-hidden="true"
            />

            <ComboboxInput
              class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-sm text-gray-800 placeholder-gray-400 focus:ring-0"
              placeholder="Search..."
              @change="query = $event.target.value"
            />
          </div>
          <!--<button @click="toggleSearchBox()">Deactivate</button>-->
          <div
            v-if="query === '' || filteredPeople.length > 0"
            class="flex divide-x divide-gray-100"
          >
            <div
              :class="[
                'max-h-96 min-w-0 flex-auto scroll-py-4 overflow-y-auto px-6 py-4',
                activeOption && 'sm:h-96',
              ]"
            >
              <h2
                v-if="query === ''"
                class="mt-2 mb-4 text-xs font-semibold text-gray-500"
              >
                Recent searches
              </h2>
              <ComboboxOptions static hold class="-mx-2 text-sm text-gray-700">
                <ComboboxOption
                  v-for="person in query === ' ' ? recent : filteredPeople"
                  :key="person.id"
                  :value="person"
                  as="template"
                  v-slot="{ active }"
                >
                  <li
                    :class="[
                      'group flex cursor-default select-none items-center rounded-md p-2',
                      active && 'bg-gray-100 text-gray-900',
                    ]"
                  >
                    <vue-avatar
                      :username="person.name + person.surname"
                      :size="40"
                      border-radius="50%"
                      :lighten="200"
                    />
                    <span class="ml-3 flex-auto truncate"
                      >{{ person.name }} {{ person.surname }}</span
                    >
                    <ChevronRightIcon
                      v-if="active"
                      class="ml-3 h-5 w-5 flex-none text-gray-400"
                      aria-hidden="true"
                    />
                  </li>
                </ComboboxOption>
              </ComboboxOptions>
            </div>

            <div
              v-if="activeOption"
              class="hidden h-96 w-1/2 flex-none flex-col divide-y divide-gray-100 overflow-y-auto sm:flex"
            >
              <div class="flex-none p-6 text-center">
                <vue-avatar
                  :username="activeOption.name + activeOption.surname"
                  :size="40"
                  border-radius="50%"
                  :lighten="200"
                />

                <h2 class="mt-3 font-semibold text-gray-900">
                  {{ activeOption.name }} {{ activeOption.surname }}
                </h2>
                <p class="text-sm leading-6 text-gray-500">{{ activeOption.role }}</p>
              </div>
              <div class="flex flex-auto flex-col justify-between p-6">
                <dl class="grid grid-cols-1 gap-x-6 gap-y-3 text-sm text-gray-700">
                  <dt class="col-end-1 font-semibold text-gray-900">Position</dt>
                  <dd>{{ activeOption.position }}</dd>
                  <dt class="col-end-1 font-semibold text-gray-900">Salary</dt>
                  <dd class="truncate">
                    {{ activeOption.salary }}
                  </dd>
                  <dt class="col-end-1 font-semibold text-gray-900">Email</dt>
                  <dd class="truncate">
                    <a
                      :href="`mailto:${activeOption.email}`"
                      class="text-indigo-600 underline"
                    >
                      {{ activeOption.email }}
                    </a>
                  </dd>
                </dl>
                <button
                  type="button"
                  @click="emit('showEmployeeEvaluationForm', { employee: activeOption })"
                  class="mt-6 w-full rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                  Make the evaluation
                </button>
              </div>
            </div>
          </div>

          <div
            v-if="query !== '' && filteredPeople.length === 0"
            class="py-14 px-6 text-center text-sm sm:px-14"
          >
            <UsersIcon class="mx-auto h-6 w-6 text-gray-400" aria-hidden="true" />
            <p class="mt-4 font-semibold text-gray-900">No people found</p>
            <p class="mt-2 text-gray-500">
              We couldn???t find anything with that term. Please try again.
            </p>
          </div>
        </Combobox>
      </TransitionChild>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import {
  MagnifyingGlassIcon,
  ChevronRightIcon,
  UsersIcon,
} from "@heroicons/vue/24/outline";
import {
  Combobox,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption,
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import UserDataService from "@/services/UserDataService";
import useEventsBus from "@/composables/eventBus";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../../stores/useAuth";
import VueAvatar from "@webzlodimir/vue-avatar";
import "@webzlodimir/vue-avatar/dist/style.css";
const { bus, emit } = useEventsBus();
const recent = [];

const employees = ref([]);

const getAllEmployees = () => {
  return UserDataService.getAll()
    .then((res) => {
      const userStore = useAuthStore();
      const { userData } = storeToRefs(userStore);
      const userCompanyId = userData.value.user_company_id;
      employees.value = res.data.employees;
    })
    .catch((error) => {
      console.log(error.response.data);
    });
};

getAllEmployees();
let open = ref(false);
const query = ref("");
const filteredPeople = computed(() =>
  query.value === ""
    ? []
    : employees.value.filter((person) => {
        return person.name.toLowerCase().includes(query.value.toLowerCase());
      })
);

function toggleSearchBox() {
  open.value = !open.value;
}

watch(
  () => bus.value.get("showEmployeesSearchEngine"),
  () => {
    toggleSearchBox();
  }
);

const onSelect = (person) => {
  window.location = person.url;
};
</script>
