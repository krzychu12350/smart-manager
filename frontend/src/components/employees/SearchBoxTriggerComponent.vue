<template>
  <div>
    <label for="search" class="block text-sm font-medium text-gray-700"
      >Quick search</label
    >
    <div
      @click="emit('showEmployeesSearchEngine')"
      class="mt-1 relative flex items-center"
    >
      <input
        type="text"
        name="search"
        id="search"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md"
        disabled
      />
      <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
        <kbd
          class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400"
        >
          ctrl + k
          <hotkeys :shortcuts="['K']" @triggered="onTriggeredEventHandler" />
        </kbd>
      </div>
    </div>
  </div>
</template>
<script setup>
import Hotkeys from "vue-hotkeys-rt";
import useEventsBus from "@/composables/eventBus";
const { emit } = useEventsBus();
function onTriggeredEventHandler(payload) {
  emit("showEmployeesSearchEngine");
}
</script>
