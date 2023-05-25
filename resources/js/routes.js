import Dashboard from './Components/Dashboard.vue';
import Customer from './Pages/Customers/Customer.vue';
import Supplier from './Pages/Suppliers/Supplier.vue'
import Category from './Pages/Categories/Category.vue'
import Unit from './Pages/Units/Unit.vue'
import Exchange from './Pages/Exchanges/Exchange.vue'
import Product from './Pages/Products/Product.vue'
import ProductForm from './Pages/Products/ProductForm.vue'
import Payment from './Pages/Payments/Payment.vue'
import Sale from './Pages/Sales/Sale.vue'
import Invoice from './Pages/SaleTest/Invoice.vue'
import Pos from './Pages/Pos/Pos.vue'


export default
[

   {
      path: '/admin/sales/test-invoice',
      name: 'admin.sale.invoice',
      component: Invoice,
   },
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
   {
      path: '/admin/products/:id/edit',
      name: 'admin.products.edit',
      component: ProductForm,
   },
   {
      path: '/admin/payments',
      name: 'admin.payments',
      component: Payment,
   },
   {
      path: '/admin/sales',
      name: 'admin.sales',
      component: Sale,
   },
   {
      path: '/admin/pos',
      name: 'admin.pos',
      component: Pos,
   },
]