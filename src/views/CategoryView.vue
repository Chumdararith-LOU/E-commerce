<script setup lang="ts">
import { useRoute } from 'vue-router'
import { computed, onMounted } from 'vue'
import { useProductStore } from '@/stores/productStore'
import PageHeaderComponent from '@/components/PageHeaderComponent.vue'
import ProductComponent from '@/components/ProductComponent.vue'

const route = useRoute()
const productStore = useProductStore()

const categoryId = computed(() => Number(route.params.categoryId))


const category = computed(() => {
  return productStore.categories.find(c => c.id === categoryId.value)
})

const products = computed(() => {
  return productStore.getProductsByCategory(categoryId.value)
})

onMounted(async () => {
  if (productStore.categories.length === 0) {
    await productStore.fetchAllData()
  }
})
</script>

<template>
  <div class="category-page">
    <PageHeaderComponent 
      :title="category?.name || 'Category'" 
      :breadcrumb="category?.name || 'Category'" 
    />
    
    <div class="product-grid" v-if="products.length > 0">
      <ProductComponent
        v-for="(product, index) in products"
        :key="index"
        :id="product.id"
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
    
    <div v-else class="no-products">
        <p>No products found in this category.</p>
    </div>
  </div>
</template>

<style scoped>
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
  gap: 25px;
  margin-bottom: 50px;
}

.no-products {
    text-align: center;
    padding: 100px;
    color: #7E7E7E;
    font-size: 18px;
}
</style>