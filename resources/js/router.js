import Router from 'vue-router';
import CustomersList from './pages/CustomerList.vue';
import CustomerCreate from './pages/CustomerCreate.vue';
import CustomerEdit from './pages/CustomerEdit.vue';
import Welcome from './pages/Welcome.vue';
import NotFound from './pages/NotFound.vue';

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      redirect: '/customers',
    },
    {
      path: '/customers',
      name: 'customer-list',
      component: CustomersList,
    },
    {
      path: '/customers/create',
      name: 'create-customer',
      component: CustomerCreate,
    },
    {
      path: '/customers/:id',
      name: 'edit-customer',
      component: CustomerEdit,
    },
    {
      path: '/',
      redirect: '/customers',
      name: 'welcome',
      component: Welcome,
    },
    {
      path: '/404',
      name: 'notFound',
      component: NotFound,
    },
    {
      path: '/:catchAll(.*)',
      redirect: '404',
    },
  ],
});

export default router;
