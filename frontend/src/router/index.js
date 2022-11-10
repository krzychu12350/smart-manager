import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import ManagerDashboard from '../views/ManagerDashboard.vue'
import RequestPasswordResetView from '@/views/RequestPasswordResetView.vue'
import UpdatePasswordResetView from '@/views/UpdatePasswordResetView.vue'
import { useAuthStore } from "../stores/useAuth";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: ManagerDashboard
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: "/login",
      name: "LoginView",
      //component: LoginView,
      component: () => import('../views/LoginView.vue')
    },
    {
      path: "/register",
      name: "RegisterView",
      component: RegisterView,
    },
    {
      path: "/reset-password",
      name: "request-passwordreset",
      component: RequestPasswordResetView,
    },
    {
      path: "/change-password/:token",
      name: "update-password",
      component: UpdatePasswordResetView,
      params: true
    },
    /*
    {
      path: "/manager/dashboard",
      name: "manager-dashboard",
      component: ManagerDashboard,
    },
        
    {
      path: "/employee/dashboard",
      name: "employee-dashboard",
      component: ManagerDashboard,
    },
  
    {
      path: "/admin/employees",
      name: "EmployeesManagementView",
      component: EmployeesManagementView,
    },
    */
  ]
})
/*
router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth && !useAuthStore().loggedIn)
    next({ name: "accounts-login" });
  else next();
});
*/
/*
router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register', '/reset-password', '/update-password/:token'];
  const authRequired = !publicPages.includes(to.path);
  //const loggedIn = localStorage.getItem('user');
  if (authRequired && !useAuthStore().loggedIn) {
      next('/login');
  } else {
      next();
  }
});
*/

export default router
