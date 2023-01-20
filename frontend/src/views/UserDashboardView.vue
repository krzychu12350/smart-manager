<template>
  <Dashboard>
    <template v-slot:subpage-content>
      <div
        class="min-w-8xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:min-w-8xl lg:px-8"
      >
        <div class="flex items-center space-x-5">
          <div class="flex-shrink-0">
            <div class="relative">
              <vue-avatar
                class=""
                :username="userData.user_name + userData.user_surname"
                :size="70"
                border-radius="50%"
                :lighten="200"
              />
              <span
                class="absolute inset-0 shadow-inner rounded-full"
                aria-hidden="true"
              />
            </div>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900">
              {{ userData.user_name }} {{ userData.user_surname }}
            </h1>
            <p
              v-if="userDataDetails.value != undefined"
              class="text-sm font-medium text-gray-500"
            >
              Owner of
              <a href="#" class="text-gray-900"> {{ companyDataDetails.name }}</a> since
              <time datetime="2020-08-25">
                {{
                  moment(String(companyDataDetails.created_at)).format("MMMM Do YYYY")
                }}</time
              >
            </p>
          </div>
        </div>
        <div
          v-if="isOwner"
          class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3"
        >
          <button
            type="button"
            @click="this.$router.push('/admin/employees')"
            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
          >
            Browse employees
          </button>
          <button
            type="button"
            @click="this.$router.push('/admin/reports')"
            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
          >
            Generate raports
          </button>
        </div>
      </div>

      <div
        class="mt-8 min-w-8xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:min-w-8xl lg:grid-flow-col-dense lg:grid-cols-3"
      >
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">
          <!-- Description list-->
          <section aria-labelledby="applicant-information-title">
            <div class="bg-white shadow sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6">
                <div class="flex justify-between">
                  <div>
                    <h2
                      id="applicant-information-title"
                      class="text-lg leading-6 font-medium text-gray-900"
                    >
                      Your Information
                    </h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Your personal details.
                    </p>
                  </div>
                  <div>
                    <PencilIcon
                      @click="emit('showEditingExistingUserModal', userDataDetails)"
                      class="w-5 h-10 cursor-pointer"
                    />
                  </div>
                </div>
              </div>
              <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">First Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      {{ userDataDetails.name }}
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Last Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      {{ userDataDetails.surname }}
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Current Salary</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      ${{ userDataDetails.salary }}
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Position</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      {{ userDataDetails.position }}
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </section>
        </div>

        <section
          v-if="isOwner"
          aria-labelledby="timeline-title"
          class="lg:col-start-3 lg:col-span-1"
        >
          <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <div class="flex justify-between">
                <div>
                  <h2
                    id="applicant-information-title"
                    class="text-lg leading-6 font-medium text-gray-900"
                  >
                    Your Company Information
                  </h2>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Your comapny details.
                  </p>
                </div>
                <div>
                  <PencilIcon
                    @click="emit('showEditingExistingCompanyModal', companyDataDetails)"
                    class="w-5 h-10 cursor-pointer"
                  />
                </div>
              </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Name</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ companyDataDetails.name }}
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Location</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ companyDataDetails.city }}
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Foundation year</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ moment(new Date(companyDataDetails.created_at)).format("YYYY") }}
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Industry</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ companyDataDetails.industry }}
                  </dd>
                </div>
                <div class="sm:col-span-2">
                  <dt class="text-sm font-medium text-gray-500">About</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ companyDataDetails.description }}
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </section>
      </div>
      <EditExistingCompanyModalComponent />
      <EditExistingUserModalComponent />
    </template>
  </Dashboard>
</template>
<script setup>
import { ref, onMounted, reactive, watch } from "vue";
import Dashboard from "../components/DashboardBaseComponent.vue";
import EditExistingCompanyModalComponent from "@/components/user-dashboard/modals/EditExistingCompanyModalComponent.vue";
import EditExistingUserModalComponent from "../components/user-dashboard/modals/EditExistingUserModalComponent.vue";
import { PencilIcon } from "@heroicons/vue/24/outline";
import VueAvatar from "@webzlodimir/vue-avatar";
import "@webzlodimir/vue-avatar/dist/style.css";
import ComapnyDataService from "../services/ComapnyDataService";
import UserDataService from "../services/UserDataService";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";
import useEventsBus from "@/composables/eventBus";
import moment from "moment";

const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const isOwner = userData.value.is_owner;
const userId = userData.value.user_id;
const userCompanyId = ref(userData.value.user_company_id);
const companyDataDetails = ref({});
const userDataDetails = ref({});

const { bus, emit } = useEventsBus();

function getUserDetails() {
  UserDataService.get(userId)
    .then((res) => {
      userDataDetails.value = res.data.employee;
    })
    .catch((err) => {
      console.log(err);
    });
}

function getComapnyDetails() {
  ComapnyDataService.get(userCompanyId.value)
    .then((res) => {
      companyDataDetails.value = res.data.company;
    })
    .catch((err) => {});
}

onMounted(() => {
  if (isOwner === 1) getComapnyDetails();
  getUserDetails();
});

watch(
  () => bus.value.get("refreshCompanyDetails"),
  () => {
    getComapnyDetails();
  }
);

watch(
  () => bus.value.get("refreshUserDetails"),
  () => {
    getUserDetails();
  }
);
</script>
