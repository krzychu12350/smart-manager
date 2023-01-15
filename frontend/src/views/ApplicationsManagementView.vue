<template>
  <Dashboard>
    <template v-slot:subpage-content>
      <div v-if="isUserOwner">
        <div class="max-w-8xl mx-auto mb-4">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900">
                Application managment view
              </h1>
              <p class="mt-2 text-sm text-gray-700">
                A list of all the applications of candidates for your company
              </p>
            </div>
          </div>
        </div>

        <applications-table-component></applications-table-component>
        <ConfirmationApplicationDeletingModalComponent />
      </div>
      <div v-else>
        <div class="max-w-8xl mx-auto mb-4">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900">Your applications</h1>
              <p class="mt-2 text-sm text-gray-700">
                A list of all the companies, where you applied.
              </p>
            </div>
          </div>
        </div>
        <div class="sm:flex sm:items-center justify-between mb-2">
          <div class="">
            <button
              type="button"
              @click="emit('showCompanySearchEngine')"
              class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
            >
              Apply for a new company
            </button>
          </div>
          <CompanySearchEngineComponent></CompanySearchEngineComponent>
        </div>
        <EmployeeApplicationsTableComponent></EmployeeApplicationsTableComponent>
      </div>
    </template>
  </Dashboard>
</template>
<script setup>
import { ref, defineAsyncComponent } from "vue";
import Dashboard from "../components/DashboardBaseComponent.vue";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";
import CompanySearchEngineComponent from "../components/applications/CompanySearchEngineComponent.vue";
import useEventsBus from "@/composables/eventBus";

const ApplicationsTableComponent = defineAsyncComponent(() =>
  import("../components/applications/OwnerApplicationsTableComponent.vue")
);
const ConfirmationApplicationDeletingModalComponent = defineAsyncComponent(() =>
  import(
    "../components/applications/modals/ConfirmationApplicationDeletingModalComponent.vue"
  )
);
const EmployeeApplicationsTableComponent = defineAsyncComponent(() =>
  import("../components/applications/EmployeeApplicationsTableComponent.vue")
);
const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const isUserOwner = ref(userData.value.is_owner);
const { emit } = useEventsBus();
</script>
