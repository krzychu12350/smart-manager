<template>
  <Dashboard>
    <template v-slot:subpage-content>
      <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">
              Application managment view
            </h1>
            <p class="mt-2 text-sm text-gray-700">
              A list of all the employees in your company including their name, title,
              email and role etc.
            </p>
          </div>
        </div>
      </div>
    </template>
  </Dashboard>
</template>
<script setup>
import Dashboard from "../components/DashboardBaseComponent.vue";
</script>
