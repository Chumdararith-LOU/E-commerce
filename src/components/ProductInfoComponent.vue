<script setup lang="ts">
import { computed, ref } from 'vue'
import heart from '../assets/fi-rs-heart.svg'
import cart from '../assets/fi-rs-shopping-cart.svg'

const props = defineProps<{
  product: any
}>()

const quantity = ref(1)

const discountPrice = computed(() => {
  if (props.product.promotionAsPercentage > 0) {
    const p = props.product.price * ((100 - props.product.promotionAsPercentage) / 100)
    return p.toFixed(2)
  }
  return null
})

function increment() {
  quantity.value++
}
function decrement() {
  if (quantity.value > 1) quantity.value--
}
</script>

<template>
  
  <div class="product-info-wrapper" v-if="product">
    <span class="stock-badge" :class="{ 'in-stock': product.instock > 0 }">
      {{ product.instock > 0 ? 'In Stock' : 'Out of Stock' }}
    </span>

    <h1 class="product-title">{{ product.name }}</h1>

    <div class="rating-row">
      <div class="stars">
        <span v-for="i in 5" :key="i" class="star">
          {{ i <= Math.round(product.rating) ? '★' : '☆' }}
        </span>
      </div>
      <span class="review-count">({{ product.rating.toFixed(1) }})</span>
    </div>

    <div class="price-row">
      <template v-if="product.promotionAsPercentage > 0">
        <span class="current-price">${{ discountPrice }}</span>
        <div class="old-price-block">
          <span class="percentage">{{ product.promotionAsPercentage }}% Off</span>
          <span class="old-price">${{ product.price }}</span>
        </div>
      </template>
      <template v-else>
        <span class="current-price">${{ product.price }}</span>
      </template>
    </div>

    <p class="description">
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti
      reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia
      doloremque facere quia. Voluptatum, accusantium!
    </p>

    <div class="action-row">
      <div class="qty-wrapper">
        <input type="number" v-model="quantity" readonly />
        <div class="qty-arrows">
          <button @click="increment"><i class="fa-solid fa-angle-up"></i></button>
          <button @click="decrement"><i class="fa-solid fa-angle-down"></i></button>
        </div>
      </div>

      <button class="add-to-cart-btn">
        <i class="fa-solid fa-cart-shopping mr-2"></i> Add To Cart
      </button>

      <button class="icon-btn"><i class="fa-regular fa-heart"><img :src="heart" alt=""></i></button>
      <button class="icon-btn"><i class="fa-solid fa-shuffle"><img :src="cart" alt=""></i></button>
    </div>

    <div class="meta-info">
      <p><strong>Vendor:</strong> <span class="text-gray">NestMart</span></p>
      <p><strong>SKU:</strong> <span class="text-gray">FWM15VKT</span></p>
    </div>
  </div>
</template>

<style scoped>
.product-info-wrapper {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.stock-badge {
  display: inline-block;
  padding: 5px 10px;
  border-radius: 5px;
  background-color: #fcebeb; /* Default redish */
  color: #f74b81;
  font-weight: 700;
  font-size: 14px;
  width: fit-content;
}

.stock-badge.in-stock {
  background-color: #def9ec;
  color: #3bb77e;
}

.product-title {
  font-family: 'Quicksand', sans-serif;
  font-size: 36px;
  font-weight: 700;
  color: #253d4e;
  margin: 0;
  line-height: 1.2;
}

.rating-row {
  display: flex;
  align-items: center;
  gap: 10px;
}

.stars {
  color: #fdc040;
  font-size: 14px;
}
.review-count {
  color: #b6b6b6;
  font-size: 14px;
}

.price-row {
  display: flex;
  align-items: center;
  gap: 15px;
  margin: 10px 0;
}

.current-price {
  font-family: 'Quicksand', sans-serif;
  font-size: 48px;
  font-weight: 700;
  color: #3bb77e;
}

.old-price-block {
  display: flex;
  flex-direction: column;
}

.percentage {
  color: #fdc040;
  font-size: 12px;
  font-weight: 700;
}
.old-price {
  text-decoration: line-through;
  color: #b6b6b6;
  font-size: 20px;
  font-weight: 700;
}

.description {
  color: #7e7e7e;
  font-size: 16px;
  line-height: 24px;
}

/* Action Buttons */
.action-row {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}

.qty-wrapper {
  border: 2px solid #3bb77e;
  border-radius: 5px;
  display: flex;
  width: 80px;
  height: 50px;
  position: relative;
  overflow: hidden;
}

.qty-wrapper input {
  width: 100%;
  border: none;
  text-align: center;
  font-weight: 700;
  color: #3bb77e;
  font-size: 16px;
  outline: none;
}

.qty-arrows {
  position: absolute;
  right: 0;
  top: 0;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.qty-arrows button {
  flex: 1;
  border: none;
  background: none;
  cursor: pointer;
  color: #3bb77e;
  padding: 0 5px;
}

.add-to-cart-btn {
  background-color: #3bb77e;
  color: white;
  border: none;
  padding: 0 40px;
  border-radius: 5px;
  font-weight: 700;
  font-family: 'Quicksand', sans-serif;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
}

.add-to-cart-btn:hover {
  background-color: #29a56c;
}

.icon-btn {
  width: 50px;
  height: 50px;
  border: 1px solid #ececec;
  border-radius: 5px;
  background: white;
  color: #7e7e7e;
  font-size: 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.meta-info {
  margin-top: 20px;
  font-size: 14px;
  color: #253d4e;
}

.meta-info strong {
  color: #3bb77e;
  margin-right: 5px;
}
.text-gray {
  color: #7e7e7e;
}
</style>
