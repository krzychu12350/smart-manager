<template>
  <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Overview</h1>
        <p class="mt-2 mb-2 text-sm text-gray-700">
          A list of basic statistics about your company
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
            <RouterLink
              :to="card.href"
              class="font-medium text-cyan-700 hover:text-cyan-900"
            >
              See more
            </RouterLink>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted, reactive } from "vue";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../../stores/useAuth";
import UserDataService from "@/services/UserDataService";
import { useRouter } from "vue-router";
import { InboxIcon, UsersIcon, BanknotesIcon } from "@heroicons/vue/24/outline";

const router = useRouter();
const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const isOwner = userData.value.is_owner;
const userCompanyId = userData.value.user_company_id;
const userCompanies = ref();
let employeeCounter = ref(0);
let applicationsCounter = ref(0);
let maxSalary = ref(0);
let minSalary = ref(0);

onMounted(() => {
  //console.log(userId);
  UserDataService.getAll()
    .then((res) => {
      const allEmployees = res.data.employees;
      //console.log(allEmployees);
      const companyEmployeess = allEmployees.map((e) => {
        e.companies.map((c) => {
          if (e.is_owner === 0 && c.id === userCompanyId) {
            employeeCounter.value += 1;

            //console.log(c);
            //employeeCounter.value += 1;
            //return (employeeCounter += 1);
          }
        });
        e.applications.map((a) => {
          if (a.company_id === userCompanyId) {
            applicationsCounter.value += 1;
            //console.log(applicationsCounter);
            //employeeCounter.value += 1;
            //return (employeeCounter += 1);
          }
        });
      });

      const companyEmployees = allEmployees.filter(function (e) {
        return e.is_owner === 0 && e.companies.some((c) => c.id === userCompanyId);
      });

      maxSalary.value = Math.max(...companyEmployees.map((e) => e.salary));
      minSalary.value = Math.min(...companyEmployees.map((e) => e.salary));
      //console.log(maxSalary, minSalary);
      /*
      const test = Arrays.allEmployees.filter()
        ...e.map((e) => {
          e.companies.map((c) => {
            if (e.is_owner === 0 && c.id === userCompanyId) e.salary;
          });
        })
      );
      console.log(test);
*/
      //console.log(employeeCounter.value);

      // userCompanies.value = allEmployees;

      //console.log(userCompanies.value);
    })
    .catch((err) => {
      console.log(err);
    });
});

const cards = [
  {
    name: "Employees",
    href: "/admin/employees",
    icon: UsersIcon,
    amount: employeeCounter,
  },
  {
    name: "Applications",
    href: "/admin/applications",
    icon: InboxIcon,
    amount: applicationsCounter,
  },
  {
    name: "Highest salary",
    href: "/admin/employees",
    icon: BanknotesIcon,
    amount: maxSalary,
  },
  {
    name: "Lowest salary",
    href: "/admin/employees",
    icon: BanknotesIcon,
    amount: minSalary,
  },
  // More items...
];
</script>
