<script setup lang="ts">
import { onMounted } from 'vue';
import CategoryComponent from './components/CategoryComponent.vue'
import PromotionComponent from './components/PromotionComponent.vue'
import { useProductStore } from './stores/productStore';

const productStore = useProductStore();

onMounted(async () => {
  await productStore.fetchAllData()

  console.log("Products:", productStore.products);
  console.log("Categories:", productStore.categories);
  
  // Test 1: getCategoriesByGroup
  const fruitCategories = productStore.getCategoriesByGroup('Fruits');
  console.log("Categories in 'Fruits':", fruitCategories);

  // Test 2: getProductsByGroup
  const fruitProducts = productStore.getProductsByGroup('Fruits');
  console.log("Products in 'Fruits':", fruitProducts);

  // Test 3: getProductsByCategory
  const cat1Products = productStore.getProductsByCategory(1);
  console.log("Products in Category 2:", cat1Products);

  // Test 4: getPopularProducts
  const popular = productStore.getPopularProducts;
  console.log("Popular Products: ", popular);

})

</script>

<template>
  <div class="app-container">
    <div class="category-section">
      <CategoryComponent
        v-for="(category, index) in productStore.categories"
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
