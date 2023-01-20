<template>
  <Dashboard>
    <template v-slot:subpage-content>
      <div
        class="min-w-8xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:min-w-8xl lg:px-8"
      ></div>
      <div
        class="min-w-8xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:min-w-8xl lg:grid-flow-col-dense lg:grid-cols-3"
      >
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">
          <section aria-labelledby="applicant-information-title">
            <Form
              @submit="onSubmit"
              :validation-schema="schema"
              @invalid-submit="onInvalidSubmit"
              method="POST"
              class="space-y-8 divide-y divide-gray-200"
            >
              <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                  <h2
                    id="applicant-information-title"
                    class="text-lg leading-6 font-medium text-gray-900"
                  >
                    Generate salary report
                  </h2>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Fill in details to generate report.
                  </p>
                </div>

                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                  <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-1">
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">Period</dt>
                      <vue-tailwind-datepicker
                        :disable-date="dDate"
                        :formatter="formatter"
                        v-model="dateInterval"
                        class="mt-2"
                      />
                      <Field
                        name="date_interval"
                        type="hidden"
                        v-model="dateInterval[0]"
                      ></Field>
                      <div class="text-sm text-red-600 mt-2">
                        <ErrorMessage name="date_interval"></ErrorMessage>
                      </div>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-gray-500">Company</dt>
                      <Field
                        id="company"
                        name="company"
                        as="select"
                        class="mt-2 block w-full pl-3 pr-10 py-2 pb-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                      >
                        <option v-for="company in ownerCompanies" :value="company.id">
                          {{ company.name }}
                        </option>
                      </Field>
                      <div class="text-sm text-red-600 mt-2">
                        <ErrorMessage name="company"></ErrorMessage>
                      </div>
                    </div>
                  </dl>
                </div>

                <button
                  type="submit"
                  class="min-w-full bg-indigo-600 hover:bg-indigo-700 block bg-gray-50 text-sm font-medium text-white text-center px-4 py-4 hover:text-white sm:rounded-b-lg"
                >
                  Generate
                </button>
              </div>
            </Form>
          </section>
        </div>
      </div>
    </template>
  </Dashboard>
</template>
<script setup>
import { ref, onMounted, inject } from "vue";
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import Dashboard from "../components/DashboardBaseComponent.vue";
import PdfDataService from "../services/PdfDataService";
import { storeToRefs } from "pinia";
import { useAuthStore } from "@/stores/useAuth";
import UserDataService from "@/services/UserDataService";

const $loading = inject("$loading");
const fullPage = ref(true);

const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const loggedInOwner = userData.value;
const ownerCompanies = ref([]);

const requestPayload = ref({});

const dateInterval = ref([]);
const formatter = ref({
  date: "YYYY-MM-DD",
  month: "MMM",
});
const dDate = (date) => {
  return date > new Date();
};
onMounted(() => {
  UserDataService.get(loggedInOwner.user_id)
    .then((res) => {
      ownerCompanies.value = res.data.employee.companies;
    })
    .catch((err) => {
      console.log(err);
    });
});

const onSubmit = async (newUserData) => {
  const loader = $loading.show();
  requestPayload.value = JSON.stringify({
    company: loggedInOwner.user_company_id,
    date_from: dateInterval.value[0],
    date_to: dateInterval.value[1],
  });

  PdfDataService.getSalaryReport(requestPayload.value)
    .then((response) => {
      if (response.status == 200) {
        let blob = new Blob([response.data], { type: "application/pdf" });
        let fileURL = window.URL.createObjectURL(blob);
        window.open(fileURL, "_self");
      }
      loader.hide();
    })
    .catch((error) => {
      console.log(error);
    });
};

const schema = yup.object({
  company: yup.number().required("Comapny is a required field"),
  date_interval: yup.string().required("Select a date interval"),
});

function onInvalidSubmit({ values, errors, results }) {
  console.log(values); // current form values
  console.log(errors); // a map of field names and their first error message
  console.log(results); // a detailed map of field names and their validation results
}
</script>
