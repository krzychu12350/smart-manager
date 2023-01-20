import { createRouter, createWebHistory } from 'vue-router'
import EmployeeRegisterView from '../views/Authentication/EmployeeRegisterView.vue'
import OwnerRegisterView from '@/views/Authentication/OwnerRegisterView.vue'
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

      component: () => import('../views/EmployeesManagementView.vue')
    },
    {
      path: '/admin/reports',
      name: 'admin-reports',
      component: () => import('../views/ReportGeneratingView.vue')
    },
    {
      path: "/login",
      name: "LoginView",
      component: () => import('../views/Authentication/LoginView.vue')
    },
    {
      path: "/register/employee",
      name: "EmployeeRegisterView",
      component: EmployeeRegisterView,
    },
    {
      path: "/register/owner",
      name: "OwnerRegisterView",
      component: OwnerRegisterView,
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
  ]
})

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register/employee', '/register/owner', '/reset-password', '/change-password/' + to.params.token];
  const authRequired = !publicPages.includes(to.path);
  if (authRequired && !useAuthStore().loggedIn) {
      next('/login');
  } else {
      next();
  }
});

export default router
