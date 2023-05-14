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
            <button @click="handleAdd" type="button" class="btn btn-primary mb-2">
               <i class="fa fa-plus"></i>
               Add New Customer
            </button>
         </div>

         <div class="card">
            <div class="card-body">
               <customer-table />
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modal-add-customer">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Default Modal</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Save changes</button>
            </div>
         </div>
      </div>
   </div>

   </div>
</template>

<script>
import CustomerTable from './CustomerTable.vue'
export default {
   components: {
      CustomerTable,
   },
   data() {
      return {

      }
   },
   methods: {
      handleAdd(){
         $('#modal-add-customer').modal('show');
      }
   },
}
</script>

<style>
   
</style>
