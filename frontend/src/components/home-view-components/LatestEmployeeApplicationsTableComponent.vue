<template>
  <div class="z-1 flex flex-col">
    <div class="-my-3 overflow-x-auto sm:-mx-6 :-mx-8 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-t border-gray-200 sm:rounded-lg">
          <VTable
            sortHeaderClass="flex items-center justify-between w-full"
            :data="applications"
            class="min-w-full divide-y divide-gray-200"
            :filters="filters"
          >
            <template #head class="bg-gray-50">
              <tr>
                <VTh
                  sortKey="id"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  ID
                </VTh>

                <VTh
                  sortKey="user[0].surname"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Candidate
                </VTh>

                <VTh
                  sortKey="application_date"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Application date
                </VTh>
                <VTh
                  sortKey="status"
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Status
                </VTh>
              </tr>
            </template>
            <template #body="{ rows }" class="bg-white divide-y">
              <tr v-for="application in rows" :key="application.guid" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">#{{ application.id }}</div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ application.user[0].name }} {{ application.user[0].surname }}
                  </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <div class="text-sm text-gray-900">
                    {{ moment(application.application_date).format("LL") }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <span
                    :class="[statusStyles[String(application.status)]]"
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize"
                  >
                    {{ application.status }}
                  </span>
                </td>
              </tr>
            </template>
          </VTable>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, watch, inject } from "vue";
import useEventsBus from "@/composables/eventBus";
import ApplicationDataService from "../../services/ApplicationDataService";
import { useAuthStore } from "../../stores/useAuth";
import { storeToRefs } from "pinia";
import ToastService from "../../services/ToastService";
import moment from "moment";

const $loading = inject("$loading");

const { bus } = useEventsBus();

const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);
const user = userData.value;
const userCompanyId = user.user_company_id;

const applications = ref([]);
let filterName = ref("");

const getAllApplications = async (page = 1) => {
  ApplicationDataService.getAll(userCompanyId, page)
    .then(async (res) => {
      applications.value = await res.data.applications;
    })

    .catch((error) => {
      console.log(error.response.data);
    });
};

const filters = {
  name: { value: filterName, keys: ["user[0].surname"] },
};
const statusStyles = reactive({
  accepted: "bg-green-100 text-green-800",
  "in progress": "bg-yellow-100 text-yellow-800",
  rejected: "bg-red-100 text-red-800",
});

const updateApplicationStatus = async (applicationId, status) => {
  const loader = $loading.show();
  return ApplicationDataService.update(applicationId, status)
    .then(async (res) => {
      loader.hide();
      return res.data.message;
    })

    .catch((error) => {
      console.log(error.response.data);
    });
};

onMounted(() => {
  getAllApplications();
});

watch(
  () => bus.value.get("refreshApplicationTable"),
  () => {
    getAllApplications();
  }
);

watch(
  () => bus.value.get("updateApplicationStatus"),
  async (data) => {
    const messageFromAPI = await updateApplicationStatus(data[0].applicationId, {
      status: data[0].status,
    });
    ToastService.showToast(messageFromAPI);
    getAllApplications();
  }
);
</script>
