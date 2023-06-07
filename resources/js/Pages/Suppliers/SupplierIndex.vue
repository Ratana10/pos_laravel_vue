<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="mb-2 row">
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
               <button @click="openModal" type="button" class="mb-2 btn btn-primary">
                  <i class="fa fa-plus"></i>
                  Add New Supplier
               </button>
            </div>
            <div>
               <div class="input-group">
                  <input v-model="search" type="text" class="form-control" placeholder="Search Supplier">
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
                        <label for="">Showing: </label>
                        <select v-model="perpage" class="ml-2">
                           <option v-for="(page, index) in pages"  :key="index" :value="page.value">{{ page.label }} </option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <SupplierTable :suppliers="suppliers" @delete="deleteSupplier" @edit="editSupplier"/>
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (suppliers.current_page - 1) * suppliers.per_page + 1 }}
                        - {{ Math.min(suppliers.current_page * suppliers.per_page, suppliers.total) }}
                        of {{ suppliers.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="suppliers" @pagination-change-page="onPageChange" />
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <modalAddSupplier :editing="editing" @submit="getSuppliers" />
</div>
</template>

<script setup>
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import usePagination from '../../pagination';
import SupplierTable from './SupplierTable.vue';
import ModalAddSupplier from './ModalAddSupplier.vue';
import { onMounted, ref } from 'vue';
import useNotifications from '../../notifications';
import useSupplier from '../../Composables/suppliers';

const {suppliers, getSuppliers, destroySupplier } = useSupplier();

const {pages, perpage, onPageChange} = usePagination(getSuppliers);

const {confirmNotification} = useNotifications();

onMounted(()=> getSuppliers());

const deleteSupplier = async (supplier) =>{
   await confirmNotification(supplier.name)
   .then((result) =>{
      if(result){
         destroySupplier(supplier.id)
         getSuppliers();
      }
   });  
}

const editing = ref(null);
const editSupplier = (supplier) =>{
   editing.value = supplier;
   $('#modal-add-supplier').modal('show');
      
}

const openModal = async ()=>{
   editing.value = null;
   await $('#modal-add-supplier').modal('show');
}


</script>

<style>
   
</style>
