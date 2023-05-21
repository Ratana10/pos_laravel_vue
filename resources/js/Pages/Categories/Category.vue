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
         </div>
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-12">
                        <label for="">Pages: </label>
                        <select v-model="perPage" class="ml-2">
                           <option v-for="page in pages" :key="page.name" :value="page.value">{{ page.name}}</option>
                        </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                  <category-table :categories="categories" @edit="handleEdit " @delete="getCategories" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (categories.current_page - 1) * categories.per_page + 1 }}
                        - {{ Math.min(categories.current_page * categories.per_page, categories.total) }}
                        of {{ categories.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="categories" @pagination-change-page="getCategories" />
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

   <modal-add-category :editing="editing" @submit="getCategories" />
</div>
</template>

<script>
import CategoryTable from './CategoryTable.vue';
import ModalAddCategory from './ModalAddCategory.vue';
import { showToast } from '../../swalUtils';
import {
   Bootstrap4Pagination
} from 'laravel-vue-pagination';

export default {
   components: {
      CategoryTable,
      ModalAddCategory,
      Bootstrap4Pagination,
   },
   mounted() {
      this.getCategories();
   },
   watch:{
      perPage: function(newValu){
         this.getCategories();
      }
   },
   data() {
      return {
         categories: [],
         editing: null,
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
      handleEdit(category){
         this.editing = category;
         $('#modal-add-category').modal('show');
      },
      handleAdd() {
         this.editing = null;
         $('#modal-add-category').modal('show');
      },
      getCategories(page=1){
         axios
         .get(`/api/v1/categories?page=${page}&perPage=${this.perPage}`)
         .then(res =>{
            this.categories = res.data.data;
         })
      }

   },
   
}
</script>

<style>
   
</style>
