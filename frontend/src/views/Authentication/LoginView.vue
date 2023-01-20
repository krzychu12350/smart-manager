<template>
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
            to="/register/employee"
            class="font-medium text-indigo-600 hover:text-indigo-500"
            >create an employee account</RouterLink
          >
        </p>
        <p class="mt-2 text-center text-sm text-gray-600">
          Or
          {{ " " }}
          <RouterLink
            to="/register/owner"
            class="font-medium text-indigo-600 hover:text-indigo-500"
            >create an owner account</RouterLink
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
            <div class="relative">
              <Field
                id="password"
                name="password"
                autocomplete="current-password"
                required=""
                class="block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                placeholder="Password"
                :type="[showPassword ? 'text' : 'password']"
              >
              </Field>
              <div
                class="absolute inset-y-0 right-0 flex items-center mr-3 cursor-pointer"
              >
                <EyeIcon
                  v-if="showPassword === true"
                  class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                  aria-hidden="true"
                  @click="togglePasswordVisibity"
                />
                <EyeSlashIcon
                  v-else
                  @click="togglePasswordVisibity"
                  class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                  aria-hidden="true"
                />
              </div>
            </div>
          </div>
          <div class="text-sm text-red-600">
            <ErrorMessage name="password" />
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
import { LockClosedIcon, EyeIcon, EyeSlashIcon } from "@heroicons/vue/20/solid";
import ToastService from "../../services/ToastService";
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { ref, onBeforeUnmount, inject } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../../stores/useAuth";
import { useErrorStore } from "../../stores/useError";

const $loading = inject("$loading");
const fullPage = ref(true);
const router = useRouter();
const error = useErrorStore();
const showPassword = ref(false);
const togglePasswordVisibity = () => {
  showPassword.value = !showPassword.value;
};

const onSubmit = (credentials) => {
  const loader = $loading.show();

  useAuthStore()
    .login(credentials)
    .then(() => {
      router.push({ name: "home" });
      loader.hide();
    })
    .catch((err) => {
      loader.hide();
      console.log(err);
      ToastService.showToast("Invalid email or password");
    });
};

const schema = yup.object({
  email: yup
    .string()
    .required("Email is a required field")
    .email("Email must be a valid email"),
  password: yup
    .string()
    .required("Password is a required field")
    .min(8, "Password must be at least 8 characters"),
});

function onInvalidSubmit({ values, errors, results }) {
  console.log(values); // current form values
  console.log(errors); // a map of field names and their first error message
  console.log(results); // a detailed map of field names and their validation results
}

onBeforeUnmount(() => error.$reset());
</script>
