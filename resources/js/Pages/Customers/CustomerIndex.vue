<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="mb-2 row">
            <div class="col-sm-6">
               <h1 class="m-0 font-semibold">Customers</h1>
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
               <button @click="openModal" type="button" class="mb-2 btn btn-primary">
                  <i class="fa fa-plus"></i>
                  Add New Customer
               </button>
            </div>
            <div>
               <div class="input-group">
                  <input  type="text" class="form-control" placeholder="Search Customer">
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
                        <label >Showing: </label>
                        <select v-model="perpage" class="ml-2">
                           <option v-for="(page, index) in pages" :key="index" :value="page.value">{{ page.label }} </option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <CustomerTable :customers="customers" @delete="deleteCustomer" @edit="editCustomer" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (customers.current_page - 1) * customers.per_page + 1 }}
                        - {{ Math.min(customers.current_page * customers.per_page, customers.total) }}
                        of {{ customers.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="customers" @pagination-change-page="onPageChange" />
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <ModalAddCustomer :editing="editing" @submit="getCustomers" />
</div>
</template>

<script setup>

import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import usePagination from '../../pagination';
import CustomerTable from './CustomerTable.vue';
import ModalAddCustomer from './ModalAddCustomer.vue';
import { onMounted, ref } from 'vue';
import useCustomers from '../../Composables/customers';
import useNotifications from '../../notifications';

const {customers, getCustomers, destroyCustomer} = useCustomers();

const {pages, perpage, onPageChange} = usePagination(getCustomers);

const {confirmNotification} = useNotifications();
onMounted(()=> getCustomers());

const deleteCustomer = async (customer) =>{
   await confirmNotification(customer.name)
   .then((result) =>{
      if(result){
         destroyCustomer(customer.id)
         getCustomers();
      }
   });  
}

const editing = ref(null);
const editCustomer = (customer) =>{
   editing.value = customer;
   $('#modal-add-customer').modal('show');
}

const openModal = async ()=>{
   editing.value = null;
   await $('#modal-add-customer').modal('show');
}

</script>

<!-- <script>
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
            .get(`/api/v1/customers-search?search=${this.search}`)
            .then(res =>{
               if(res.status){
                  this.customers = res.data.data;
               }
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
            if(res.data.status == true){
               this.customers = res.data.data;
            }
         })
      },
   },
  
}
</script> -->

<style>
   
</style>
