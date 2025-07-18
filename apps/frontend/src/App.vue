<script setup lang="ts">
  import NavigationBar  from "./components/NavigationBar/NavigationBar.vue";
  //import WelcomeItem from './WelcomeItem.vue'
  import { routeLocationKey, RouterLink, RouterView } from 'vue-router'
  import { ref, onMounted } from 'vue'

</script>

<template>


  <div v-if="$route.meta.requirestAuth">
    <NavigationBar />
  </div>
  
  <RouterView />
</template>
