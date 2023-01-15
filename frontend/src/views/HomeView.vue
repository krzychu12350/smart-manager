<template>
  <Dashboard>
    <template v-slot:subpage-content>
      <section id="owner-section" v-if="isOwner == 1">
        <StatsCardsComponent></StatsCardsComponent>
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
          <div class="sm:flex sm:items-center mb-6">
            <div class="sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900">Latest applications</h1>
              <p class="mt-2 text-sm text-gray-700">
                A list of lastest applications for your company
              </p>
            </div>
          </div>
          <LatestEmployeeApplicationsTableComponent></LatestEmployeeApplicationsTableComponent>
        </div>
      </section>
      <section
        aria-labelledby="timeline-title"
        id="employee-section"
        class="lg:col-start-3 lg:col-span-1"
        v-else
      >
        <div class="sm:flex sm:items-center mb-4">
          <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Your companies</h1>
            <p class="mt-2 text-sm text-gray-700">
              A list of all companies where you are employed
            </p>
          </div>
        </div>
        <div class="grid md:grid-cols-12 lg :grid-cols-12 2xl:grid-cols-4 gap-4">
          <div v-for="company in userCompanies" class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <div class="flex justify-between">
                <div>
                  <h2
                    id="applicant-information-title"
                    class="text-lg leading-6 font-medium text-gray-900"
                  >
                    {{ company.name }}
                  </h2>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{ company.name }} information details.
                  </p>
                </div>
              </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Name</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ company.name }}
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Location</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ company.city }}
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Foundation year</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ moment(String(company.created_at)).format("YYYY") }}
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Industry</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ company.industry }}
                  </dd>
                </div>
                <div class="sm:col-span-2">
                  <dt class="text-sm font-medium text-gray-500">About company</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    {{ company.description }}
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
      </section>
    </template>
  </Dashboard>
</template>

<script setup>
import Dashboard from "../components/DashboardBaseComponent.vue";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";
import { ref, onMounted, reactive } from "vue";
import UserDataService from "../services/UserDataService";
import moment from "moment";
import StatsCardsComponent from "../components/home-view-components/StatsCardsComponent.vue";
import LatestEmployeeApplicationsTableComponent from "../components/home-view-components/LatestEmployeeApplicationsTableComponent.vue";

const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const isOwner = userData.value.is_owner;
const userId = userData.value.user_id;
const userCompanies = ref();

function getUserDetails() {
  UserDataService.get(userId)
    .then((res) => {
      userCompanies.value = res.data.employee.companies;
      console.log(userCompanies.value);
    })
    .catch((err) => {
      console.log(err);
    });
}

onMounted(() => {
  getUserDetails();
});
</script>
