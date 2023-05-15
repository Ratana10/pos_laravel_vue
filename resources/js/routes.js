import Dashboard from './Components/Dashboard.vue';
import Customer from './Pages/Cutomers/Customer.vue';
import Supplier from './Pages/Suppliers/Supplier.vue'

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
   {
      path: '/admin/suppliers',
      name: 'admin.suppliers',
      component: Supplier,
   },
]