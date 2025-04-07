import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '@/views/login.vue';
import Register from '@/views/Register.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    
    component: () => import('../views/AboutView.vue')
  },
  {
    path: '/Product',
    name: 'Product',
    
    component: () => import('../views/Product.vue')
  },
  {
    path: '/ShowProduct',
    name: 'ShowProduct',
    
    component: () => import('../views/ShowProduct.vue')
  },
  {
    path: '/Blogshop',
    name: 'Blogshop',
    
    component: () => import('../views/Blogshop.vue')
  },
  {
    path: '/login',
    name: 'login',
    
    component: () => import('../views/login.vue')
  },
  {
    path: '/blog',
    name: 'blog',
    
    component: () => import('../views/blog.vue')
  },
  {
    path: '/Register',
    name: 'Register',
    
    component: () => import('../views/Register.vue')
  },
  {
    path: '/Servive',
    name: 'Servive',
    
    component: () => import('../views/Servive.vue')
  },
  {
    path: '/ServiceList',
    name: 'ServiceList',
    
    component: () => import('../views/ServiceList.vue')
  },
  {
    path: '/Top-Up',
    name: 'Top-Up',
    
    component: () => import('../views/Top-Up.vue')
  },
  {
    path: '/Top-UpList',
    name: 'Top-UpList',
    
    component: () => import('../views/Top-UpList.vue')
  }














]
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
