<script setup lang="ts">
defineProps<{
  name: string
  image: string
  Item_count: number
  Card_color: string
}>()
</script>

<template>
  <div class="category-card" :style="{ backgroundColor: Card_color }">
    <div class="image-placeholder">
      <img :src="image" :alt="name" />
    </div>
    <div class="Card_name">
      <p>{{ name }}</p>
      <small>{{ Item_count }} items</small>
    </div>
  </div>
</template>

<style scoped>
.category-card {
  border-radius: 10px;
  padding: 10px;
  max-width: 137px;
  height: 180px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-evenly;
}
.category-card p {
  font-family: 'Quicksand', sans-serif;
  font-weight: 700;
  font-size: 16px;
  line-height: 20px;
  letter-spacing: -0.04em;
  text-align: center;
  color: black;
}
.category-card small {
  color: #b6b6b6;
  font-family: 'Lato', sans-serif;
  font-weight: 400;
  font-size: 12px;
  line-height: 18px;
  letter-spacing: 0;
  text-align: center;
  display: block;
}

.image-placeholder {
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.image-placeholder img {
  max-width: 100%;
  max-height: 120px;
  object-fit: contain;
}
</style>
