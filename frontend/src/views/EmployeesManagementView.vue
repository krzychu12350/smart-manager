<template>
  <Dashboard>
    <template v-slot:subpage-header>
      <!--
      <h1 v-if="user" class="text-2xl font-semibold text-gray-900">
        Dashboard
        {{ user.name }} {{ user.surname }}
      </h1>
      -->
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">Employees</h1>

          <p v-if="!isAdmin" class="mt-2 text-sm text-gray-700">
            A list of all the employees in your company including their name, positions
            and salary
          </p>
        </div>
      </div>
      <div class="sm:flex sm:items-center justify-between">
        <div class="">
          <button
            type="button"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
            @click="emit('showAddingEmployeeToCompanyModal')"
          >
            Add employee
          </button>
        </div>
        <SearchBoxTriggerComponent></SearchBoxTriggerComponent>
      </div>
    </template>
    <template v-slot:subpage-content>
      <TableComponent />
    </template>
  </Dashboard>

  <EmployeesSearchEngineComponentVue />

  <ConfirmationModalComponent />
  <EmployeeEvaluationFormComponent></EmployeeEvaluationFormComponent>
</template>
<script setup>
import { ref, watch, defineAsyncComponent } from "vue";
import Dashboard from "../components/DashboardBaseComponent.vue";
import TableComponent from "../components/employees/EmployeesTableComponent.vue";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";
import ConfirmationModalComponent from "../components/employees/modals/ConfirmationModalEmployeeDeletingComponent.vue";
import useEventsBus from "@/composables/eventBus";
//import EmployeesSearchEngineComponentVue from "../components/employees/EmployeesSearchEngineComponent.vue";
import SearchBoxTriggerComponent from "@/components/employees/SearchBoxTriggerComponent.vue";
//import EmployeeEvaluationFormComponent from "../components/employees/modals/EmployeeEvaluationFormComponent.vue";
const EmployeeEvaluationFormComponent = defineAsyncComponent(() =>
  import("../components/employees/modals/EmployeeEvaluationFormComponent.vue")
);
const EmployeesSearchEngineComponentVue = defineAsyncComponent(() =>
  import("../components/employees/EmployeesSearchEngineComponent.vue")
);
const { emit, bus } = useEventsBus();

const userStore = useAuthStore();
const { user } = storeToRefs(userStore);
</script>
