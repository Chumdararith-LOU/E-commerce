<script setup lang="ts">
defineProps<{
    text: string, 
    color: string
}>()
</script>

<template>
  <button class="promo-button" :style="{ backgroundColor: color }">
    {{ text }}
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