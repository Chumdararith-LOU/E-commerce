<script setup lang="ts">
import { ref, computed, watch } from 'vue'

const props = defineProps<{
  images: string | string[]
}>()

const selectedIndex = ref(0)
const imageList = computed(() => {
  if (Array.isArray(props.images)) {
    return props.images.map(path => `http://localhost:3000/${path.replace(/\\/g, '/')}`)
  } 
  
  if (typeof props.images === 'string') {
    try {
      if (props.images.startsWith('[')) {
        const parsed = JSON.parse(props.images)
        return parsed.map((path: string) => `http://localhost:3000/${path.replace(/\\/g, '/')}`)
      }
      // Otherwise treat as single string path
      return [`http://localhost:3000/${props.images.replace(/\\/g, '/')}`]
    } catch (e) {
      return [`http://localhost:3000/${props.images.replace(/\\/g, '/')}`]
    }
  }
  
  return ['src/assets/placeholder.png'] // Fallback
})

const currentImage = computed(() => imageList.value[selectedIndex.value] || imageList.value[0])

</script>

<template>
  <div class="product-image-wrapper">
    <div class="main-image-container">
      <i class="fa-solid fa-magnifying-glass zoom-icon"></i>
      <img :src="currentImage" alt="Product Image" class="main-img" />
    </div>

    <div class="thumbnail-slider">
      <button class="nav-btn prev"><i class="fa-solid fa-arrow-left"></i></button>
      
      <div class="thumbnails">
        <div 
          v-for="(img, index) in imageList" 
          :key="index"
          class="thumb-item"
          :class="{ active: index === selectedIndex }"
          @click="selectedIndex = index"
        >
          <img :src="img" alt="thumbnail" />
        </div>
      </div>

      <button class="nav-btn next"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
  </div>
</template>

<style scoped>
.product-image-wrapper {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.main-image-container {
  border: 1px solid #ececec;
  border-radius: 15px;
  overflow: hidden;
  position: relative;
  height: 400px; /* Or adjust as needed */
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
}

.zoom-icon {
  position: absolute;
  top: 20px;
  right: 20px;
  color: #adadad;
  font-size: 20px;
  cursor: pointer;
}

.main-img {
  max-width: 90%;
  max-height: 90%;
  object-fit: contain;
}

/* Thumbnail Slider */
.thumbnail-slider {
  display: flex;
  align-items: center;
  gap: 10px;
}

.thumbnails {
  display: flex;
  gap: 10px;
  overflow-x: auto;
  flex: 1;
}

.thumb-item {
  width: 80px;
  height: 80px;
  border: 1px solid #ececec;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: border-color 0.2s;
}

.thumb-item.active {
  border: 2px solid #3BB77E;
}

.thumb-item img {
  max-width: 90%;
  max-height: 90%;
  object-fit: contain;
}

.nav-btn {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  border: none;
  background-color: #F2F3F4;
  color: #7E7E7E;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}
.nav-btn:hover {
  background-color: #3BB77E;
  color: white;
}
</style>