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
              :initial-values="formValues"
              method="POST"
              class="space-y-8 divide-y divide-gray-200"
            >
              <div class="space-y-8 divide-y divide-gray-200">
                <div class="pt-8">
                  <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                      Edit your personal details
                    </h3>
                  </div>
                  <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <label for="ame" class="block text-sm font-medium text-gray-700">
                        First Name
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
                        for="last-name"
                        class="block text-sm font-medium text-gray-700"
                      >
                        Last name
                      </label>
                      <div class="mt-1">
                        <Field
                          type="text"
                          name="surname"
                          id="surname"
                          autocomplete="family-name"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        ></Field>
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="surname" />
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="salary" class="block text-sm font-medium text-gray-700">
                        Salary
                      </label>
                      <div class="mt-1">
                        <Field
                          id="salary"
                          name="salary"
                          type="text"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        >
                        </Field>
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="salary"
                          >Salary field is a required field</ErrorMessage
                        >
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
                          as="textarea"
                          type="textarea"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        >
                          <textarea type="text" value="rrwr"></textarea>
                        </Field>
                      </div>
                      <div class="text-sm text-red-600">
                        <ErrorMessage name="position"
                          >Position field is required</ErrorMessage
                        >
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
                    Save changes
                  </button>
                </div>
              </div>
            </Form>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref, watch, inject } from "vue";
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import useEventsBus from "../../../composables/eventBus";
import * as yup from "yup";
import ToastService from "@/services/ToastService";
import { Form, Field, ErrorMessage } from "vee-validate";
import UserDataService from "../../../services/UserDataService";

const currentUserData = ref();

let open = ref(false);
const { bus, emit } = useEventsBus();

function toggleModal() {
  open.value = !open.value;
}

// Initial values
let formValues = {};

watch(
  () => bus.value.get("showEditingExistingUserModal"),
  (val) => {
    currentUserData.value = val[0];
    formValues = {
      name: String(currentUserData.value.name),
      surname: String(currentUserData.value.surname),
      salary: String(currentUserData.value.salary),
      position: String(currentUserData.value.position),
    };
    toggleModal();
  }
);

const $loading = inject("$loading");

const onSubmit = async (employeeUpdatedData) => {
  const loader = $loading.show();
  employeeUpdatedData.is_owner = 1;
  UserDataService.update(currentUserData.value.id, employeeUpdatedData)
    .then(async (res) => {
      toggleModal();
      await ToastService.showToast(res.data.message);
      emit("refreshUserDetails");
      loader.hide();
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
  name: yup.string().required("Name field is required").min(1),
  surname: yup.string().required("Surname field is required").min(1),
  salary: yup.number().required().min(4),
  position: yup.string().required().min(3),
});

function onInvalidSubmit({ values, errors, results }) {
  console.log(values); // current form values
  console.log(errors); // a map of field names and their first error message
  console.log(results); // a detailed map of field names and their validation results
}
</script>
