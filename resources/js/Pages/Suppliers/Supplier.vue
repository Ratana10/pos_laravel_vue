<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Suppliers</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Suppliers</li>
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
                  Add New Supplier
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
                        <select v-model="perPage" class="ml-2">
                           <option v-for="page in pages" :key="page.name" :value="page.value">{{ page.name}}</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <supplier-table :suppliers="suppliers" @edit="handleEdit" @delete="handleDelete" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (suppliers.current_page - 1) * suppliers.per_page + 1 }}
                        - {{ Math.min(suppliers.current_page * suppliers.per_page, suppliers.total) }}
                        of {{ suppliers.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="suppliers" @pagination-change-page="getSuppliers" />
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <modal-add-supplier :editing="editing" @submit="handleSubmit" />
</div>
</template>

<script>
import SupplierTable from './SupplierTable.vue';
import ModalAddSupplier from './ModalAddSupplier.vue';
import { showToast } from '../../swalUtils';
import { debounce } from 'lodash';
import {
   Bootstrap4Pagination
} from 'laravel-vue-pagination';

export default {
   components: {
      SupplierTable,
      ModalAddSupplier,
      Bootstrap4Pagination,
   },
   mounted() {
      this.getSuppliers();
   },
   watch:{
      page: function(page){
         this.getSuppliers();
      },
      search: debounce(function(){
         this.searchSuppliers();
      }, 200),
   },
   data() {
      return {
         suppliers: [],
         editing: null,
         search: null,
         perPage: 10,
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
      searchSuppliers(){
         axios
            .get(`/api/v1/suppliers/search?search=${this.search}`)
            .then(res =>{
               this.suppliers = res.data.data;
            })
      },
      handleSubmit(icon, title){
         $('#modal-add-supplier').modal('hide');
         showToast(icon, title);               
         this.getSuppliers();
      },
      handleDelete(supplier_id){
         axios
            .delete(`/api/v1/suppliers/${supplier_id}`)
            .then(res =>{
               this.getSuppliers();
            })
      },
      handleEdit(supplier){
         this.editing = supplier;
         $('#modal-add-supplier').modal('show');
      },
      handleAdd() {
         this.editing = null;
         $('#modal-add-supplier').modal('show');
      },
      getSuppliers(page=1){
         axios
         .get(`/api/v1/suppliers?page=${page}&perPage=${this.perPage}`)
         .then(res =>{
            this.suppliers = res.data.data;
         })
      },
   },
   
}
</script>

<style>
   
</style>
