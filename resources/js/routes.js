import Dashboard from './Components/Dashboard.vue';
import Customer from './Pages/Cutomers/Customer.vue';
import Supplier from './Pages/Suppliers/Supplier.vue'
import Category from './Pages/Categories/Category.vue'
import Unit from './Pages/Units/Unit.vue'
import Exchange from './Pages/Exchanges/Exchange.vue'
import Product from './Pages/Products/Product.vue'
import ProductForm from './Pages/Products/ProductForm.vue'


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
   {
      path: '/admin/exchanges',
      name: 'admin.exchanges',
      component: Exchange,
   },
   {
      path: '/admin/units',
      name: 'admin.units',
      component: Unit,
   },
   {
      path: '/admin/products',
      name: 'admin.products',
      component: Product,
   },
   {
      path: '/admin/products/create',
      name: 'admin.products.create',
      component: ProductForm,
   },
]