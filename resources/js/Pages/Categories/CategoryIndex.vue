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
               <button @click="openModal" type="button" class="btn btn-primary mb-2">
                  <i class="fa fa-plus"></i>
                  Add New Category
               </button>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-12">
                        <label for="">Showing: </label>
                        <select v-model="perpage" class="ml-2">
                           <option v-for="(page, index) in pages"  :key="index" :value="page.value">{{ page.label }} </option>
                        </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                  <CategoryTable :categories="categories" @edit="editCategory " @delete="deleteCategory" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (categories.current_page - 1) * categories.per_page + 1 }}
                        - {{ Math.min(categories.current_page * categories.per_page, categories.total) }}
                        of {{ categories.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="categories" @pagination-change-page="onPageChange" />
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

   <ModalAddCategory :editing="editing" @submit="getCategories" />
</div>
</template>

<script setup>
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import usePagination from '../../pagination';
import CategoryTable from './CategoryTable.vue';
import ModalAddCategory from './ModalAddCategory.vue';
import { onMounted, ref } from 'vue';
import useNotifications from '../../notifications';
import useCategories from '../../Composables/categories';

const { categories, getCategories, destroyCategory } = useCategories();

const {pages, perpage, onPageChange} = usePagination(getCategories);

onMounted(()=> getCategories());

const { confirmNotification } = useNotifications();

const deleteCategory = async (category) =>{
   await confirmNotification(category.name)
   .then((result) =>{
      if(result){
         destroyCategory(category.id)
         getCategories();
      }
   });  
}

const editing = ref(null);

const editCategory = (category) =>{
   editing.value = category;
   $('#modal-add-category').modal('show');
}


const openModal = async ()=>{
   editing.value = null;
   await $('#modal-add-category').modal('show');
}
</script>
   
<style>
</style>
