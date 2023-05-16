<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">
                  <span>Create Product</span>
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <router-link to="/admin/dashboard" class="breadcrumb-item">
                     <a>Home</a>
                  </router-link>
                  <router-link to="/admin/products" class="breadcrumb-item">
                     <a>Products</a>
                  </router-link>
                  <li class="breadcrumb-item active">
                     <span>Create</span>
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <form action="">
                     <div class="card-body">

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Code</label>
                                 <input type="text" name="" id="" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Barcode</label>
                                 <input type="text" name="" id="" class="form-control">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Product Name</label>
                                 <input type="text" name="" id="" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Category</label>
                              <select name="" id="" class="form-control">
                                 <option>Select Category ...</option>
                                 <option v-for="(category, index) in categories" :key="index" :value="category.id">
                                    {{ category.name }}
                                 </option>
                              </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Price</label>
                              <input type="text" name="" id="" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Quantity</label>
                              <input type="text" name="" id="" class="form-control">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Unit Price</label>
                              <input type="text" name="" id="" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Image</label>
                              <input type="file" name="" id="" class="form-control">
                              </div>
                           </div>

                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Status</label>
                              <select name="" id="" class="form-control">
                                 <option value="1">Active</option>
                                 <option value="0">Inactive</option>
                              </select>
                              </div>
                           </div>

                        </div>
                        <div class="mt-4">
                           <input type="button" value="Save" class="btn btn-primary">
                        </div>
                     </div>

                  </form>
                  <div class="card-body">

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</template>

<script>
export default {
   data() {
      return {
         categories: [],
      }
   },
   methods: {
      getCategories(){
         axios
            .get('/api/v1/categories')
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

<style lang="">
   
</style>
