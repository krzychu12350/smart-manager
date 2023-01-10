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
            :data="applications"
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
                  sortKey="user[0].surname"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Candidate
                </VTh>

                <VTh
                  sortKey="user[0].surname"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Position
                </VTh>
                <VTh
                  sortKey="application_date"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Application date
                </VTh>
                <VTh
                  sortKey="status"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Status
                </VTh>
                <th
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Actions
                </th>
              </tr>
            </template>
            <template #body="{ rows }" class="bg-white divide-y">
              <tr v-for="application in rows" :key="application.guid" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">#{{ application.id }}</div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ application.user[0].name }} {{ application.user[0].surname }}
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
                  <div class="text-sm text-gray-900">Applied position</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="text-sm text-gray-900">
                    {{ moment(application.application_date).format("LL") }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <span
                    :class="[statusStyles[String(application.status)]]"
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize"
                  >
                    {{ application.status }}
                  </span>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-600 font-medium flex items-center"
                >
                  <!--
                  <router-link
                    :to="{ name: 'home' }"
                    class="text-sm text-green-600 hover:text-indigo-900 mr-2"
                  >
                
                  </router-link>
               
                  <router-link
                    :to="{ name: 'home' }"
                    class="text-sm text-red-600 hover:text-indigo-900"
                   
                  >
                  
                  </router-link>
                 
                  <PencilIcon
                    @click="
                      emit('showEditingExistingEmployeeModal', {
                        employeeId: employee.id,
                      })
                    "
                    class="w-5 h-10"
                  />
                  -->
                  <ApplicationActionMenuComponent
                    :applicationId="application.id"
                  ></ApplicationActionMenuComponent>
                  <TrashIcon
                    @click="
                      emit('showApplicationDeletingConfirmationModal', {
                        applicationId: application.id,
                      })
                    "
                    class="w-5 h-10 ml-2"
                  />
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
import ApplicationDataService from "../../services/ApplicationDataService";
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
const userCompanyId = user.user_company_id;

const applications = ref([]);
const pagination = ref({});
let filterName = ref("");

const getAllApplications = async (page = 1) => {
  ApplicationDataService.getAll(userCompanyId, page)
    .then(async (res) => {
      applications.value = await res.data.applications;
      //pagination.value = await res.data.employees.pagination;
      console.log(applications.value);
    })

    .catch((error) => {
      console.log(error.response.data);
    });
};

const filters = {
  name: { value: filterName, keys: ["user[0].surname"] },
};
const statusStyles = reactive({
  accepted: "bg-green-100 text-green-800",
  "in progress": "bg-yellow-100 text-yellow-800",
  rejected: "bg-red-100 text-red-800",
});

const updateApplicationStatus = async (applicationId, status) => {
  return ApplicationDataService.update(applicationId, status)
    .then(async (res) => {
      return res.data.message;
    })

    .catch((error) => {
      console.log(error.response.data);
    });
};

onMounted(() => {
  getAllApplications();
});

watch(
  () => bus.value.get("refreshApplicationTable"),
  (data) => {
    //alert("refresh users");
    getAllApplications();
  }
);

watch(
  () => bus.value.get("updateApplicationStatus"),
  async (data) => {
    const applicationId = data[0].applicationId;
    console.log(data[0].applicationId, data[0].status);

    const messageFromAPI = await updateApplicationStatus(data[0].applicationId, {
      status: data[0].status,
    });
    console.log(messageFromAPI);
    ToastService.showToast(messageFromAPI);
    getAllApplications();
  }
);
</script>
