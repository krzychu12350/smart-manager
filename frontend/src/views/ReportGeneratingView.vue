<template>
  <Dashboard>
    <template v-slot:subpage-content>
      <!-- Page header -->
      <div
        class="min-w-8xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between lg:min-w-8xl lg:px-8"
      >
        <!--
        <div class="flex items-center space-x-5">
          <div class="flex-shrink-0">
            <div class="relative">
              <img
                class="h-16 w-16 rounded-full"
                src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80"
                alt=""
              />
              <span
                class="absolute inset-0 shadow-inner rounded-full"
                aria-hidden="true"
              />
            </div>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Ricardo Cooper</h1>
            <p class="text-sm font-medium text-gray-500">
              Owner of <a href="#" class="text-gray-900">Google</a> since
              <time datetime="2020-08-25">August 25, 2020</time>
            </p>
          </div>
        </div>
      
        <div
          class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3"
        >
          <button
            type="button"
            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
          >
            Browse employees
          </button>
          <button
            type="button"
            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
          >
            Generate raports
          </button>
        </div>
        -->
      </div>

      <div
        class="min-w-8xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:min-w-8xl lg:grid-flow-col-dense lg:grid-cols-3"
      >
        <div class="space-y-6 lg:col-start-1 lg:col-span-2">
          <!-- Description list-->
          <section aria-labelledby="applicant-information-title">
            <div class="bg-white shadow sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6">
                <h2
                  id="applicant-information-title"
                  class="text-lg leading-6 font-medium text-gray-900"
                >
                  Generate salary report
                </h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                  Fill in details to generate report.
                </p>
              </div>
              <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-1">
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Period</dt>
                    <!--<dd class="mt-1 text-sm text-gray-900">Backend Developer</dd>-->
                    <vue-tailwind-datepicker
                      :formatter="formatter"
                      v-model="dateValue"
                      class="mt-2"
                    />
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Company</dt>
                    <select
                      id="location"
                      name="location"
                      class="mt-2 block w-full pl-3 pr-10 py-2 pb-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                    >
                      <option>Facebook</option>
                      <option selected="">Amazon</option>
                      <option>Google</option>
                    </select>
                  </div>

                  <!--
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                    <dd class="mt-1 text-sm text-gray-900">ricardocooper@example.com</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Salary expectation</dt>
                    <dd class="mt-1 text-sm text-gray-900">$120,000</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900">+1 555-555-5555</dd>
                  </div>
             
                  <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">About</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim
                      incididunt cillum culpa consequat. Excepteur qui ipsum aliquip
                      consequat sint. Sit id mollit nulla mollit nostrud in ea officia
                      proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit
                      deserunt qui eu.
                    </dd>
                  </div>
                
                  <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <ul
                        role="list"
                        class="border border-gray-200 rounded-md divide-y divide-gray-200"
                      >
                        <li
                          v-for="attachment in attachments"
                          :key="attachment.name"
                          class="pl-3 pr-4 py-3 flex items-center justify-between text-sm"
                        >
                          <div class="w-0 flex-1 flex items-center">
                            <PaperClipIcon
                              class="flex-shrink-0 h-5 w-5 text-gray-400"
                              aria-hidden="true"
                            />
                            <span class="ml-2 flex-1 w-0 truncate">
                              {{ attachment.name }}
                            </span>
                          </div>
                          <div class="ml-4 flex-shrink-0">
                            <a
                              :href="attachment.href"
                              class="font-medium text-blue-600 hover:text-blue-500"
                            >
                              Download
                            </a>
                          </div>
                        </li>
                      </ul>
                    </dd>
                  </div>
                   -->
                </dl>
              </div>

              <div>
                <a
                  href="#"
                  class="bg-indigo-600 hover:bg-indigo-700 block bg-gray-50 text-sm font-medium text-white text-center px-4 py-4 hover:text-white sm:rounded-b-lg"
                  >Generate</a
                >
              </div>
            </div>
          </section>

          <!-- Comments
          <section aria-labelledby="notes-title">
            <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
              <div class="divide-y divide-gray-200">
                <div class="px-4 py-5 sm:px-6">
                  <h2 id="notes-title" class="text-lg font-medium text-gray-900">
                    Notes
                  </h2>
                </div>
                <div class="px-4 py-6 sm:px-6">
                  <ul role="list" class="space-y-8">
                    <li v-for="comment in comments" :key="comment.id">
                      <div class="flex space-x-3">
                        <div class="flex-shrink-0">
                          <img
                            class="h-10 w-10 rounded-full"
                            :src="`https://images.unsplash.com/photo-${comment.imageId}?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80`"
                            alt=""
                          />
                        </div>
                        <div>
                          <div class="text-sm">
                            <a href="#" class="font-medium text-gray-900">{{
                              comment.name
                            }}</a>
                          </div>
                          <div class="mt-1 text-sm text-gray-700">
                            <p>{{ comment.body }}</p>
                          </div>
                          <div class="mt-2 text-sm space-x-2">
                            <span class="text-gray-500 font-medium">{{
                              comment.date
                            }}</span>
                            {{ " " }}
                            <span class="text-gray-500 font-medium">&middot;</span>
                            {{ " " }}
                            <button type="button" class="text-gray-900 font-medium">
                              Reply
                            </button>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-6 sm:px-6">
                <div class="flex space-x-3">
                  <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
                  </div>
                  <div class="min-w-0 flex-1">
                    <form action="#">
                      <div>
                        <label for="comment" class="sr-only">About</label>
                        <textarea
                          id="comment"
                          name="comment"
                          rows="3"
                          class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border border-gray-300 rounded-md"
                          placeholder="Add a note"
                        />
                      </div>
                      <div class="mt-3 flex items-center justify-between">
                        <a
                          href="#"
                          class="group inline-flex items-start text-sm space-x-2 text-gray-500 hover:text-gray-900"
                        >
                          <QuestionMarkCircleIcon
                            class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                            aria-hidden="true"
                          />
                          <span> Some HTML is okay. </span>
                        </a>
                        <button
                          type="submit"
                          class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                          Comment
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
          -->
        </div>
      </div>
    </template>
  </Dashboard>
</template>
<script setup>
import Dashboard from "../components/DashboardBaseComponent.vue";
import { ref } from "vue";
const dateValue = ref([]);
const formatter = ref({
  date: "DD MMM YYYY",
  month: "MMM",
});
</script>
