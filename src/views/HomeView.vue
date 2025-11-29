<script setup lang="ts">
import { onMounted, computed, ref } from 'vue'
import CategoryComponent from '../components/CategoryComponent.vue'
import PromotionComponent from '../components/PromotionComponent.vue'
import MenuComponent from '../components/MenuComponent.vue'
import ProductComponent from '../components/ProductComponent.vue'
import { useProductStore } from '../stores/productStore'
import ShowcaseComponent from '@/components/ShowcaseComponent.vue'
import HeaderComponent from '@/components/HeaderComponent.vue'

const productStore = useProductStore()

const currentCategoryGroup = ref('All')

const filteredCategories = computed(() => {
  if (currentCategoryGroup.value === 'All') {
    return productStore.categories
  } else {
    return productStore.getCategoriesByGroup(currentCategoryGroup.value)
  }
})

function selectCategoryGroup(group: string) {
  currentCategoryGroup.value = group
}

const currentProductGroup = ref('All')

const filteredProducts = computed(() => {
  if (currentProductGroup.value === 'All') {
    return productStore.getPopularProducts
  } else {
    return productStore.getProductsByGroup(currentProductGroup.value)
  }
})

function selectProductGroup(group: string) {
  currentProductGroup.value = group
}

const menuItems = computed(() => {
  return ['All', ...productStore.groups]
})

onMounted(async () => {
  await productStore.fetchAllData()
})
</script>

<template>
  <div class="home-container">
    <ShowcaseComponent />
    
    <div class="section-header">
      <h3>Featured Categories</h3>
      <MenuComponent 
        :menuItems="menuItems" 
        :activeItem="'All'" 
        @select-item="selectCategoryGroup"
      />
    </div>

    <div class="category-grid">
      <CategoryComponent
        v-for="(category, index) in filteredCategories"
        :key="index"
        :name="category.name"
        :image="'http://localhost:3000/' + category.image"
        :Item_count="category.productCount"
        :Card_color="category.color"
      />
    </div>

    <div class="promotion-section">
      <PromotionComponent
        v-for="(promotion, index) in productStore.promotions"
        :key="index"
        :title="promotion.title"
        :buttonText="'Shop Now →'"
        :image="'http://localhost:3000/' + promotion.image"
        :Card_color="promotion.color"
        :buttonColor="promotion.buttonColor"
      />
    </div>

    <div class="section-header">
      <h3>Popular Products</h3>
      <MenuComponent 
        :menuItems="menuItems" 
        :activeItem="currentProductGroup"
        @select-item="selectProductGroup"
      />
    </div>

    <div class="product-grid">
      <ProductComponent
        v-for="(product, index) in filteredProducts"
        :key="index"
        :name="product.name"
        :image="product.image"
        :category="product.group"
        :rating="product.rating"
        :price="product.price"
        :size="product.size"
        :promotionAsPercentage="product.promotionAsPercentage"
        :countSold="product.countSold"
        :instock="product.instock"
        :group="product.group"
      />
    </div>
  </div>
</template>

<style scoped>
.home-container {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 4em;
}

.promotion-section {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  width: 100%;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.section-header h3 {
  font-family: 'Quicksand', sans-serif;
  font-size: 32px;
  font-weight: 700;
  color: #253d4e;
  margin: 0;
}

.category-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
  gap: 20px;
  width: 100%;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
  gap: 25px;
  margin-bottom: 50px;
}
</style>