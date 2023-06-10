
export default
[
   {
      path: '/admin/dashboard',
      name: 'admin.dashboard',
      component:  ()=> import('./Components/Dashboard.vue'),
   },
   {
      path: '/admin/customers',
      name: 'admin.customers.index',
      component:  ()=> import('./Pages/Customers/CustomerIndex.vue'),
   }, 
   {
      path: '/admin/users',
      name: 'admin.users.index',
      component:  ()=> import('./Pages/Users/UserIndex.vue'),
   }, 
   {
      path: '/admin/suppliers',
      name: 'admin.suppliers.index',
      component:  ()=> import('./Pages/Suppliers/SupplierIndex.vue'),
   },
   {
      path: '/admin/categories',
      name: 'admin.categories.index',
      component:  ()=> import('./Pages/Categories/CategoryIndex.vue'),
   },
   {
      path: '/admin/exchanges',
      name: 'admin.exchanges.index',
      component:  ()=> import('./Pages/Exchanges/ExchangeIndex.vue'),
   },
   {
      path: '/admin/units',
      name: 'admin.units.index',
      component: ()=> import('./Pages/Units/UnitIndex.vue'),
   },
   {
      path: '/admin/products',
      name: 'admin.products.index',
      component: ()=> import('./Pages/Products/ProductIndex.vue'),
   },
   {
      path: '/admin/products/create',
      name: 'admin.products.create',
      component: ()=> import('./Pages/Products/ProductForm.vue'),
   },
   {
      path: '/admin/products/:id/edit',
      name: 'admin.products.edit',
      component: ()=> import('./Pages/Products/ProductForm.vue'),
   },
   {
      path: '/admin/payments',
      name: 'admin.payments',
      component: ()=> import('./Pages/Payments/Payment.vue'),
   },
   {
      path: '/admin/sales',
      name: 'admin.sales',
      component: ()=> import('./Pages/Sales/Sale.vue'),
   },
   {
      path: '/admin/pos',
      name: 'admin.pos',
      component: ()=> import('./Pages/Pos/Pos.vue'),
   },
   {
      path: '/admin/purchases',
      name: 'admin.purchases.index',
      component: ()=> import('./Pages/Purchases/PurchaseIndex.vue'),
   },
   {
      path: '/admin/purchases/create',
      name: 'admin.purchases.create',
      component: ()=> import('./Pages/Purchases/PurchaseForm.vue'),
   },
   {
      path: '/admin/purchases/:id/edit',
      name: 'admin.purchases.edit',
      component: ()=> import('./Pages/Purchases/PurchaseForm.vue'),
   },
]