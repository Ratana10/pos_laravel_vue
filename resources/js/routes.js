import Dashboard from './Components/Dashboard.vue';
import Customer from './Pages/Cutomers/Customer.vue';
export default
[
   {
      path: '/admin/dashboard',
      name: 'admin.dashboard',
      component: Dashboard,
   },
   {
      path: '/admin/customers',
      name: 'admin.customers',
      component: Customer,
   },
]