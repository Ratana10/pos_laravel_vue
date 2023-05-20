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
               <div class="row">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label for="">Pages: </label>
                        <select v-model="page" class="ml-2">
                           <option v-for="page in pages" :key="page.name" :value="page.value">{{ page.name}}</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <payments-table :payments="payments" @edit="handleEdit" @delete="handleDelete" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (payments.current_page - 1) * payments.per_page + 1 }}
                        to {{ Math.min(payments.current_page * payments.per_page, payments.total) }}
                        of {{ payments.total }} entries
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="payments" @pagination-change-page="getPayments" />
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

</div>
</template>

<script>
import PaymentsTable from './PaymenttTable.vue';
import {
   Bootstrap4Pagination
} from 'laravel-vue-pagination';

export default {
   components: {
      PaymentsTable,
      Bootstrap4Pagination,
   },
   data() {
      return {
         payments: [],
         page: 10,
         pages:[
            {
               name: '10',
               value: 10,
            },
            {
               name: '25',
               value: 25,
            },
            {
               name: '50',
               value: 50,
            },
            {
               name: '100',
               value: 100,
            },
         ]
      }
   },
   methods: {
      getPayments(page =1) {
         axios.get(`/api/v1/payments?page=${page}&perPage=${this.page}`,)
            .then(res => {
               console.log(res.data.data)
               this.payments = res.data;
            })
      }

   },
   mounted() {
      this.getPayments();
   },
   watch:{
      page: function(page){
         this.getPayments();
      }
   }
}
</script>

<style>
   
</style>
