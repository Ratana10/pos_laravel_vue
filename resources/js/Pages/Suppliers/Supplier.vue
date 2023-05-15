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
                  <input type="text" class="form-control" placeholder="Search Supplier" aria-label="Search Supplier">
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
               <supplier-table :suppliers="suppliers" @edit="handleEdit" @delete="handleDelete" />
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
import { useToastr } from '../../toastr';

export default {
   components: {
      SupplierTable,
      ModalAddSupplier,
   },
   data() {
      return {
         suppliers: [],
         editing: null,
         toastr: useToastr(),
      }
   },
   methods: {
      handleSubmit(){
         $('#modal-add-supplier').modal('hide');
         this.getSuppliers();
      },
      handleDelete(supplier_id){
         axios
            .delete(`/api/v1/suppliers/${supplier_id}`)
            .then(res =>{
               this.getSuppliers();
               this.toastr.success('Supplier Deleted Successfully');
            })
      },
      handleEdit(supplier){
         this.editing = supplier;
         $('#modal-add-supplier').modal('show');
      },
      handleAdd() {
         $('#modal-add-supplier').modal('show');
      },
      getSuppliers(){
         axios.get('/api/v1/suppliers')
         .then(res =>{
            this.suppliers = res.data;
         })
      }

   },
   mounted() {
      this.getSuppliers();
   },
}
</script>

<style>
   
</style>
