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
            v-if="query === '' || filteredCompanies.length > 0"
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
                  v-for="company in query === ' ' ? recent : filteredCompanies"
                  :key="company.id"
                  :value="company"
                  as="template"
                  v-slot="{ active }"
                >
                  <li
                    :class="[
                      'group flex cursor-default select-none items-center rounded-md p-2',
                      active && 'bg-gray-100 text-gray-900',
                    ]"
                  >
                    <img
                      src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                      alt=""
                      class="h-6 w-6 flex-none rounded-full"
                    />
                    <span class="ml-3 flex-auto truncate">{{ company.name }}</span>
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
                <img
                  src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                  alt=""
                  class="mx-auto h-16 w-16 rounded-full"
                />
                <h2 class="mt-3 font-semibold text-gray-900">
                  {{ activeOption.name }}
                </h2>
              </div>
              <div class="flex flex-auto flex-col justify-between p-6">
                <dl class="grid grid-cols-1 gap-x-6 gap-y-3 text-sm text-gray-700">
                  <dt class="col-end-1 font-semibold text-gray-900">City</dt>
                  <dd>{{ activeOption.city }}</dd>
                  <dt class="col-end-1 font-semibold text-gray-900">Industry</dt>
                  <dd class="truncate">
                    {{ activeOption.industry }}
                  </dd>
                  <dt class="col-end-1 font-semibold text-gray-900">Foundation year</dt>
                  <dd class="d-block">
                    {{ moment(String(activeOption.created_at)).format("YYYY") }}
                  </dd>
                  <dt class="col-end-1 font-semibold text-gray-900">About Company</dt>
                  <dd class="d-block">
                    {{ activeOption.description }}
                  </dd>
                </dl>
                <button
                  type="button"
                  @click="applyToCompany(activeOption.id)"
                  class="mt-6 w-full rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                  Apply
                </button>
              </div>
            </div>
          </div>

          <div
            v-if="query !== '' && filteredCompanies.length === 0"
            class="py-14 px-6 text-center text-sm sm:px-14"
          >
            <UsersIcon class="mx-auto h-6 w-6 text-gray-400" aria-hidden="true" />
            <p class="mt-4 font-semibold text-gray-900">No people found</p>
            <p class="mt-2 text-gray-500">
              We couldn’t find anything with that term. Please try again.
            </p>
          </div>
        </Combobox>
      </TransitionChild>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { computed, ref, watch, onMounted } from "vue";
//import { SearchIcon } from "@heroicons/vue/24/solid/";
import CompanyDataService from "../../services/ComapnyDataService";
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
import moment from "moment";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../../stores/useAuth";
import ApplicationDataService from "../../services/ApplicationDataService";
import ToastService from "@/services/ToastService";

const { bus, emit } = useEventsBus();
const recent = [];
const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const userId = userData.value.user_id;
/*
export default {
  components: {
    ChevronRightIcon,
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
    Dialog,
    DialogOverlay,
    //SearchIcon,
    TransitionChild,
    TransitionRoot,
    UsersIcon,
  },

  setup() {
    */

const applyToCompany = (companyId) => {
  console.log(companyId, userId);
  toggleSearchBox();
  const newApplicationData = {
    status: "in progress",
    user_id: userId,
    company_id: companyId,
  };
  ApplicationDataService.create(newApplicationData)
    .then(async (res) => {
      //console.log(await res.data.message);
      ToastService.showToast("Your application was send to company successfully");
    })

    .catch((error) => {
      console.log(error);
    });
};

const companies = ref([]);

const getAllComapnies = async (page = 1) => {
  return CompanyDataService.getAll(page)
    .then((res) => {
      companies.value = res.data.companies;
      console.log(companies.value);
    })

    .catch((error) => {
      console.log(error);
    });
};
onMounted(() => {
  getAllComapnies();
});

let open = ref(false);
const query = ref("");

const filteredCompanies = computed(() =>
  query.value === ""
    ? []
    : companies.value.filter((company) => {
        //console.log(company);
        return company.name.toLowerCase().includes(query.value.toLowerCase());
      })
);

function toggleSearchBox() {
  open.value = !open.value;
  //console.log(open.value);
}

watch(
  () => bus.value.get("showCompanySearchEngine"),
  () => {
    toggleSearchBox();
  }
);

const onSelect = (company) => {
  window.location = company.url;
};
/*
return {
  open,
  query,
  recent,
  filteredCompanies,
  onSelect(company) {
    window.location = company.url;
  },
};
/*
  },
};
*/
</script>
