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
                  <button @click="handleAdd" type="button" class="btn btn-primary mb-2">
                     <i class="fa fa-plus"></i>
                     Add New Purchase
                  </button>
               </div>
               <div>
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="Search purchase" aria-label="Search Supplier">
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-body">
                  <purchase-table :purchases="purchases" @edit="handleEdit" @delete="handleDelete" />
               </div>
            </div>
         </div>
      </div>
   
      <modal-add-purchase :editing="editing" @submit="handleSubmit" />
   </div>
   </template>
   
   <script>
   import CategoryTable from './CategoryTable.vue';
   import ModalAddCategory from './ModalAddCategory.vue';
   import { useToastr } from '../../toastr';
   
   export default {
      components: {
         CategoryTable,
         ModalAddCategory,
      },
      data() {
         return {
            purchases: [],
            editing: null,
            toastr: useToastr(),
         }
      },
      methods: {
         handleSubmit(){
            $('#modal-add-purchase').modal('hide');
            this.getpurchases();
         },
         handleDelete(purchase_id){
            axios
               .delete(`/api/v1/purchases/${purchase_id}`)
               .then(res =>{
                  this.getpurchases();
                  this.toastr.success('purchase Deleted Successfully');
               })
         },
         handleEdit(purchase){
            this.editing = purchase;
            $('#modal-add-purchase').modal('show');
         },
         handleAdd() {
            this.editing = null;
            $('#modal-add-purchase').modal('show');
         },
         getpurchases(){
            axios.get('/api/v1/purchases')
            .then(res =>{
               this.purchases = res.data;
            })
         }
   
      },
      mounted() {
         this.getpurchases();
      },
   }
   </script>
   
   <style>
      
   </style>
   