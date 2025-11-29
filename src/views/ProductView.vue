<script setup lang="ts">
import { computed, onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useProductStore } from '@/stores/productStore'

import ProductImageComponent from '@/components/ProductImageComponent.vue'
import ProductInfoComponent from '@/components/ProductInfoComponent.vue'

const route = useRoute()
const productStore = useProductStore()
const activeTab = ref('Description')

const productId = computed(() => Number(route.params.productId))

const product = computed(() => {
  return productStore.products.find((p: any) => p.id === productId.value)
})

onMounted(async () => {
  if (productStore.products.length === 0) {
    await productStore.fetchAllData()
  }
})

const tabs = ['Description', 'Additional info', 'Reviews (3)']
</script>

<template>
  <div class="product-page-container">
    
    <div class="breadcrumb mb-10">
      <router-link to="/">Home</router-link> 
      <i class="fa-solid fa-chevron-right"></i>
      <router-link to="/categories/1">Vegetables & tubers</router-link>
      <i class="fa-solid fa-chevron-right"></i>
      <span class="active">{{ product?.name }}</span>
    </div>

    <div class="product-main-section" v-if="product">
      <div class="left-col">
        <ProductImageComponent :images="product.image" />
      </div>
      <div class="right-col">
        <ProductInfoComponent :product="product" />
      </div>
    </div>
    <div v-else class="loading">Loading product...</div>

    <div class="tabs-section">
      <div class="tabs-header">
        <button 
          v-for="tab in tabs" 
          :key="tab"
          :class="{ active: activeTab === tab }"
          @click="activeTab = tab"
        >
          {{ tab }}
        </button>
      </div>

      <div class="tab-content">
        <div v-if="activeTab === 'Description'" class="desc-content">
          <p>Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop tightly neurotic hungrily some and dear furiously this apart.</p>
          <p>Spluttered narrowly yikes left moth in yikes bowed this that grizzly much hello on spoon-fed that alas rethought much decently richly and wow against the frequent fluidly at formidable acceptably flapped besides and much circa far over the bucolically hey precarious goldfinch mastodon goodness gnashed a jellyfish and one however because.</p>
        </div>
        <div v-else>
           <p>Content for {{ activeTab }}</p>
        </div>
      </div>
    </div>

  </div>
</template>

<style scoped>
.product-page-container {
  margin-top: 20px;
}

.breadcrumb {
  color: #7E7E7E;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.breadcrumb a { text-decoration: none; color: #7E7E7E; font-weight: 600; }
.breadcrumb i { font-size: 10px; }
.breadcrumb .active { color: #3BB77E; }
.mb-10 { margin-bottom: 40px; }

.product-main-section {
  display: flex;
  gap: 50px;
  margin-bottom: 60px;
}

.left-col { flex: 1; }
.right-col { flex: 1; }

.tabs-section {
  border: 1px solid #ececec;
  border-radius: 15px;
  padding: 40px;
  background: white;
  margin-bottom: 50px;
}

.tabs-header {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;
}

.tabs-header button {
  background: none;
  border: 1px solid #ececec;
  border-radius: 30px;
  padding: 10px 25px;
  font-family: 'Quicksand', sans-serif;
  font-weight: 700;
  font-size: 16px;
  color: #7E7E7E;
  cursor: pointer;
  transition: all 0.2s;
}

.tabs-header button.active {
  color: #3BB77E;
  border-color: #BCE3C9;
  box-shadow: 0 5px 10px rgba(0,0,0,0.05);
}

.desc-content p {
  color: #7E7E7E;
  line-height: 24px;
  margin-bottom: 15px;
  font-size: 15px;
}

.loading { padding: 50px; text-align: center; }
</style>