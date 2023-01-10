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
        <img
          class="mx-auto h-12 w-auto"
          src="../../assets/logo.png"
          alt="Smart Manager"
        />
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
          Sign in to your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Or
          {{ " " }}
          <RouterLink
            to="/register"
            class="font-medium text-indigo-600 hover:text-indigo-500"
            >create an account</RouterLink
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
        <div class="-space-y-px rounded-md shadow-sm">
          <div class="mb-4">
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
          <div>
            <label for="password" class="sr-only">Password</label>
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
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember-me"
              name="remember-me"
              type="checkbox"
              class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
            />
            <label for="remember-me" class="ml-2 block text-sm text-gray-900"
              >Remember me</label
            >
          </div>

          <div class="text-sm">
            <RouterLink
              to="/reset-password"
              class="font-medium text-indigo-600 hover:text-indigo-500"
              >Forgot your password?</RouterLink
            >
          </div>
        </div>

        <div>
          <button
            type="submit"
            @click="showToast"
            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <LockClosedIcon
                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                aria-hidden="true"
              />
            </span>
            Sign in
          </button>
        </div>
      </Form>
    </div>
  </div>
</template>

<script setup>
import { LockClosedIcon } from "@heroicons/vue/20/solid";
import ToastService from "../../services/ToastService";
import UserAuthService from "../../services/UserAuthService";

import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
/*
export default {
  name: "LoginView",
  setup() {
  },
  methods: {
    showToast() {
      ToastService.showToast('Test of Toast')
      router.router.push('')
    },
    handleLogin() {
      const user = {
        email: "t.cruise@gmail.com",
        password: "tCruise12?3"
      };
      const res = UserAuthService.login(user)
      console.log(res)
    }
  },
  mounted() {
    this.handleLogin()
  },
}
*/
import { ref, onBeforeUnmount } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../../stores/useAuth";
import { useErrorStore } from "../../stores/useError";

//const credentials = ref({});
const loading = ref(false);
const router = useRouter();
const error = useErrorStore();
const user = {
  email: "t.cruise@gmail.com",
  password: "tCruise12?3",
};

const onSubmit = (credentials) => {
  loading.value = !loading.value;
  useAuthStore()
    .login(credentials)
    .then((response) => {
      //console.log(response);
      router.push({ name: "home" });
    })
    .catch(() => {
      loading.value = !loading.value;
      //console.log(e);
      ToastService.showToast("Invalid email or password");
    });
};

const schema = yup.object({
  email: yup.string().required().email(),
  password: yup.string().required().min(8),
});

function onInvalidSubmit({ values, errors, results }) {
  //console.log(values); // current form values
  console.log(errors); // a map of field names and their first error message
  //console.log(results); // a detailed map of field names and their validation results
  //console.log(email);
}

onBeforeUnmount(() => error.$reset());
</script>
