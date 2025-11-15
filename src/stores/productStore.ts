import { defineStore } from 'pinia'
import axios from 'axios'

export interface Category {
  id: number;
  name: string;
  image: string;
  productCount: number;
  color: string;
  group: string;
}

export interface Promotion {
  id: number;
  title: string;
  image: string;
  color: string;
  buttonColor: string;
}

export interface Group {}

export interface Product {
    name: string;
    rating: number;
    size: string;
    image: string;
    price: number;
    promotionAsPercentage: number;
    categoryId: number;
    instock: number;
    countSold: number;
    group: string
}

export const useProductStore = defineStore('product', {
  state: () => ({
    groups: [] as Group[],
    promotions: [] as Promotion[],
    categories: [] as Category[],
    products: [] as Product[],
  }),

  getters:{
    getCategoriesByGroup: (state) => {
      return (groupName: string) => 
        state.categories.filter((category) => category.group === groupName);
    },

    getProductsByGroup: (state) => {
      return (groupName: string) => 
        state.products.filter((product) => product.group === groupName);
    },

    getProductsByCategory: (state) => {
      return (categoryId: number) => 
        state.products.filter((product) => product.categoryId === categoryId);
    },

    getPopularProducts: (state) => {
      return state.products.filter((product) => product.countSold > 10);
    }
  },

  actions: {
    async fetchAllData() {
      try {
        const [categoriesRes, promotionsRes, groupsRes, productsRes] = await Promise.all([
          axios.get('http://localhost:3000/api/categories'),
          axios.get('http://localhost:3000/api/promotions'),
          axios.get('http://localhost:3000/api/groups'),
          axios.get('http://localhost:3000/api/products') 
        ]);

        this.categories = categoriesRes.data;
        this.promotions = promotionsRes.data;
        this.groups = groupsRes.data;
        this.products = productsRes.data;

      } catch (error) {
        console.error('Error fetching data:', error);
      }
    }
  }
})