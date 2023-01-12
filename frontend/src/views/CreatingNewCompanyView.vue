<template>
  <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-50">
    <body class="h-full">
    ```
  -->
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="../assets/logo.png" alt="Smart Manager" />
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
          Add your first company
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">Type in your company details</p>
      </div>
      <Form
        @submit="onSubmit"
        :validation-schema="schema"
        @invalid-submit="onInvalidSubmit"
        class="mt-8 space-y-6"
        method="POST"
      >
        <h1>rrrrr {{ props.owner_id }}</h1>
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm">
          <div class="mb-4">
            <label for="name" class="sr-only">Comapny name</label>
            <Field
              id="company_name"
              name="company_name"
              type="text"
              autocomplete="company_name"
              required=""
              class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
              placeholder="Company name"
            />
            <div class="text-sm text-red-600">
              <ErrorMessage name="company_name" />
            </div>
          </div>
          <div class="mb-4">
            <label for="city" class="sr-only">Company location</label>
            <Field
              id="location"
              name="location"
              type="text"
              autocomplete="location"
              required=""
              class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
              placeholder="Company location"
            />
            <div class="text-sm text-red-600">
              <ErrorMessage name="location" />
            </div>
          </div>
          <div class="mt-4">
            <label for="industry" class="sr-only">Industry</label>
            <Field
              id="industry"
              name="industry"
              type="text"
              autocomplete="industry"
              required=""
              class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
              placeholder="Industry"
            />
            <div class="text-sm text-red-600">
              <ErrorMessage name="industry" />
            </div>
          </div>
          <div class="mt-4">
            <label for="about_company" class="sr-only mt-8">About company</label>
            <Field
              id="about_company"
              name="about_company"
              as="textarea"
              type="textarea"
              autocomplete="about_company"
              required=""
              class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
              placeholder="About company"
            />

            <div class="text-sm text-red-600">
              <ErrorMessage name="about_company" />
            </div>
          </div>
        </div>

        <div>
          <button
            type="submit"
            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <LockClosedIcon
                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                aria-hidden="true"
              />
            </span>
            Add company
          </button>
        </div>
      </Form>
    </div>
  </div>
</template>

<script setup>
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { ref, onBeforeUnmount, watch, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/useAuth";
import { useErrorStore } from "../stores/useError";
import UserAuthService from "../services/UserAuthService";
import ComapnyDataService from "../services/ComapnyDataService";
import ToastService from "../services/ToastService";
import useEventsBus from "@/composables/eventBus";

const { bus } = useEventsBus();
//const credentials = ref({});
const loading = ref(false);
const router = useRouter();
const error = useErrorStore();
let newOwnerId = ref();
let newOwnerData = ref();

const props = defineProps(["owner_id", "owner_credentails"]);

console.log(props.owner_id);

const onSubmit = async (newCompanyData) => {
  console.log(props.owner_credentails);
  //loading.value = !loading.value;
  console.log(newCompanyData);

  const newCompany = await createNewCompany(newCompanyData);
  console.log(newCompany);
  assignNewOwnerToItsCompany(newCompany.id, props.owner_id);
  const newOwnerCredentails = {
    email: props.owner_credentails.email,
    password: props.owner_credentails.password,
  };
  console.log(newOwnerCredentails);
  logInNewOwner(newOwnerCredentails);
  //router.push("/login");
};

async function createNewCompany(newCompanyData) {
  const companyData = {
    name: newCompanyData.company_name,
    city: newCompanyData.location,
    industry: newCompanyData.industry,
    description: newCompanyData.about_company,
  };
  console.log(newCompanyData.location);
  return ComapnyDataService.create(companyData)
    .then((res) => {
      console.log(res.data);

      return res.data.company;
    })
    .catch((error) => {
      const message =
        (error.response && error.response.data && error.response.data.message) ||
        error.message ||
        error.toString();
      console.log(message);
      ToastService.showToast(error.message);
    });
}

async function assignNewOwnerToItsCompany(comapnyId, ownerId) {
  alert(comapnyId + " " + ownerId);

  return ComapnyDataService.addUserForTheCompany(comapnyId, { user: ownerId })
    .then((res) => {
      console.log(res.data);
      return res.data.company;
    })
    .catch((error) => {
      const message =
        (error.response && error.response.data && error.response.data.message) ||
        error.message ||
        error.toString();
      console.log(message);
      ToastService.showToast(error.message);
    });
}
function logInNewOwner(credentials) {
  useAuthStore()
    .login(credentials)
    .then((response) => {
      //console.log(response);
      ToastService.showToast("Your first company was created successfully");
      router.push({ name: "home" });
    })
    .catch((err) => {
      loading.value = !loading.value;
      console.log(err);
      ToastService.showToast("Invalid email or password");
    });
}

watch(
  () => bus.value.get("passNewOwnerId"),
  (val) => {
    alert(val[0].id);
    //console.log(val[0].id);
    newOwnerId.value = val[0].id;
    newOwnerData.value = val[0].new_owner_data;
    console.log(newOwnerData.value);
  }
);

const schema = yup.object({
  company_name: yup.string().required("Company name is a required field").min(3),
  location: yup.string().required("Company location is a required field").min(3),
  industry: yup.string().required("Company industry is a required field").min(3),
  about_company: yup.string().required("Company description is a required field").min(12),
});

function onInvalidSubmit({ values, errors, results }) {
  console.log(values); // current form values
  console.log(errors); // a map of field names and their first error message
  console.log(results); // a detailed map of field names and their validation results
}

onBeforeUnmount(() => error.$reset());
</script>
