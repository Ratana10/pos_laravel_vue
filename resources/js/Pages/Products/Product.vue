<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Products</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Products</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="content">
      <div class="container-fluid">
         <div class="d-flex justify-content-between mb-3">
            <div>
               <router-link to="/admin/products/create" class="btn btn-primary">
                  <i class="fa fa-plus"></i>
                  Add New Product
               </router-link>
            </div>
            <div>
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search Product" aria-label="Search product">
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
               <div class="row">
                  <div class="col-sm-12">
                     <div>
                        <label for="">Pages: </label>
                        <select v-model="page" class="ml-2">
                           <option v-for="page in pages" :key="page.name" :value="page.value">{{ page.name}}</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <product-table :products="products" @edit="handleEdit" @delete="handleDelete" />
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                     <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ (products.current_page - 1) * products.per_page + 1 }}
                        - {{ Math.min(products.current_page * products.per_page, products.total) }}
                        of {{ products.total }}
                     </div>
                  <div class="">
                     <Bootstrap4Pagination :data="products" @pagination-change-page="getProducts" />
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

</div>
</template>

<script>
import ProductTable from './ProductTable.vue';
import { useToastr } from '../../toastr';
import {
   Bootstrap4Pagination
} from 'laravel-vue-pagination';

export default {
   components: {
      ProductTable,
      Bootstrap4Pagination
   },
   mounted() {
      this.getProducts();
   },
   watch:{
      page: function(page){
         this.getProducts();
      }
   },
   data() {
      return {
         products: [],
         editing: null,
         toastr: useToastr(),
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
      handleSubmit(){
        
         this.getProducts();
      },
      handleDelete(product_id){
         axios
            .delete(`/api/v1/products/${product_id}`)
            .then(res =>{
               this.getProducts();
               this.toastr.success('Product Deleted Successfully');
            })
      },
      handleEdit(product){
         this.editing = product;
      },
      handleAdd() {
      },
      getProducts(page=1){
         axios
            .get(`/api/v1/products?page=${page}&perPage=${this.page}`)
            .then(res =>{
               this.products = res.data;
            })
      }

   },
 
}
</script>

<style>
   
</style>
