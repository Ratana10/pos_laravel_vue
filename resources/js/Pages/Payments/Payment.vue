<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Peyments</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Peyments</li>
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
                  Add New payments
               </button>
            </div>
            <div>
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search payments" aria-label="Search Supplier">
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <payments-table :payments="payments" @edit="handleEdit" @delete="handleDelete" />
            </div>
         </div>
      </div>
   </div>

</div>
</template>

<script>
import PaymentsTable from './PaymenttTable.vue';

export default {
   components: {
      PaymentsTable,
   },
   data() {
      return {
         payments: [],
      }
   },
   methods: {
      getpayments(){
         axios.get('/api/v1/payments')
         .then(res =>{
            this.payments = res.data;
         })
      }

   },
   mounted() {
      this.getpayments();
   },
}
</script>

<style>
   
</style>
