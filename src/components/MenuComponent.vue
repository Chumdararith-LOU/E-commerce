<script setup lang="ts">
defineProps<{
    menuItems: string[],
    activeItem: string
}>()
const emit = defineEmits(['select-item'])
</script>


<template>
  <div class="section-header">
    <ul class="menu-list">
      <li 
      v-for="item in menuItems" 
      :key="item" 
      :class="{ active: item === activeItem }"
      @click="emit('select-item', item)"
      >
        {{ item }}
      </li>
    </ul>
  </div>
</template>

<style scoped>

.menu-list {
  display: flex;
  gap: 30px;
  list-style: none;
  padding: 0;
  margin: 0;
  align-items: center;
}

.menu-list li {
  font-family: 'Quicksand', sans-serif;
  font-weight: 700;
  font-size: 16px;
  color: #7e7e7e;
  cursor: pointer;
  transition: color 0.3s ease;
}

.menu-list li:hover {
  color: #253d4e;
}

.menu-list li.active {
  color: #253d4e;
}
</style>