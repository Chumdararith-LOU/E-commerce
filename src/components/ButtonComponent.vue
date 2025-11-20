<script setup lang="ts">
const props = defineProps<{
    text: string, 
    color: string,
    title: string
}>()

function shopNow(){
  alert("Let's shop " + props.title)
}
</script>

<template>
  <button @click="shopNow" class="promo-button" :style="{ backgroundColor: props.color }">
    {{ props.text }}
  </button>
</template>

<style scoped>
.promo-button {
  padding: 8px 15px;
  border: none;
  cursor: pointer;
  border-radius: 3px;
  max-width: 110px;
  max-height: 31px;
  color: white;
  font-weight: 700;
  font-size: 12px;
}
</style>