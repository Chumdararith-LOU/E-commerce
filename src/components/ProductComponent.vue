<script setup lang="ts">
import { computed } from 'vue'
import { useRouter } from 'vue-router' // 1. Import useRouter

const props = defineProps<{
  id: number // 2. Add ID to props
  name: string
  image: string
  category: string
  rating: number
  price: number
  size: string
  promotionAsPercentage: number
  countSold: number
  instock: number
  group: string
}>()

const router = useRouter() // 3. Get router instance

// 4. Create navigation function
function goToDetail() {
  router.push({ 
    name: 'product', 
    params: { productId: props.id } 
  })
}

const imageUrl = computed(() => {
  if (props.image.startsWith('[')) {
    const parsed = JSON.parse(props.image)

    if (Array.isArray(parsed) && parsed.length > 0) {
      const path = parsed[0].replace(/\\/g, '/')
      return `http://localhost:3000/${path}`
    } else {
      return 'src/assets/placeholder.png'
    }
  }
  return `http://localhost:3000/${props.image}`
})

const discountPrice = computed(() => {
  if (props.promotionAsPercentage > 0) {
    const afterDiscount = props.price * ((100 - props.promotionAsPercentage) / 100)
    return afterDiscount.toFixed(2)
  }
  return null
})

const badge = computed(() => {
  if (props.promotionAsPercentage > 0) {
    return { text: `-${props.promotionAsPercentage}%`, color: '#67bcee', type: 'promotion' }
  } else if (props.countSold > 50) {
    return { text: 'Hot', color: '#f74b81', type: 'hot' }
  } else if (props.promotionAsPercentage > 0) {
    return { text: 'Sale', color: '#f59758', type: 'sale' }
  }
  return null
})

const badgeClass = computed(() => {
  if (!badge.value) return ''
  return `badge-${badge.value.type}`
})
</script>

<template>
  <div class="product-card" @click="goToDetail">
    <div v-if="badge" class="badge" :class="badgeClass">
      {{ badge.text }}
    </div>

    <div class="product-image">
      <img :src="imageUrl" :alt="name" />
    </div>

    <div class="product-info">
      <small class="category-text">{{ category }}</small>
      <h4 class="product-title" :title="name">{{ name }}</h4>

      <div class="rating">
        <span v-for="i in 5" :key="i" class="star">
          {{ i <= Math.round(rating) ? '★' : '☆' }}
        </span>
        <span class="rating-num">({{ rating }})</span>
      </div>

      <div class="product-meta">
        <span class="weight">{{ size }}</span>
      </div>

      <div class="product-footer">
        <div class="price-box">
          <template v-if="promotionAsPercentage > 0">
            <span class="discount-price">${{ discountPrice }}</span>
            <span class="original-price">${{ price.toFixed(2) }}</span>
          </template>

          <template v-else>
            <span class="discount-price">${{ price.toFixed(2) }}</span>
          </template>
        </div>
        <button class="add-btn" @click.stop>Add +</button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.product-card {
  width: 230px;
  border: 1px solid #ececec;
  border-radius: 15px;
  padding: 20px;
  position: relative;
  transition:
    box-shadow 0.3s,
    border-color 0.3s;
  background: #fff;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-sizing: border-box;
  cursor: pointer; /* 6. Add cursor pointer so user knows it's clickable */
}

.product-card:hover {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  border-color: #bce3c9;
}

/* --- BADGES --- */
.badge {
  position: absolute;
  top: 0;
  left: 0;
  padding: 5px 10px;
  border-radius: 15px 0 20px 0;
  color: white;
  font-weight: 700;
  font-size: 12px;
  z-index: 1;
}
.badge-promotion {
  background-color: #3bb77e;
}
.badge-hot {
  background-color: #f74b81;
}
.badge-sale {
  background-color: #67bcee;
}

.product-image {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 140px;
  margin-bottom: 15px;
  overflow: hidden;
}

.product-image img {
  max-height: 100%;
  max-width: 100%;
  object-fit: contain;
}

.category-text {
  color: #adadad;
  font-size: 12px;
  font-weight: 400;
  margin-bottom: 4px;
  display: block;
}

.product-title {
  font-family: 'Quicksand', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: #253d4e;
  margin: 5px 0;
  line-height: 1.2;

  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  height: 40px;
}

.rating {
  color: #fdc040;
  font-size: 14px;
  margin-bottom: 5px;
}

.rating-num {
  color: #b6b6b6;
  font-size: 12px;
  margin-left: 5px;
}

.weight {
  color: #b6b6b6;
  font-size: 12px;
}

/* --- FOOTER --- */
.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 15px;
}

.price-box {
  display: flex;
  flex-direction: column;
}

.discount-price {
  color: #3bb77e;
  font-size: 18px;
  font-weight: 700;
  font-family: 'Quicksand', sans-serif;
}

.original-price {
  font-size: 12px;
  color: #adadad;
  text-decoration: line-through;
  font-weight: 600;
}

.add-btn {
  background-color: #def9ec;
  color: #3bb77e;
  border: none;
  padding: 8px 20px;
  border-radius: 4px;
  font-weight: 700;
  cursor: pointer;
  font-size: 14px;
  transition: background 0.3s;
}

.add-btn:hover {
  background-color: #3bb77e;
  color: white;
}
</style>