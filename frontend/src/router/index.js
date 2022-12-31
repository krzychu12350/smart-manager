import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/Authentication/LoginView.vue'
import RegisterView from '../views/Authentication/RegisterView.vue'

import RequestPasswordResetView from '@/views/Authentication/RequestPasswordResetView.vue'
import UpdatePasswordResetView from '@/views/Authentication/UpdatePasswordResetView.vue'
import UserDashboardView from '@/views/UserDashboardView.vue'
import ApplicationsManagementView from '@/views/ApplicationsManagementView.vue'
import { useAuthStore } from "../stores/useAuth";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/admin/employees',
      name: 'admin-employees',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/EmployeesManagementView.vue')
    },
    {
      path: '/admin/reports',
      name: 'admin-reports',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/ReportGeneratingView.vue')
    },
    {
      path: "/login",
      name: "LoginView",
      //component: LoginView,
      component: () => import('../views/Authentication/LoginView.vue')
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
      params: true,
      beforeEnter: (to, from) => {
        // reject the navigation
        return true;
      },
      
    },
    {
      path: "/admin/my-profile",
      component: UserDashboardView,
    },
    {
      path: "/admin/applications",
      component: ApplicationsManagementView,
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

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register', '/reset-password', '/change-password/' + to.params.token];
  const authRequired = !publicPages.includes(to.path);
  //const loggedIn = localStorage.getItem('user');
  if (authRequired && !useAuthStore().loggedIn) {
      next('/login');
  } else {
      next();
  }
});


export default router
