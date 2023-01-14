<template>
  <CreatingNewCompanyView
    v-if="isOwnerRegistered"
    :owner_id="registeredOwnerId"
    :owner_credentails="registeredOwnerData"
  ></CreatingNewCompanyView>
  <div
    v-else
    class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="w-full max-w-md space-y-8">
      <div>
        <img
          class="mx-auto h-12 w-auto"
          src="../../assets/logo.png"
          alt="Smart Manager"
        />
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
          Sign up to your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Or
          {{ " " }}
          <RouterLink
            to="/login"
            class="font-medium text-indigo-600 hover:text-indigo-500"
            >sign if if you already have an account</RouterLink
          >
        </p>
      </div>
      <Form
        @submit="onSubmit"
        :validation-schema="schema"
        @invalid-submit="onInvalidSubmit"
        class="mt-8 space-y-6"
        method="POST"
      >
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm">
          <div class="mb-4">
            <label for="email-address" class="sr-only">First name</label>
            <Field
              id="email-address"
              name="name"
              type="text"
              autocomplete="email"
              required=""
              class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
              placeholder="First name"
            />
            <div class="text-sm text-red-600">
              <ErrorMessage name="name" />
            </div>
          </div>
          <div class="mb-4">
            <label for="email-address" class="sr-only">Surname</label>
            <Field
              id="email-address"
              name="surname"
              type="text"
              autocomplete="email"
              required=""
              class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
              placeholder="Surname"
            />
            <div class="text-sm text-red-600">
              <ErrorMessage name="surname" />
            </div>
          </div>
          <div class="mt-4">
            <label for="email-address" class="sr-only">Email address</label>
            <Field
              id="email-address"
              name="email"
              type="email"
              autocomplete="email"
              required=""
              class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
              placeholder="Email address"
            />
            <div class="text-sm text-red-600">
              <ErrorMessage name="email" />
            </div>
          </div>
          <div class="mt-4">
            <label for="password" class="sr-only mt-8">Password</label>
            <Field
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required=""
              class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
              placeholder="Password"
            />
            <div class="text-sm text-red-600">
              <ErrorMessage name="password" />
            </div>
          </div>
        </div>
        <div class="mt-4">
          <label for="password_confirmation" class="sr-only mt-8"
            >Password confirmation</label
          >
          <Field
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="password_confirmation"
            required=""
            class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
            placeholder="Password confirmation"
          />
          <div class="text-sm text-red-600">
            <ErrorMessage name="password_confirmation" />
          </div>
        </div>

        <div>
          <button
            @click="handleRegister"
            type="submit"
            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <LockClosedIcon
                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                aria-hidden="true"
              />
            </span>
            Sign up
          </button>
        </div>
      </Form>
    </div>
  </div>
</template>

<script setup>
/*
import { LockClosedIcon } from '@heroicons/vue/20/solid'
import ToastService from "../services/ToastService";
import UserAuthService from '../services/UserAuthService';
import router from '../router';
export default {
  setup () {
  },
  methods: {
    showToast() {


    },
    handleRegister() {
      const newUser = {
        name: "Adam",
        surname: "Craft",
        email: "a.craft@gmail.com",
        password: "acraft123?!23"
      };
      const response = UserAuthService.register(newUser)
        .then(response => {
          ToastService.showToast(response.data.message)
          return response.data;
          //console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });

        router.push('/login')
    }
  },
  mounted() {
  },
}
*/

import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { ref, onBeforeUnmount, inject } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../../stores/useAuth";
import { useErrorStore } from "../../stores/useError";
import UserAuthService from "../../services/UserAuthService";
import ToastService from "../../services/ToastService";
import CreatingNewCompanyView from "@/views/CreatingNewCompanyView.vue";
import useEventsBus from "@/composables/eventBus";

const $loading = inject("$loading");
const fullPage = ref(true);
const { emit } = useEventsBus();
//const credentials = ref({});
const loading = ref(false);
let isOwnerRegistered = ref(false);
let registeredOwnerId = ref(0);
let registeredOwnerData = ref();
const router = useRouter();
const error = useErrorStore();
const user = {
  email: "t.cruise@gmail.com",
  password: "tCruise12?3",
};

const onSubmit = async (newUserData) => {
  //loading.value = !loading.value;
  const loader = $loading.show();
  console.log(newUserData);
  newUserData.is_owner = 1;
  console.log(newUserData.password_confirmation);
  registeredOwnerData.value = newUserData;
  console.log(newUserData);

  UserAuthService.register(newUserData)
    .then((res) => {
      console.log(res);
      ToastService.showToast(res.data.message);

      registeredOwnerId.value = res.data.employee.id;

      //console.log(registeredOwnerId.value);
      isOwnerRegistered.value = true;
      loader.hide();
      //router.push("/login");
    })
    .catch((error) => {
      const message =
        (error.response && error.response.data && error.response.data.message) ||
        error.message ||
        error.toString();
      console.log(message);
      ToastService.showToast(error.message);
    });

  emit("passNewOwnerId", { id: registeredOwnerId.value, new_owner_data: newUserData });
};

const schema = yup.object({
  name: yup
    .string()
    .required("Name is a required field")
    .min(2, "Name must be at least 2 characters"),
  surname: yup
    .string()
    .required("Surname is a required field")
    .min(2, "Surname must be at least 2 characters"),
  email: yup
    .string()
    .required("Email is a required field")
    .email("Email must be a valid email"),
  password: yup
    .string()
    .required("Password is a required field")
    .matches(
      /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/,
      "Password must contain 8 characters, one uppercase, one lowercase, one number and one special case character"
    ),
  password_confirmation: yup
    .string()
    .required("Password confirmation is a required field")
    .oneOf([yup.ref("password")], "Your passwords do not match."),
});

function onInvalidSubmit({ values, errors, results }) {
  //console.log(values); // current form values
  //console.log(errors); // a map of field names and their first error message
  //console.log(results); // a detailed map of field names and their validation results
  //console.log(email);
}

onBeforeUnmount(() => error.$reset());
</script>
