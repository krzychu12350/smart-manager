<template>
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link> |
    <router-link to="/test-fetching">Fetched Data From The API</router-link> |
    <router-link to="/login">Login</router-link>
  </nav>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png" />
    <HelloWorld msg="Welcome to Your Vue.js + TypeScript App" />
  </div>
</template>

<script>


export default {
  name: "HomeView",
  components: {

  },
};
</script>
