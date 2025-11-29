<script setup lang="ts">
</script>

<template>
  <div class="search-box-container">
    <div class="category-select">
      <span>All Categories</span>
      <i class="fa-solid fa-chevron-down text-xs ml-2 text-gray-400"></i>
    </div>
    <div class="divider"></div>
    <input type="text" placeholder="Search for items..." class="search-input" />
    <button class="search-icon">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </div>
</template>

<style scoped>
.search-box-container {
  display: flex;
  align-items: center;
  border: 1px solid #BCE3C9;
  border-radius: 5px;
  padding: 10px 15px;
  width: 100%;
  max-width: 700px; 
  height: 50px;
  background: white;
  box-sizing: border-box;
}

.category-select {
  display: flex;
  align-items: center;
  font-weight: 700;
  color: #253D4E;
  font-size: 14px;
  cursor: pointer;
  white-space: nowrap;
}

.divider {
  width: 1px;
  height: 20px;
  background-color: #BCE3C9;
  margin: 0 15px;
}

.search-input {
  border: none;
  outline: none;
  width: 100%;
  font-family: 'Quicksand', sans-serif;
  color: #7E7E7E;
}

.search-icon {
  background: none;
  border: none;
  color: #7E7E7E;
  cursor: pointer;
  font-size: 18px;
}
</style>