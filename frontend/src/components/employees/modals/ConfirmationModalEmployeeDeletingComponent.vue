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
            <div class="sm:flex sm:items-start">
              <div
                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
              >
                <ExclamationTriangleIcon
                  class="h-6 w-6 text-red-600"
                  aria-hidden="true"
                />
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                  Deactivate account

                  <slot name="dialog-title"></slot>
                </DialogTitle>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">
                    Are you sure you want to deactivate your account? All of your data
                    will be permanently removed from our servers forever. This action
                    cannot be undone.

                    <slot name="dialog-description"></slot>
                  </p>
                </div>
              </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
              <!--
              <slot name="dialog-action-confirm"></slot>
              -->
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
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";
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

const deleteEmployee = async (id) => {
  // alert("id usera " + id);
  toggleModal();
  EmployeeDataService.delete(id)
    .then((res) => {
      console.log(res);
      //employees.value.splice(index, 1);

      ToastService.showToast("Employee was deleted successfully");
      emit("refreshEmployeesTable");
      //console.log(employees);
    })
    .catch((error) => {
      console.log(error);
    });
};

watch(
  () => bus.value.get("showDeleteConfirmationModal"),
  (val, open) => {
    //console.log(val[0].employeeId);
    empId.value = val[0].employeeId;
    toggleModal();
    //console.log(open[0]);
    // destruct the parameters
    const [sidebarCollapsedBus] = val ?? [];
    //open = sidebarCollapsedBus.name;
    //open = sidebarCollapsedBus;
    //console.log("emitted" + sidebarCollapsedBus);
    //open.value = true;
    //open[0] = true;
    //open = true;
  }
);
</script>