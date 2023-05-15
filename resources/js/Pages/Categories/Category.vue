<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Categories</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Categories</li>
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
                  Add New Category
               </button>
            </div>
            <div>
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search Category" aria-label="Search Supplier">
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <category-table :categories="categories" @edit="handleEdit" @delete="handleDelete" />
            </div>
         </div>
      </div>
   </div>

   <modal-add-category :editing="editing" @submit="handleSubmit" />
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
         categories: [],
         editing: null,
         toastr: useToastr(),
      }
   },
   methods: {
      handleSubmit(){
         $('#modal-add-category').modal('hide');
         this.getCategories();
      },
      handleDelete(category_id){
         axios
            .delete(`/api/v1/categories/${category_id}`)
            .then(res =>{
               this.getCategories();
               this.toastr.success('Category Deleted Successfully');
            })
      },
      handleEdit(category){
         this.editing = category;
         $('#modal-add-category').modal('show');
      },
      handleAdd() {
         $('#modal-add-category').modal('show');
      },
      getCategories(){
         axios.get('/api/v1/categories')
         .then(res =>{
            this.categories = res.data;
         })
      }

   },
   mounted() {
      this.getCategories();
   },
}
</script>

<style>
   
</style>
