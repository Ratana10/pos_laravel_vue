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
                  <input v-model="search" type="text" class="form-control" placeholder="Search Customer">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                        <i class="fa fa-search"></i>
                     </span>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-12">
                     <div>
                        <label for="">Pages: </label>
                        <select v-model="page" class="ml-2">
                           <option v-for="page in pages" :key="page.name" :value="page.value">{{ page.name}}</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <customer-table :customers="customers" @edit="handleEdit" @delete="handleDelete" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (customers.current_page - 1) * customers.per_page + 1 }}
                        - {{ Math.min(customers.current_page * customers.per_page, customers.total) }}
                        of {{ customers.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="customers" @pagination-change-page="getcustomers" />
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <modal-add-customer :editing="editing" @submit="handleSubmit" />
</div>
</template>

<script>
import CustomerTable from './CustomerTable.vue';
import ModalAddCustomer from './ModalAddCustomer.vue';
import { showToast } from '../../swalUtils';
import { debounce } from 'lodash';

import {
   Bootstrap4Pagination
} from 'laravel-vue-pagination';

export default {
   components: {
      CustomerTable,
      ModalAddCustomer,
      Bootstrap4Pagination
   },
   mounted() {
      this.getCustomers();
   },
   watch:{
      page: function(page){
         this.getCustomers();
      },
      search: debounce(function(){
         this.searchCustomer();
      }, 300),
   },
   data() {
      return {
         customers: [],
         editing: null,
         search: null,
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
      searchCustomer(){
         axios
            .get(`/api/v1/customers/search?search=${this.search}`)
            .then(res =>{
               this.customers = res.data;
            })
      },
      handleSubmit(icon, title){
         $('#modal-add-customer').modal('hide');
         showToast(icon, title);               
         this.getCustomers();
      },
      handleDelete(customer_id){
         axios
            .delete(`/api/v1/customers/${customer_id}`)
            .then(res =>{
               console.log('delted');
               this.getCustomers();
            })
      },
      handleEdit(customer){
         this.editing = customer;
         $('#modal-add-customer').modal('show');
      },
      handleAdd() {
         this.editing = null;
         $('#modal-add-customer').modal('show');
      },
      getCustomers(page=1){
         axios
         .get(`/api/v1/customers?page=${page}&perPage=${this.page}`)
         .then(res =>{
            this.customers = res.data;
         })
      },
   },
  
}
</script>

<style>
   
</style>
