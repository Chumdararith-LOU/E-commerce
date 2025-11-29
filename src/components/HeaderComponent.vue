<script setup lang="ts">
import SearchBoxComponent from './SearchBoxComponent.vue'
import logoImg from '../assets/Logo.png'
import hotlineImg from '../assets/Hotline.png'
import shopping from '../assets/fi-rs-shopping-cart.svg'
import user from '../assets/fi-rs-user.svg'
import heart from '../assets/fi-rs-heart.svg'
import compare from '../assets/icon-compare 1.svg'
import flame from '../assets/fi-rs-flame 1.svg'

</script>

<template>
  <header class="header-wrapper">
    <div class="header-top">
      <router-link to="/" class="logo">
        <img :src="logoImg" alt="Melon Mart" />
      </router-link>

      <div class="search-section">
        <SearchBoxComponent />
      </div>

      <div class="user-actions">
        <div class="action-item">
          <i class="fa-regular fa-user"><img :src="user" alt=""></i>
          <span class="action-label">Account</span>
        </div>

        <div class="action-item">
          <i class="fa-solid fa-arrows-rotate"><img :src="compare" alt=""></i>
          <span class="action-label">Compare</span>
        </div>

        <div class="action-item">
          <i class="fa-regular fa-heart"><img :src="heart" alt=""></i>
          <span class="action-label">Wishlist</span>
        </div>

        <div class="action-item">
          <i class="fa-solid fa-cart-shopping"><img :src="shopping" alt=""></i>
          <span class="action-label">Cart</span>
        </div>
      </div>
    </div>

    <div class="header-divider"></div>

    <div class="header-bottom">
      <button class="browse-btn">
        <i class="fa-solid fa-border-all"></i>
        <span>Browse All Categories</span>
        <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
      </button>

      <nav class="main-nav">
        <router-link to="/categories/1" class="nav-link">
          <i class="fa-solid fa-fire text-brand-green mr-1"><img :src="flame" alt=""></i> Hot Deals
        </router-link>
        <router-link to="/" class="nav-link">Home</router-link>

        <a href="#" class="nav-link">
          Food <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
        </a>

        <a href="#" class="nav-link">
          Vegetables <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
        </a>

        <a href="#" class="nav-link">Drink</a>
        <a href="#" class="nav-link">Cookies</a>

        <a href="#" class="nav-link">
          Meat & Seafood <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
        </a>

        <a href="#" class="nav-link">Bakery</a>
      </nav>

      <div class="hotline">
        <img :src="hotlineImg" alt="Hotline" />
      </div>
    </div>
  </header>
</template>

<style scoped>
.header-wrapper {
  background: white;
  padding-bottom: 20px;
}

.header-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 30px 0;
  gap: 20px;
}

.logo img {
  height: 50px;
}

.search-section {
  flex: 1;
  max-width: 700px;
}

.user-actions {
  display: flex;
  gap: 30px;
}

.action-item {
  display: flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  color: #7e7e7e;
}

.action-item i {
  font-size: 24px;
  color: #253d4e;
}

.action-label {
  font-size: 16px;
  color: #7e7e7e;
  margin-top: 4px;
}

.action-item:hover .action-label,
.action-item:hover i {
  color: #3bb77e;
}

.header-divider {
  height: 1px;
  background-color: #ececec;
  margin-bottom: 20px;
}

/* Bottom Row */
.header-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.browse-btn {
  background-color: #3bb77e;
  color: white;
  border: none;
  padding: 12px 25px;
  border-radius: 5px;
  font-weight: 700;
  font-family: 'Quicksand', sans-serif;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: background-color 0.2s;
}

.browse-btn:hover {
  background-color: #29a56c;
}

.main-nav {
  display: flex;
  gap: 40px;
}

.nav-link {
  text-decoration: none;
  color: #253d4e;
  font-weight: 700;
  font-size: 16px;
  display: flex;
  align-items: center;
  transition: color 0.2s;
  /* Use flex-end alignment to ensure text and chevron align nicely */
  align-items: baseline;
}

.nav-link:hover,
.nav-link.active {
  color: #3bb77e;
}

.text-brand-green {
  color: #3bb77e;
}

.hotline img {
  height: 45px;
}
</style>
