<script setup lang="ts">
import bgPattern from '../assets/Background2.png'
import HeaderComponent from './HeaderComponent.vue'

defineProps<{
  title: string
  breadcrumb: string
}>()
</script>

<template>
  <HeaderComponent />
  <div class="page-header">
    <div class="content">
      <h1>{{ title }}</h1>
      <div class="breadcrumb">
        <span>Home</span>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        <span>Categories</span>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        <span class="current">{{ breadcrumb }}</span>
      </div>
    </div>
  </div>
</template>

<style scoped>
.page-header {
  position: relative; 
  height: 200px;
  background-color: #DEF9EC; 
  border-radius: 20px;
  display: flex;
  align-items: center;
  padding: 0 60px;
  margin-bottom: 30px;
  overflow: hidden; 
}

.page-header::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: v-bind("`url('${bgPattern}')`");
  background-size: cover;
  background-position: center;
  opacity: 0.2; 
  mix-blend-mode: multiply; 
  z-index: 0; 
}

.content {
  position: relative;
  z-index: 1; 
}

.content h1 {
  font-family: 'Quicksand', sans-serif;
  font-size: 48px;
  font-weight: 700;
  color: #253d4e;
  margin-bottom: 10px;
}

.breadcrumb {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #7e7e7e;
  font-size: 14px;
  font-weight: 600;
}

.breadcrumb i {
  font-size: 10px;
  color: #7e7e7e;
  opacity: 0.6;
}

.breadcrumb .current {
  color: #3bb77e;
}
</style>
