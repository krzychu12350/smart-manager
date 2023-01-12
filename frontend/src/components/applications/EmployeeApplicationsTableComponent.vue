<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="mb-4">
    <label>Filter by Name:</label>
    <input v-model="filterName" />
  </div>

  <div class="z-1 flex flex-col">
    <div class="-my-3 overflow-x-auto sm:-mx-6 :-mx-8 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-t border-gray-200 sm:rounded-t-lg">
          <VTable
            sortHeaderClass="flex items-center justify-between w-full"
            :data="userApplications"
            class="min-w-full divide-y divide-gray-200"
            :filters="filters"
          >
            <template #head class="bg-gray-50">
              <tr>
                <VTh
                  sortKey="id"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  ID
                </VTh>

                <VTh
                  sortKey="name"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Company name
                </VTh>

                <VTh
                  sortKey="industry"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Company Industry
                </VTh>
                <VTh
                  sortKey="city"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Company location
                </VTh>
                <VTh
                  sortKey="created_at"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Applcation date
                </VTh>
                <VTh
                  sortKey="status"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Status
                </VTh>
              </tr>
            </template>
            <template #body="{ rows }" class="bg-white divide-y">
              <tr
                v-for="applicationDetails in rows"
                :key="applicationDetails.guid"
                class="bg-white"
              >
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      #{{ applicationDetails.id }}
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ applicationDetails.name }}
                  </div>
                </td>
                <!--
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                  >
                    Active
                  </span>
                </td>
                -->
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="text-sm text-gray-900">
                    {{ applicationDetails.industry }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="text-sm text-gray-900">{{ applicationDetails.city }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="text-sm text-gray-900">
                    {{ moment(applicationDetails.created_at).format("LL") }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <span
                    :class="[statusStyles[String(applicationDetails.status)]]"
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize"
                  >
                    {{ applicationDetails.status }}
                  </span>
                </td>
              </tr>
            </template>
          </VTable>
        </div>
      </div>
    </div>
  </div>

  <div
    class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 shadow overflow-hidden sm:rounded-b-lg"
  >
    <!--
    <div class="flex flex-1 justify-between sm:hidden">
      <a
        href="#"
        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
        >Previous</a
      >
      <a
        href="#"
        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
        >Next</a
      >
    </div>
        -->
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          {{ " " }}
          <span class="font-medium">1</span>
          {{ " " }}
          to
          {{ " " }}
          <span class="font-medium">10</span>
          {{ " " }}
          of
          {{ " " }}
          <span class="font-medium">97</span>
          {{ " " }}
          results
        </p>
      </div>
    </div>

    <!--<PaginationEmployeesComponent />-->
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from "vue";
import { PencilIcon, TrashIcon } from "@heroicons/vue/24/outline";
import { useRouter } from "vue-router";
import useEventsBus from "@/composables/eventBus";
import UserDataService from "../../services/UserDataService";
import { useAuthStore } from "../../stores/useAuth";
import { storeToRefs } from "pinia";
import ApplicationActionMenuComponent from "./ApplicationActionMenuComponent.vue";
import ToastService from "../../services/ToastService";
import moment from "moment";

const router = useRouter();
const { emit, bus } = useEventsBus();

const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const user = userData.value;
const userId = user.user_id;

const userApplications = ref([]);
const pagination = ref({});
let filterName = ref("");

const getAllUserApplications = async (page = 1) => {
  UserDataService.get(userId, page)
    .then(async (res) => {
      userApplications.value = await res.data.employee.applications;

      //pagination.value = await res.data.employees.pagination;
      console.log(userApplications);
    })

    .catch((error) => {
      console.log(error.response.data);
    });
};

const filters = {
  name: { value: filterName, keys: ["name"] },
};
const statusStyles = reactive({
  accepted: "bg-green-100 text-green-800",
  "in progress": "bg-yellow-100 text-yellow-800",
  rejected: "bg-red-100 text-red-800",
});

onMounted(() => {
  getAllUserApplications();
});
</script>
