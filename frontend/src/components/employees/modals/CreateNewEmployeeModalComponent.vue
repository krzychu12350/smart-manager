<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-200"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <DialogOverlay
            class="fixed inset-0 bg-gray-400 bg-opacity-75 transition-opacity"
          />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to="opacity-100 translate-y-0 sm:scale-100"
          leave="ease-in duration-200"
          leave-from="opacity-100 translate-y-0 sm:scale-100"
          leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
          >
            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
              <button
                type="button"
                class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                @click="open = false"
              >
                <span class="sr-only">Close</span>
                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
              </button>
            </div>

            <Form
              @submit="onSubmit"
              :validation-schema="schema"
              @invalid-submit="onInvalidSubmit"
              method="POST"
              class="space-y-8 divide-y divide-gray-200"
            >
              <div class="space-y-8 divide-y divide-gray-200">
                <div class="pt-8">
                  <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                      Create an employee
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                      Use a permanent address where you can receive mail.
                    </p>
                  </div>
                  <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <label for="name" class="block text-sm font-medium text-gray-700">
                        First name
                      </label>
                      <div class="mt-1">
                        <Field
                          type="text"
                          name="name"
                          id="name"
                          autocomplete="given-name"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="name" />
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label
                        for="surname"
                        class="block text-sm font-medium text-gray-700"
                      >
                        Last name
                      </label>
                      <div class="mt-1">
                        <Field
                          type="text"
                          name="surname"
                          id="surname"
                          autocomplete="given-name"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="surname" />
                      </div>
                    </div>

                    <div class="sm:col-span-4">
                      <label for="email" class="block text-sm font-medium text-gray-700">
                        Email address
                      </label>
                      <div class="mt-1">
                        <Field
                          id="email"
                          name="email"
                          type="email"
                          autocomplete="email"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="email" />
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label
                        for="position"
                        class="block text-sm font-medium text-gray-700"
                      >
                        Position
                      </label>
                      <div class="mt-1">
                        <Field
                          id="position"
                          name="position"
                          as="select"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        >
                          <option value="Manager">Manager</option>
                          <option value="Junior Python Developer">
                            Junior Python Developer
                          </option>
                        </Field>
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="position"
                          >position is a required field</ErrorMessage
                        >
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="salary" class="block text-sm font-medium text-gray-700">
                        Salary
                      </label>
                      <div class="mt-1">
                        <Field
                          type="number"
                          name="salary"
                          id="salary"
                          autocomplete="given-name"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="salary" />
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="admin" class="block text-sm font-medium text-gray-700">
                        Admin
                      </label>
                      <div class="mt-1">
                        <Field
                          name="is_admin"
                          as="select"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        >
                          <option :value="true">Yes</option>
                          <option :value="false" selected>No</option>
                        </Field>
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="is_admin"
                          >admin is a required field</ErrorMessage
                        >
                      </div>
                    </div>

                    <div class="sm:col-span-4">
                      <label
                        for="password"
                        class="block text-sm font-medium text-gray-700"
                      >
                        Password
                      </label>
                      <div class="mt-1">
                        <Field
                          type="password"
                          name="password"
                          id="password"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="password" />
                      </div>
                    </div>

                    <div class="sm:col-span-4">
                      <label
                        for="password_confirmation"
                        class="block text-sm font-medium text-gray-700"
                      >
                        Confirm password
                      </label>
                      <div class="mt-1">
                        <Field
                          type="password"
                          name="password_confirmation"
                          id="password_confirmation"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        />
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="password_confirmation" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="pt-5">
                <div class="flex justify-end">
                  <button
                    type="button"
                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    @click="open = false"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Save
                  </button>
                </div>
              </div>
            </Form>
            <!--
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
             
              <button
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                @click="deleteEmployee(empId)"
              >
                Delete
              </button>

              <button
                type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                @click="open = false"
              >
                Cancel
              </button>
            </div>
            -->
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref, watch, onMounted, onBeforeUnmount } from "vue";
import {
  Dialog,
  DialogOverlay,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { ExclamationTriangleIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import useEventsBus from "@/composables/eventBus";
import EmployeeDataService from "@/services/EmployeeDataService";
import ToastService from "@/services/ToastService";

import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { useRouter } from "vue-router";

import { useErrorStore } from "../../../stores/useError";

let open = ref(false);
const empId = ref(0);
//open.value = true;
const { bus, emit } = useEventsBus();

function toggleModal() {
  open.value = !open.value;
}
/*
function deleteEmployee() {
  alert("works");
}
*/

watch(
  () => bus.value.get("showCreatingNewEmployeeModal"),
  () => {
    toggleModal();
  }
);

//const credentials = ref({});
const loading = ref(false);
const router = useRouter();
const error = useErrorStore();
const user = {
  email: "t.cruise@gmail.com",
  password: "tCruise12?3",
};

const onSubmit = async (newUserData) => {
  console.log(newUserData);
  //loading.value = !loading.value

  console.log(newUserData);
  EmployeeDataService.create(newUserData)
    .then(() => {
      ToastService.showToast("Employee created");
      router.go();
    })
    .catch((error) => {
      const message =
        (error.response && error.response.data && error.response.data.message) ||
        error.message ||
        error.toString();
      console.log(message);
      ToastService.showToast(error.message);
    });
};

const schema = yup.object({
  name: yup.string().required().min(2).max(30),
  surname: yup.string().required().min(2).max(50),
  email: yup.string().required().email(),
  position: yup.string().required(),
  salary: yup.number().required().min(4),
  is_admin: yup.boolean().required(),
  password: yup
    .string()
    .required()
    .min(8)
    .max(20)
    .matches(
      /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/,
      "must contain 8 characters, one uppercase, one lowercase, one number and one special case character"
    ),
  password_confirmation: yup
    .string()
    .required("confirm password is required field")
    .oneOf([yup.ref("password"), null], "passwords must match"),
});

function onInvalidSubmit({ values, errors, results }) {
  console.log(values); // current form values
  console.log(errors); // a map of field names and their first error message
  console.log(results); // a detailed map of field names and their validation results
  //console.log(email);
}

onBeforeUnmount(() => error.$reset());
</script>
