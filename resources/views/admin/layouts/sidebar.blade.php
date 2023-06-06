<aside class="main-sidebar sidebar-dark-primary elevation-4">

   <a href="index3.html" class="brand-link">
      <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
   </a>

   <div class="sidebar">
      <div class="pb-3 mt-3 mb-3 user-panel d-flex">
         <div class="image">
            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
               alt="User Image">
         </div>
         <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
         </div>
      </div>
      
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
            <li class="nav-item">
               <router-link to="/admin/dashboard"  class="nav-link " active-class="active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Dashboard
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/users" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Users
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/customers" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Customers
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/suppliers" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Suppliers
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/exchanges" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Exchange
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/units" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Units
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/categories" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Categories
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/products"  class="nav-link" :class="$route.path.startsWith('/admin/products') ? 'active' : '' ">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Products
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Stock
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/payments" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Payments
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/sales" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Sales
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/pos" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     POS
                  </p>
               </router-link>
            </li>
            <li class="nav-item">
               <router-link to="/admin/purchases" class="nav-link" :class="$route.path.startsWith('/admin/purchases') ? 'active' : '' ">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Purchase s
                  </p>
               </router-link>
            </li>
         </ul>
      </nav>
   </div>

</aside>