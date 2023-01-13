<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="mb-4">
    <label>Filter by Name:</label>
    <input v-model="filterName" />
  </div>

  <div class="flex flex-col">
    <div class="-my-3 overflow-x-auto sm:-mx-6 :-mx-8 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-t border-gray-200 sm:rounded-t-lg">
          <VTable
            sortHeaderClass="flex items-center justify-between w-full"
            :data="employees"
            class="min-w-full divide-y divide-gray-200"
            :filters="filters"
          >
            <template #head class="bg-gray-50">
              <tr>
                <VTh
                  sortKey="name"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Name
                </VTh>

                <VTh
                  sortKey="position"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Position
                </VTh>
                <VTh
                  sortKey="salary"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Salary
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
              <tr v-for="employee in rows" :key="employee.guid" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <!-- <img class="h-10 w-10 rounded-full" :src="person.image" alt="" />-->
                      <img
                        class="h-10 w-10 rounded-full"
                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                        alt=""
                      />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{ employee.name }}
                      </div>
                      <div class="text-sm text-gray-500">
                        {{ employee.surname }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ employee.position }}</div>
                  <div class="text-sm text-gray-500"></div>
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
                  {{ employee.role }}
                  {{ employee.salary }}
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-600 font-medium flex flex-row"
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
                  -->
                  <CalculatorIcon
                    @click="
                      emit('showEmployeeEvaluationForm', {
                        employee: employee,
                      })
                    "
                    class="w-5 h-10 mr-2 cursor-pointer"
                  />
                  <PencilIcon
                    @click="
                      emit('showEditingExistingEmployeeModal', {
                        employee: employee,
                      })
                    "
                    class="w-5 h-10 mr-2 cursor-pointer"
                  />
                  <TrashIcon
                    @click="
                      emit('showDeleteConfirmationModal', { employeeId: employee.id })
                    "
                    class="w-5 h-10 cursor-pointer"
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

    <TailwindPagination
      :data="pagination"
      @pagination-change-page="getAllEmployees"
      :limit="1"
    />
    <!--<PaginationEmployeesComponent />-->
  </div>
  <!--<CreateNewEmployeeModalComponent />-->
  <AddingEmployeeToCompanyComponent></AddingEmployeeToCompanyComponent>
  <EditExistingEmployeeModalComponent />
</template>

<script setup>
import { ref, reactive, onMounted, watch } from "vue";
import { PencilIcon, TrashIcon, CalculatorIcon } from "@heroicons/vue/24/outline";
import { useRouter } from "vue-router";
import useEventsBus from "@/composables/eventBus";
import ComapnyDataService from "@/services/ComapnyDataService";
import CreateNewEmployeeModalComponent from "./modals/CreateNewEmployeeModalComponent.vue";
import AddingEmployeeToCompanyComponent from "./modals/AddingEmployeeToCompanyComponent.vue";
import EditExistingEmployeeModalComponent from "./modals/EditExistingEmployeeModalComponent.vue";
import PaginationEmployeesComponent from "@/components/employees/PaginationEmployeesComponent.vue";
import { TailwindPagination } from "laravel-vue-pagination";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../../stores/useAuth";

const router = useRouter();
const { emit, bus } = useEventsBus();
const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const user = userData.value;

const employees = ref([]);
const pagination = ref({});
let filterName = ref("");

const getAllEmployees = async (page = 1) => {
  ComapnyDataService.getAllCompanyEmployees(user.user_company_id, page)
    .then(async (res) => {
      employees.value = await res.data.employees.data.filter((e) => e.is_owner != 1);
      pagination.value = await res.data.employees.pagination;
      console.log(res.data);
    })

    .catch((error) => {
      console.log(error.response.data);
    });
};

const filters = {
  name: { value: filterName, keys: ["name"] },
};
console.log(filters.name.value);
onMounted(() => {
  getAllEmployees();
});

watch(
  () => bus.value.get("refreshEmployeesTable"),
  () => {
    //alert("refresh users");
    getAllEmployees();
  }
);
</script>
