import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/addPatern/:id',
    name:'addPatern',
    component: () => import('../views/AddPatternView.vue')
  },
  {
    path:'/login',
    name:'login',
    component: () => import('../views/LoginView.vue')
  },
  {
    path:'/register',
    name:'register',
    component:() => import('../views/RegisterView.vue')
  },
  {
    path:'/editPattern/:id',
    name:'editPattern',
    component: ()=> import('../views/EditView.vue')
  },
  {
    path:'/myspace',
    name:'myspace',
    component: ()=> import('../views/MySpace.vue')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
