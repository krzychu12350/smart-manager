<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-200"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <DialogOverlay
            class="fixed inset-0 bg-gray-400 bg-opacity-75 transition-opacity"
          />
        </TransitionChild>
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to="opacity-100 translate-y-0 sm:scale-100"
          leave="ease-in duration-200"
          leave-from="opacity-100 translate-y-0 sm:scale-100"
          leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
          >
            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
              <button
                type="button"
                class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                @click="open = false"
              >
                <span class="sr-only">Close</span>
                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
              </button>
            </div>

            <Form
              @submit="onSubmit"
              :validation-schema="schema"
              @invalid-submit="onInvalidSubmit"
              method="GET"
              v-slot="{ values }"
              class="space-y-8 divide-y divide-gray-200"
            >
              <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                <div>
                  <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                      Employee Profile
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      This is employee's personal details.
                    </p>
                  </div>

                  <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                    <div
                      class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                    >
                      <label
                        for="username"
                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                      >
                        First Name
                      </label>
                      <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <span
                          class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                        >
                          {{ employee.name }}
                        </span>
                      </div>
                    </div>

                    <div
                      class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                    >
                      <label
                        for="username"
                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                      >
                        Last Name
                      </label>
                      <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <span
                          class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                        >
                          {{ employee.surname }}
                        </span>
                      </div>
                    </div>

                    <div
                      class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5"
                    >
                      <label for="photo" class="block text-sm font-medium text-gray-700">
                        Photo
                      </label>
                      <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <div class="flex items-center">
                          <vue-avatar
                            :username="employee.name + employee.surname"
                            :size="40"
                            border-radius="50%"
                            :lighten="200"
                          />
                        </div>
                      </div>
                    </div>

                    <div
                      class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                    >
                      <label
                        for="username"
                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                      >
                        Position
                      </label>
                      <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <span
                          class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                        >
                          {{ employee.position }}
                        </span>
                      </div>
                    </div>

                    <div
                      class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                    >
                      <label
                        for="username"
                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                      >
                        Salary
                      </label>
                      <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <span
                          class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                        >
                          {{ employee.salary }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div
                  class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5"
                >
                  <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                      Employee skills
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Evaluate the employee.
                    </p>
                  </div>
                  <!-- Job knowledge -->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Job Knowledge
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-job_knowledge"
                                    name="job_knowledge"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="job_knowledge"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-job_knowledge"
                                    name="job_knowledge"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-job_knowledge"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-job_knowledge"
                                    name="job_knowledge"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-job_knowledge"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-job_knowledge"
                                    name="job_knowledge"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="poor-job_knowledge"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="job_knowledge" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Productibity-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Productivity
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-productivity"
                                    name="productivity"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-productivity"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-productivity"
                                    name="productivity"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-productivity"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-productivity"
                                    name="productivity"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-productivity"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-productivity"
                                    name="productivity"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="poor-productivity"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="productivity" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Work quality-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Work quality
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-work_quality"
                                    name="work_quality"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-work_quality"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-work_quality"
                                    name="work_quality"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-work_quality"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-work_quality"
                                    name="work_quality"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-work_quality"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-work_quality"
                                    name="work_quality"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="poor-work_quality"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="work_quality" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Technical skills-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Technical skills
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-technical_skills"
                                    name="technical_skills"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-technical_skills"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-technical_skills"
                                    name="technical_skills"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-technical_skills"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-technical_skills"
                                    name="technical_skills"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-technical_skills"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-technical_skills"
                                    name="technical_skills"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="poor-technical_skills"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="technical_skills" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Work consistency-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Work consistency
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-work_consistency"
                                    name="work_consistency"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-work_consistency"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-work_consistency"
                                    name="work_consistency"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-work_consistency"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-work_consistency"
                                    name="work_consistency"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-work_consistency"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-work_consistency"
                                    name="work_consistency"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="poor-work_consistency"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="work_consistency" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Enthusiasm-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Enthusiasm
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-enthusiasm"
                                    name="enthusiasm"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-enthusiasm"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-enthusiasm"
                                    name="enthusiasm"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-enthusiasm"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-enthusiasm"
                                    name="enthusiasm"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-enthusiasm"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-enthusiasm"
                                    name="enthusiasm"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    id="poor-enthusiasm"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="enthusiasm" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Cooperation-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Cooperation
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-cooperation"
                                    name="cooperation"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-cooperation"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-cooperation"
                                    name="cooperation"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-cooperation"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-cooperation"
                                    name="cooperation"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-cooperation"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-cooperation"
                                    name="cooperation"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="poor-cooperation"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="cooperation" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Attitude-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Attitude
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-attitude"
                                    name="attitude"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-attitude"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-attitude"
                                    name="attitude"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-attitude"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-attitude"
                                    name="attitude"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-attitude"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-attitude"
                                    name="attitude"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="poor-attitude"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="attitude" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Initiative-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Initiative
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-initiative"
                                    name="initiative"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-initiative"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-initiative"
                                    name="initiative"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-initiative"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-initiative"
                                    name="initiative"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-initiative"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-initiative"
                                    name="initiative"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="poor-initiative"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="initiative" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Work relations-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Work relations
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    id="excellent-work_relations"
                                    name="work_relations"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="excellent-work_relations"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="good-work_relations"
                                    name="work_relations"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="good-work_relations"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="fair-work_relations"
                                    name="work_relations"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="fair-work_relations"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    id="poor-work_relations"
                                    name="work_relations"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="work_relations" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Creativity-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Creativity
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    name="creativity"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="creativity"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-email"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="creativity"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="creativity"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="creativity" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Punctuality-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Punctuality
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    name="punctuality"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-everything"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="punctuality"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-email"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="punctuality"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="punctuality"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="punctuality" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Attendance-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Attendance
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    name="attendance"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-everything"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="attendance"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-email"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="attendance"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="attendance"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="attendance" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Dependability-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Dependability
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    name="dependability"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-everything"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="dependability"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-email"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="dependability"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="dependability"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>
                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="dependability" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--Communication skills-->
                  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                      <div role="group" aria-labelledby="label-notifications">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                          <div>
                            <div
                              class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                              id="label-notifications"
                            >
                              Communication skills
                            </div>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="max-w-lg">
                              <p class="text-sm text-gray-500"></p>
                              <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                  <Field
                                    name="communication_skills"
                                    type="radio"
                                    value="1"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-everything"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Excellent
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="communication_skills"
                                    type="radio"
                                    value="2"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-email"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Good
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="communication_skills"
                                    type="radio"
                                    value="3"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Fair
                                  </label>
                                </div>
                                <div class="flex items-center">
                                  <Field
                                    name="communication_skills"
                                    type="radio"
                                    value="4"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                  />
                                  <label
                                    for="push-nothing"
                                    class="ml-3 block text-sm font-medium text-gray-700"
                                  >
                                    Poor
                                  </label>
                                </div>

                                <div class="text-sm text-red-600">
                                  <ErrorMessage name="communication_skills" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
              >
                <label
                  for="reviewer_comment"
                  class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                >
                  Additional remarks
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                  <Field
                    id="reviewer_comment"
                    name="reviewer_comment"
                    rows="3"
                    as="textarea"
                    class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"
                  />
                  <p class="mt-2 text-sm text-gray-500">
                    Write a few sentences about employee.
                  </p>
                  <div class="text-sm text-red-600">
                    <ErrorMessage name="reviewer_comment" />
                  </div>
                </div>
              </div>

              <div class="pt-5">
                <div class="flex justify-end">
                  <button
                    @click="open = false"
                    type="button"
                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Download
                  </button>
                </div>
              </div>
            </Form>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref, watch, inject } from "vue";
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import useEventsBus from "@/composables/eventBus";
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { storeToRefs } from "pinia";
import { useAuthStore } from "../../../stores/useAuth";
import PdfDataService from "@/services/PdfDataService";
import VueAvatar from "@webzlodimir/vue-avatar";
import "@webzlodimir/vue-avatar/dist/style.css";

const $loading = inject("$loading");

const userStore = useAuthStore();
const { userData } = storeToRefs(userStore);

const loggedInOwner = userData.value;

let open = ref(false);
const employee = ref({});

const { bus } = useEventsBus();

function toggleModal() {
  open.value = !open.value;
}

const countOverallRating = (formData) => {
  const allMarks = Object.values(formData);
  allMarks.pop();
  allMarks.map(Number);
  var numberArray = [];
  allMarks.forEach((ele) => numberArray.push(+ele));
  const sum = numberArray.reduce((a, b) => parseInt(a) + parseInt(b), 0);
  const avg = sum / numberArray.length || 0;
  if (avg < 2) {
    return 1;
  } else if (avg >= 2 && avg < 3) {
    return 2;
  } else if (avg >= 3 && avg < 4) {
    return 3;
  } else {
    return 4;
  }
};

function generateEmployeeEvaulationPDF(data) {
  const loader = $loading.show();
  PdfDataService.getEmployeeEvaluationPDF(data)
    .then((response) => {
      if (response.status == 200) {
        let blob = new Blob([response.data], { type: "application/pdf" });
        let fileURL = window.URL.createObjectURL(blob);
        loader.hide();
        window.open(fileURL, "_self");
      }
    })
    .catch((error) => {
      console.log(error);
    });
}

const onSubmit = async (formData) => {
  const ownerAndEmployeeData = {
    reviewer_id: loggedInOwner.user_id,
    company_id: loggedInOwner.user_company_id,
    employee_id: employee.value.id,
    overall_rating: countOverallRating(formData),
  };
  const requestPayload = { ...formData, ...ownerAndEmployeeData };

  generateEmployeeEvaulationPDF(requestPayload);
};

const schema = yup.object({
  attendance: yup.number().required(),
  attitude: yup.number().required(),
  communication_skills: yup.number().required(),
  cooperation: yup.number().required(),
  creativity: yup.number().required(),
  dependability: yup.number().required(),
  enthusiasm: yup.number().required(),
  initiative: yup.number().required(),
  job_knowledge: yup.number().required(),
  productivity: yup.number().required(),
  punctuality: yup.number().required(),
  reviewer_comment: yup
    .string()
    .min(8, "Additional remarks  must be at least 8 characters")
    .max(255, "Additional remarks must be at most 255 characters"),
  technical_skills: yup.number().required(),
  work_consistency: yup.number().required(),
  work_quality: yup.number().required(),
  work_relations: yup.number().required(),
});

function onInvalidSubmit({ values, errors, results }) {
  console.log(values); // current form values
  console.log(errors); // a map of field names and their first error message
  console.log(results); // a detailed map of field names and their validation results
}

watch(
  () => bus.value.get("showEmployeeEvaluationForm"),
  (data) => {
    employee.value = data[0].employee;
    toggleModal();
  }
);
</script>
