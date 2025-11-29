<script setup lang="ts">
import { RouterView } from 'vue-router'
import HeaderComponent from './components/HeaderComponent.vue';
</script>

<template>
  <div class="app-container">
    <HeaderComponent />
    <RouterView />
  </div>
</template>

<style scoped>
.app-container {
  padding: 20px;
  max-width: 1556px;
  margin: 0 auto;
  font-family: 'Quicksand', sans-serif;
}
</style>