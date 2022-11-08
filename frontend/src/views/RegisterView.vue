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
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Or
          {{ ' ' }}
          <RouterLink to="/login" class="font-medium text-indigo-600 hover:text-indigo-500">sign if if you already have an account</RouterLink>
        </p>
      </div>
      <form @submit.prevent="onSubmit" class="mt-8 space-y-6" method="POST">
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm">
          <div class="mb-4">
            <label for="email-address" class="sr-only">First name</label>
            <input id="email-address" name="email" type="text" autocomplete="email" required="" class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="First name" />
          </div>
          <div class="mb-4">
            <label for="email-address" class="sr-only">Surname</label>
            <input id="email-address" name="email" type="text" autocomplete="email" required="" class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Surname" />
          </div>
          <div class="mt-4">
            <label for="email-address" class="sr-only">Email address</label>
            <input id="email-address" name="email" type="email" autocomplete="email" required="" class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address" />
          </div>
          <div class="mt-4">
            <label for="password" class="sr-only mt-8">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required="" class="relative block w-full appearance-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Password" />
          </div>
        </div>

        <div>
          <button @click="handleRegister" type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
            </span>
            Sign up
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
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
</script>