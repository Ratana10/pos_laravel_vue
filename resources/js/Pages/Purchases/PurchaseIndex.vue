<template>
  <div>
     <div class="content-header">
        <div class="container-fluid">
           <div class="row mb-2">
              <div class="col-sm-6">
                 <h1 class="m-0">Purchases</h1>
              </div>
              <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Purchases</li>
                 </ol>
              </div>
           </div>
        </div>
     </div>
     <div class="content">
        <div class="container-fluid">
           <div class="d-flex justify-content-between">
              <div>
                <router-link to="/admin/purchases/create" type="button" class="btn btn-primary mb-2">
                  <i class="fa fa-plus"></i>
                  Add New Purchase
               </router-link>
              </div>
              <div>
                 <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search payments" aria-label="Search Supplier">
                 </div>
              </div>
           </div>
           <div class="card">
              <div class="card-body">
                 <div class="row">
                    <div class="col-sm-12">
                       <!-- <div>
                          <label for="">Pages: </label>
                          <select v-model="perPage" class="ml-2">
                             <option v-for="(page, index) in pages" :key="index" :value="page.value">{{ page.label }}
                             </option>
                          </select>
                       </div> -->
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-sm-12">
                       <!-- <payment-table :payments="payments" @edit="handleEdit" @delete="handleDelete" /> -->
                    </div>
                 </div>
                 <!-- <div class="d-flex justify-content-between">
                    <div class="dataTables_info" role="status" aria-live="polite">
                       Showing {{ (payments.current_page - 1) * payments.per_page + 1 }}
                       - {{ Math.min(payments.current_page * payments.per_page, payments.total) }}
                       of {{ payments.total }}
                    </div>
                    <div class="">
                       <Bootstrap4Pagination :data="payments" @pagination-change-page="onPageChange" />
                    </div>
                 </div> -->

              </div>
           </div>
        </div>
     </div>

  </div>
</template>
 
 <script>

 </script>
 
 <style scoped>
 /* Add your component's styles here */
 </style>
 