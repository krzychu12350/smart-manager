<template>
  <div class="about">
    <h1>This is data fetched from the Laravel API</h1>
    <!--{{ person.id }} {{ person.name }} {{ person.surname }}-->
  </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";
export default defineComponent({
  name: "HomeView",
  data() {
    return {
      person: Array,
    };
  },
  mounted() {
    this.fetchTestData();
  },
  methods: {
    fetchTestData() {
      this.axios.get("http://127.0.0.1:8000/api/testt").then((response) => {
        this.person = response.data.data;
        console.log(this.person);
      });
    },
  },
});
</script>
