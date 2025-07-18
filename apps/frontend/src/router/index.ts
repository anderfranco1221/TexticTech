import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LogginView from '../views/Loggin/LogginView.vue'
import DashboardView from '../views/Dashboard/DashboardView.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: LogginView,
      meta: {
        requirestAuth: false // This route does not require authentication
      },
    },
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        requirestAuth: true, // This route requires authentication
      },
      children: [
        {
          path: 'dashboard',
          name: 'dashboard',
          component: DashboardView,
        },
        {
          path: 'categories',
          name: 'categories',
          component: () => import('../views/Articles/Category/CategoryView.vue'),
        }
      ]
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
    },
  ],
})

router.beforeEach((to, from, next)=> {
  
  if (to.matched.some(record => record.meta.requirestAuth)) {
    // This route requires authentication, check if the user is authenticated
    if(true){
      next(); // Proceed to the route
      return;
    }

    next("/login"); // Redirect to login page if not authenticated
  }
  next();
});

export default router
