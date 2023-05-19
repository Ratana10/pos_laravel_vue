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
               <customer-table :customers="customers" @edit="handleEdit" @delete="handleDelete" />
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
import { useToastr } from '../../toastr';
import Swal from 'sweetalert2'

export default {
   components: {
      CustomerTable,
      ModalAddCustomer,
   },
   data() {
      return {
         customers: [],
         editing: null,
         toastr: useToastr(),
      }
   },
   methods: {
      handleSubmit(){
         $('#modal-add-customer').modal('hide');
         this.getCustomers();
      },
      handleDelete(customer_id){
         axios
            .delete(`/api/v1/customers/${customer_id}`)
            .then(res =>{
               this.getCustomers();
               this.toastr.success('Customer Deleted Successfully');
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
         axios.get(`/api/v1/customers?page=${page}`)
         .then(res =>{
            this.customers = res.data.data.data;
         })
      }

   },
   mounted() {
      this.getCustomers();
   },
}
</script>

<style>
   
</style>
