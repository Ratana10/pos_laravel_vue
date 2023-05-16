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
         <div class="d-flex justify-content-between">
            <div>
               <button @click="handleAdd" type="button" class="btn btn-primary mb-2">
                  <i class="fa fa-plus"></i>
                  Add New Product
               </button>
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
               <product-table :products="products" @edit="handleEdit" @delete="handleDelete" />
            </div>
         </div>
      </div>
   </div>

</div>
</template>

<script>
import ProductTable from './ProductTable.vue';
import { useToastr } from '../../toastr';

export default {
   components: {
      ProductTable,
   },
   data() {
      return {
         products: [],
         editing: null,
         toastr: useToastr(),
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
      getProducts(){
         axios
            .get('/api/v1/products')
            .then(res =>{
               this.products = res.data;
            })
      }

   },
   mounted() {
      this.getProducts();
   },
}
</script>

<style>
   
</style>
