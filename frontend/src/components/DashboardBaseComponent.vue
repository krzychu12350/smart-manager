<template>
  <div>
    <SidebarComponent />
    <div class="md:pl-64 flex flex-col flex-1">
      <TopBarComponent></TopBarComponent>
      <main>
        <div class="py-6">
          <div class="max-w-12xl mx-auto px-4 sm:px-6 md:px-8">
            <slot name="subpage-header"></slot>
          </div>
          <div class="max-w-12xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-4">
              <slot name="subpage-content"></slot>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import SidebarComponent from "@/components/SidebarComponent.vue";
import TopBarComponent from "./TopBarComponent.vue";
</script>
