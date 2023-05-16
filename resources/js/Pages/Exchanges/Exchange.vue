<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Exchange</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Exchange</li>
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
                  Add New Exchange
               </button>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <exchange-table :exchanges="exchanges" @edit="handleEdit" @delete="handleDelete" />
            </div>
         </div>
      </div>
   </div>

   <modal-add-exchange :editing="editing" @submit="handleSubmit" />
</div>
</template>

<script>
import ExchangeTable from './ExchangeTable.vue';
import ModalAddExchange from './ModalAddExchange.vue';
import { useToastr } from '../../toastr';

export default {
   components: {
      ExchangeTable,
      ModalAddExchange,
   },
   data() {
      return {
         exchanges: [],
         editing: null,
         toastr: useToastr(),
      }
   },
   methods: {
      handleSubmit(){
         $('#modal-add-exchange').modal('hide');
         this.getexchanges();
      },
      handleDelete(exchange_id){
         axios
            .delete(`/api/v1/exchanges/${exchange_id}`)
            .then(res =>{
               this.getexchanges();
               this.toastr.success('Exchange Deleted Successfully');
            })
      },
      handleEdit(exchange){
         this.editing = exchange;
         $('#modal-add-exchange').modal('show');
      },
      handleAdd() {
         $('#modal-add-exchange').modal('show');
      },
      getexchanges(){
         axios.get('/api/v1/exchanges')
         .then(res =>{
            this.exchanges = res.data;
         })
      }

   },
   mounted() {
      this.getexchanges();
   },
}
</script>

<style>
   
</style>
