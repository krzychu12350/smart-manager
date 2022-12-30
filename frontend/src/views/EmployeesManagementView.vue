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

          <p v-if="isAdmin" class="mt-2 text-sm text-gray-700">
            A list of all the employees in your company including their name, title, email
            and role etc.
          </p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
          <button
            type="button"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
            @click="emit('showCreatingNewEmployeeModal')"
          >
            Add employee
          </button>
        </div>
      </div>
    </template>
    <template v-slot:subpage-content>
      <TableComponent />
    </template>
  </Dashboard>

  <!--
  <ConfirmationModalComponent :show="open">
    <template v-slot:dialog-title> Delete employee </template>
    <template v-slot:dialog-description>
      Are you sure you want to remove this employee? All of your data will be permanently
      removed from our servers forever. This action cannot be undone.
    </template>
    <template v-slot:dialog-action-confirm>
      <button
        type="button"
        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
      >
        Delete
      
      </button></template
    >
  </ConfirmationModalComponent>
-->

  <ConfirmationModalComponent />
</template>
<script setup>
import { ref, watch } from "vue";
import Dashboard from "../components/DashboardBaseComponent.vue";
import TableComponent from "../components/employees/EmployeesTableComponent.vue";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";
import ConfirmationModalComponent from "../components/employees/modals/ConfirmationModalEmployeeDeletingComponent.vue";
import useEventsBus from "@/composables/eventBus";
const { emit, bus } = useEventsBus();

const userStore = useAuthStore();
const { user } = storeToRefs(userStore);
</script>
