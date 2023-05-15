import Dashboard from './Components/Dashboard.vue';
import Customer from './Pages/Cutomers/Customer.vue';
import Supplier from './Pages/Suppliers/Supplier.vue'
import Category from './Pages/Categories/Category.vue'

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
   {
      path: '/admin/categories',
      name: 'admin.categories',
      component: Category,
   },
]