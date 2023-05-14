<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Customers</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Customers</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="content">
      <div class="container-fluid">
         <div class="d-flex justify-content-between">
            <div>
               <button @click="handleAdd" type="button" class="btn btn-primary mb-2">
                  <i class="fa fa-plus"></i>
                  Add New Customer
               </button>
            </div>
            <div>
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search Customer" aria-label="Search Customer">
                  <div class="input-group-prepend">
                     <select name="" id="" class="btn btn-default">
                        <option value="">Name</option>
                        <option value="">Phone Number</option>
                     </select>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <customer-table />
            </div>
         </div>
      </div>
   </div>

   <modal-customer />
</div>
</template>

<script>
import CustomerTable from './CustomerTable.vue';
import ModalCustomer from './ModalCustomer.vue';

export default {
   components: {
      CustomerTable,
      ModalCustomer,
   },
   data() {
      return {

      }
   },
   methods: {
      handleAdd() {
         $('#modal-add-customer').modal('show');
      }
   },
}
</script>

<style>
   
</style>
