import { createWebHistory, createRouter } from 'vue-router';

const routes = [
  {
    path: '/postalCode',
    name: 'postalCode',
    component: () => import('../views/cepview/CepView.vue')
  },
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/home/HomeView.vue')
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: () => import('../views/notfound/NotFound.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;