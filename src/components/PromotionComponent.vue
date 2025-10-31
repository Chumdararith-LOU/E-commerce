<script setup lang="ts">
import ButtonComponent from './ButtonComponent.vue'

defineProps<{
  title: string
  buttonText: string
  image: string
  Card_color: string
  buttonColor: string
}>()

</script>

<template>
  <div class="promotion-card" :style="{ backgroundColor: Card_color }">
    <div id="title">
      <h2>{{ title }}</h2>
      <ButtonComponent :text="buttonText" :color="buttonColor" :title="title"/>
    </div>
    <div class="card-image-placeholder"></div>
    <div class="promotion-image"><img :src="image" :alt="title" /></div>
  </div>
</template>

<style scoped>
.promotion-card {
  position: relative;
  width: 32%;
  height: 300px;
  padding: 20px;
  border-radius: 10px;
  box-sizing: border-box;
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.05);
}
#title {
  display: flex;
  flex-direction: column;
  gap: 1.5em;
  position: absolute;
  top: 75px; 
  left: 48px;
  z-index: 2; 
  color: black;
  max-width: 271px;

}

.promotion-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 20px; 
}

#title h2 {
  font-family: 'Quicksand', sans-serif;
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0;
  line-height: 32px;
  letter-spacing: -0.04em;
  color: #000;
  margin: 0;
  opacity: 1;
}

.promotion-image {
  flex: 1;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.promotion-image img {
  max-width: 500px;
  max-height: 100%;
  object-fit: contain;
  position: absolute;
  bottom: 0;
  right: 0;
}
</style>
