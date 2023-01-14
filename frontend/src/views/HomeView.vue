<template>
  <Dashboard>
    <template v-slot:subpage-content>
      <section id="owner-section" v-if="isOwner == 1">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900">Overview</h1>
              <p class="mt-2 text-sm text-gray-700">
                A list of all the employees in your company including their name, title,
                email and role etc.
              </p>
            </div>
          </div>
          <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Card -->
            <div
              v-for="card in cards"
              :key="card.name"
              class="bg-white overflow-hidden shadow rounded-lg"
            >
              <div class="p-5">
                <div class="flex items-center">
                  <div class="flex-shrink-0">
                    <component
                      :is="card.icon"
                      class="h-6 w-6 text-gray-400"
                      aria-hidden="true"
                    />
                  </div>
                  <div class="ml-5 w-0 flex-1">
                    <dl>
                      <dt class="text-sm font-medium text-gray-500 truncate">
                        {{ card.name }}
                      </dt>
                      <dd>
                        <div class="text-lg font-medium text-gray-900">
                          {{ card.amount }}
                        </div>
                      </dd>
                    </dl>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                  <a
                    :href="card.href"
                    class="font-medium text-cyan-700 hover:text-cyan-900"
                  >
                    View all
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900">Recent applications</h1>
              <p class="mt-2 text-sm text-gray-700">
                A list of all the employees in your company including their name, title,
                email and role etc.
              </p>
            </div>
          </div>
        </div>
        <!-- Activity list (smallest breakpoint only) -->
        <div class="shadow sm:hidden">
          <ul
            role="list"
            class="mt-2 divide-y divide-gray-200 overflow-hidden shadow sm:hidden"
          >
            <li v-for="transaction in transactions" :key="transaction.id">
              <a
                :href="transaction.href"
                class="block px-4 py-4 bg-white hover:bg-gray-50"
              >
                <span class="flex items-center space-x-4">
                  <span class="flex-1 flex space-x-2 truncate">
                    <CashIcon
                      class="flex-shrink-0 h-5 w-5 text-gray-400"
                      aria-hidden="true"
                    />
                    <span class="flex flex-col text-gray-500 text-sm truncate">
                      <span class="truncate">{{ transaction.name }}</span>
                      <span
                        ><span class="text-gray-900 font-medium">{{
                          transaction.amount
                        }}</span>
                        {{ transaction.currency }}</span
                      >
                      <time :datetime="transaction.datetime">{{ transaction.date }}</time>
                    </span>
                  </span>
                  <ChevronRightIcon
                    class="flex-shrink-0 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                  />
                </span>
              </a>
            </li>
          </ul>

          <nav
            class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200"
            aria-label="Pagination"
          >
            <div class="flex-1 flex justify-between">
              <a
                href="#"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
              >
                Previous
              </a>
              <a
                href="#"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
              >
                Next
              </a>
            </div>
          </nav>
        </div>

        <!-- Activity table (small breakpoint and up) -->
        <div class="hidden sm:block">
          <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col mt-2">
              <div
                class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg"
              >
                <table class="min-w-full divide-y divide-gray-200">
                  <thead>
                    <tr>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Transaction
                      </th>
                      <th
                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Amount
                      </th>
                      <th
                        class="hidden px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider md:block"
                      >
                        Status
                      </th>
                      <th
                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Date
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr
                      v-for="transaction in transactions"
                      :key="transaction.id"
                      class="bg-white"
                    >
                      <td
                        class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                      >
                        <div class="flex">
                          <a
                            :href="transaction.href"
                            class="group inline-flex space-x-2 truncate text-sm"
                          >
                            <CashIcon
                              class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                              aria-hidden="true"
                            />
                            <p class="text-gray-500 truncate group-hover:text-gray-900">
                              {{ transaction.name }}
                            </p>
                          </a>
                        </div>
                      </td>
                      <td
                        class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500"
                      >
                        <span class="text-gray-900 font-medium"
                          >{{ transaction.amount }}
                        </span>
                        {{ transaction.currency }}
                      </td>
                      <td
                        class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block"
                      >
                        <span
                          :class="[
                            statusStyles[transaction.status],
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize',
                          ]"
                        >
                          {{ transaction.status }}
                        </span>
                      </td>
                      <td
                        class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500"
                      >
                        <time :datetime="transaction.datetime">{{
                          transaction.date
                        }}</time>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- Pagination -->
                <nav
                  class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                  aria-label="Pagination"
                >
                  <div class="hidden sm:block">
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
                      <span class="font-medium">20</span>
                      {{ " " }}
                      results
                    </p>
                  </div>
                  <div class="flex-1 flex justify-between sm:justify-end">
                    <a
                      href="#"
                      class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                      Previous
                    </a>
                    <a
                      href="#"
                      class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                      Next
                    </a>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section
        aria-labelledby="timeline-title"
        id="employee-section"
        v-else
        class="lg:col-start-3 lg:col-span-1"
      >
        <div class="sm:flex sm:items-center mb-4">
          <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Your companies</h1>
            <p class="mt-2 text-sm text-gray-700">
              A list of all companies where you are employed
            </p>
          </div>
        </div>
        <div class="grid grid-cols-4 gap-4">
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
                  <dt class="text-sm font-medium text-gray-500">About</dt>
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
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../stores/useAuth";
import { ref, onMounted, reactive } from "vue";
import UserDataService from "../services/UserDataService";
import moment from "moment";
const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const isOwner = userData.value.is_owner;
const userId = userData.value.user_id;
const userCompanies = ref();
const employeeCounter = ref(0);

onMounted(() => {
  console.log(userId);
  UserDataService.get(userId)
    .then((res) => {
      userCompanies.value = res.data.employee.companies;
      console.log(userCompanies.value);
    })
    .catch((err) => {
      console.log(err);
    });
});

const cards = [
  { name: "Account balance", href: "#", icon: XMarkIcon, amount: "$30,659.45" },
  { name: "Account balance", href: "#", icon: XMarkIcon, amount: "$30,659.45" },
  { name: "Account balance", href: "#", icon: XMarkIcon, amount: "$30,659.45" },
  { name: "Account balance", href: "#", icon: XMarkIcon, amount: "$30,659.45" },
  // More items...
];

const transactions = [
  {
    id: 1,
    name: "Payment to Molly Sanders",
    href: "#",
    amount: "$20,000",
    currency: "USD",
    status: "success",
    date: "July 11, 2020",
    datetime: "2020-07-11",
  },
  {
    id: 2,
    name: "Payment to Molly Sanders",
    href: "#",
    amount: "$20,000",
    currency: "USD",
    status: "processing",
    date: "July 11, 2020",
    datetime: "2020-07-11",
  },
  {
    id: 3,
    name: "Payment to Molly Sanders",
    href: "#",
    amount: "$20,000",
    currency: "USD",
    status: "processing",
    date: "July 11, 2020",
    datetime: "2020-07-11",
  },
  {
    id: 4,
    name: "Payment to Molly Sanders",
    href: "#",
    amount: "$20,000",
    currency: "USD",
    status: "failed",
    date: "July 11, 2020",
    datetime: "2020-07-11",
  },
  // More transactions...
];
const statusStyles = {
  success: "bg-green-100 text-green-800",
  processing: "bg-yellow-100 text-yellow-800",
  failed: "bg-gray-100 text-gray-800",
};

const getAllEmployees = () => {
  return UserDataService.getAll()
    .then((res) => {
      //employees.value = res.data.employees;
      const userStore = useAuthStore();
      const { userData } = storeToRefs(userStore);
      const userCompanyId = userData.value.user_company_id;
      employeeCounter.value = res.data.employees;
      Object.keys(member).length;
      //employees.value = res.data.employees.filter((e) => e.companies[0].id === 2);
      console.log(employees.value);
    })

    .catch((error) => {
      console.log(error.response.data);
    });
};
</script>
