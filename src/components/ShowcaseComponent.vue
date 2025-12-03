<script setup lang="ts">
import bgPattern from '@/assets/Background Showcase.png'
import applesImg from '@/assets/Apples.png'
</script>

<template>
  <div class="showcase-container" :style="{ backgroundImage: `url('${bgPattern}')` }">
    
    <div class="showcase-content">
      <h1>Don't miss amazing<br>grocery deals</h1>
      <p>Sign up for the daily newsletter</p>
      
      <div class="newsletter-form">
        <i class="fa-regular fa-paper-plane"></i>
        <input type="email" placeholder="Your email address" />
        <button>Subscribe</button>
      </div>
    </div>

    <div class="image-wrapper">
      <img :src="applesImg" alt="Fresh Apples" />
    </div>

  </div>
</template>

<style scoped>
.showcase-container {
  background-color: #fdf0e0; 
  background-repeat: repeat;
  background-size: 50%; 
  background-position: center;
  border-radius: 20px;
  height: 400px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 80px;
  margin-top: 30px;
  overflow: hidden;
  position: relative;
}

.showcase-content {
  z-index: 2;
  max-width: 50%;
  display: block; 
}

.showcase-content h1 {
  font-family: 'Quicksand', sans-serif;
  font-size: 48px;
  font-weight: 700;
  color: #253D4E;
  line-height: 1.2;
  margin-bottom: 20px;
}

.showcase-content p {
  color: #7E7E7E;
  font-size: 20px;
  margin-bottom: 35px;
}

.newsletter-form {
  background: white;
  border-radius: 30px;
  padding: 5px 5px 5px 25px;
  display: inline-flex;
  align-items: center;
  width: 100%;
  max-width: 450px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}

.newsletter-form i {
  color: #7E7E7E;
  margin-right: 10px;
}

.newsletter-form input {
  border: none;
  outline: none;
  flex: 1;
  font-family: 'Quicksand', sans-serif;
  color: #7E7E7E;
  font-size: 14px;
}

.newsletter-form button {
  background-color: #3BB77E;
  color: white;
  border: none;
  padding: 15px 35px;
  border-radius: 30px;
  font-weight: 700;
  cursor: pointer;
  transition: transform 0.2s;
  font-size: 16px;
}

.newsletter-form button:hover {
  transform: translateY(-2px);
  background-color: #29a56c;
}

.image-wrapper {
  z-index: 2;
  height: 100%;
  display: flex;
  align-items: flex-end;
}

.image-wrapper img {
  height: 110%; 
  object-fit: contain;
  margin-bottom: -20px; 
}
</style>