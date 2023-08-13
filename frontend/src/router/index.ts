import { createRouter, createWebHistory } from 'vue-router'
import HomeHeader from '@/views/HomeHeader.vue'
import HomeView from '@/views/HomeView.vue'
import SearchView from '@/views/SearchView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/home',
      component: HomeHeader,
      children: [
        {
          path: '/home',
          name: 'home',
          component: HomeView
        },
        {
          path: '/search',
          name: 'search',
          component: SearchView
        }
      ]
    }
  ]
})

export default router
