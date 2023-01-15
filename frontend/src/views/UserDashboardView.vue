<template>
  <Dashboard>
    <template v-slot:subpage-content>
      <!--<h1>My profile</h1>-->

      <!-- Page header -->
      <div
        class="min-w-8xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:min-w-8xl lg:px-8"
      >
        <div class="flex items-center space-x-5">
          <div class="flex-shrink-0">
            <div class="relative">
              <!--
              <img
                class="h-16 w-16 rounded-full"
                src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80"
                alt=""
              />
              -->
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
              <!--
              <div class="px-4 py-5 sm:px-6">
                <h2
                  id="applicant-information-title"
                  class="text-lg leading-6 font-medium text-gray-900"
                >
                  Your Information
                </h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Your personal details.</p>
              </div>
              -->
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
                  <!--
                  <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">About me</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim
                      incididunt cillum culpa consequat. Excepteur qui ipsum aliquip
                      consequat sint. Sit id mollit nulla mollit nostrud in ea officia
                      proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit
                      deserunt qui eu.
                    </dd>
                  </div>
                  -->
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
                    {{ moment(String(companyDataDetails.created_at)).format("YYYY") }}
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
            <!--
            <div class="mt-6 flex flex-col justify-stretch">
              <button
                type="button"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              >
                Advance to offer
              </button>
            </div>
              -->
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
/*
import
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Popover,
  PopoverButton,
  PopoverOverlay,
  PopoverPanel,
  TransitionChild,
  TransitionRoot,
 @headlessui/vue";
 */
import {
  // ArrowNarrowLeftIcon,
  CheckIcon,
  // HomeIcon,
  PaperClipIcon,
  QuestionMarkCircleIcon,
  //SearchIcon,
  //ThumbUpIcon,
  UserIcon,
} from "@heroicons/vue/24/solid";
//import { BellIcon, MenuIcon, XIcon } from "@heroicons/vue/24/outline";
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
      console.log(userDataDetails.value);
    })
    .catch((err) => {
      console.log(err);
    });
}

function getComapnyDetails() {
  ComapnyDataService.get(userCompanyId.value)
    .then((res) => {
      companyDataDetails.value = res.data.company;
      console.log(companyDataDetails.value);
    })
    .catch((err) => {
      //console.log(err);
    });
}

onMounted(() => {
  if (isOwner === 1) getComapnyDetails();
  getUserDetails();
});

const user = {
  name: "Whitney Francis",
  email: "whitney@example.com",
  imageUrl:
    "https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80",
};
const navigation = [
  { name: "Dashboard", href: "#" },
  { name: "Jobs", href: "#" },
  { name: "Applicants", href: "#" },
  { name: "Company", href: "#" },
];
const breadcrumbs = [
  { name: "Jobs", href: "#", current: false },
  { name: "Front End Developer", href: "#", current: false },
  { name: "Applicants", href: "#", current: true },
];
const userNavigation = [
  { name: "Your Profile", href: "#" },
  { name: "Settings", href: "#" },
  { name: "Sign out", href: "#" },
];
const attachments = [
  { name: "resume_front_end_developer.pdf", href: "#" },
  { name: "coverletter_front_end_developer.pdf", href: "#" },
];

const eventTypes = {
  applied: { icon: UserIcon, bgColorClass: "bg-gray-400" },
  advanced: { icon: UserIcon, bgColorClass: "bg-blue-500" },
  completed: { icon: CheckIcon, bgColorClass: "bg-green-500" },
};
const timeline = [
  {
    id: 1,
    type: eventTypes.applied,
    content: "Applied to",
    target: "Front End Developer",
    date: "Sep 20",
    datetime: "2020-09-20",
  },
  {
    id: 2,
    type: eventTypes.advanced,
    content: "Advanced to phone screening by",
    target: "Bethany Blake",
    date: "Sep 22",
    datetime: "2020-09-22",
  },
  {
    id: 3,
    type: eventTypes.completed,
    content: "Completed phone screening with",
    target: "Martha Gardner",
    date: "Sep 28",
    datetime: "2020-09-28",
  },
  {
    id: 4,
    type: eventTypes.advanced,
    content: "Advanced to interview by",
    target: "Bethany Blake",
    date: "Sep 30",
    datetime: "2020-09-30",
  },
  {
    id: 5,
    type: eventTypes.completed,
    content: "Completed interview with",
    target: "Katherine Snyder",
    date: "Oct 4",
    datetime: "2020-10-04",
  },
];
const comments = [
  {
    id: 1,
    name: "Leslie Alexander",
    date: "4d ago",
    imageId: "1494790108377-be9c29b29330",
    body:
      "Ducimus quas delectus ad maxime totam doloribus reiciendis ex. Tempore dolorem maiores. Similique voluptatibus tempore non ut.",
  },
  {
    id: 2,
    name: "Michael Foster",
    date: "4d ago",
    imageId: "1519244703995-f4e0f30006d5",
    body:
      "Et ut autem. Voluptatem eum dolores sint necessitatibus quos. Quis eum qui dolorem accusantium voluptas voluptatem ipsum. Quo facere iusto quia accusamus veniam id explicabo et aut.",
  },
  {
    id: 3,
    name: "Dries Vincent",
    date: "4d ago",
    imageId: "1506794778202-cad84cf45f1d",
    body:
      "Expedita consequatur sit ea voluptas quo ipsam recusandae. Ab sint et voluptatem repudiandae voluptatem et eveniet. Nihil quas consequatur autem. Perferendis rerum et.",
  },
];

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
