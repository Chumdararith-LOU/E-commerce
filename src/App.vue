<script setup lang="ts">
import CategoryComponent from './components/CategoryComponent.vue'
import PromotionComponent from './components/PromotionComponent.vue'
import Apple from './assets/Apple.png'
import Black_plum from './assets/Black Plum.png'
import Burger from './assets/Burger.png'
import Cabbage from './assets/Cabbage.png'
import Cake_Milk from './assets/Cake Mild.png'
import Kiwi from './assets/Kiwi.png'
import Onion from './assets/Onion.jpg'
import Orange from './assets/Orange.png'
import Peach from './assets/Peach.png'
import Snack from './assets/Snack.png'
import Strawberry_Milk from './assets/Strawberrry Milk.png'
import Vegetable from './assets/Vegetable.jpg'
import Headphone from './assets/Headphone.png'

const categories = [
  {
    name: 'Cake & Milk',
    image: Burger,
    Item_count: 14,
    Card_color: '#F2FCE4',
  },
  {
    name: 'Peach',
    image: Peach,
    Item_count: 17,
    Card_color: '#FFFCEB',
  },
  {
    name: 'Organic Kiwi',
    image: Kiwi,
    Item_count: 21,
    Card_color: '#ECFFEC',
  },
  {
    name: 'Red Apple',
    image: Apple,
    Item_count: 68,
    Card_color: '#FEEFEA',
  },
  {
    name: 'Snack',
    image: Snack,
    Item_count: 34,
    Card_color: '#FFF3EB',
  },
  {
    name: 'Black Plum',
    image: Black_plum,
    Item_count: 25,
    Card_color: '#FFF3FF',
  },
  {
    name: 'Vegetables',
    image: Cabbage,
    Item_count: 65,
    Card_color: '#F2FCE4',
  },
  {
    name: 'Headphone',
    image: Headphone,
    Item_count: 33,
    Card_color: '#FFFCEB',
  },
  {
    name: 'Cake & Milk',
    image: Cake_Milk,
    Item_count: 54,
    Card_color: '#F2FCE4',
  },
  {
    name: 'Orange',
    image: Orange,
    Item_count: 63,
    Card_color: '#FFF3FF',
  },
]
</script>

<template>
  <div class="app-container">
    <div class="category-section">
        <CategoryComponent
          v-for="(category, index) in categories"
          :key="index"
          :name="category.name"
          :image="category.image"
          :Item_count="category.Item_count"
          :Card_color="category.Card_color"
        />
    </div>

    <div class="promotion-section">
      <PromotionComponent
        title="Everyday Fresh & Clean with Our Products"
        buttonText="Shop Now →"
        :image="Onion"
        Card_color = "#F0E8D5"
        buttonColor="#3BB77E"
      />
      <PromotionComponent
        title="Make your Breakfast Healthy and Easy"
        buttonText="Shop Now →"
        :image="Strawberry_Milk"
        Card_color = "#F3E8E8"
        buttonColor="#3BB77E"
      />
      <PromotionComponent
        title="The best Organic Products Online"
        buttonText="Shop Now →"
        :image="Vegetable"
        Card_color = "#E7EAF3"
        buttonColor="#FDC040"
      />
    </div>
  </div>
</template>

<style scoped>
.app-container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 4em;
  padding: 20px;
  max-width: 1556px; 
  margin: 0 auto;
}

.category-section {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  width: 100%; 
}

.promotion-section {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between; 
  width: 100%;
}
</style>
