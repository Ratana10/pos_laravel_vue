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
                  <form method="post" @submit.prevent="handleSubmit" enctype="multipart/form-data">
                     <div class="card-body">

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="form-label">Code</label>
                                 <input v-model="form.code" type="text" name="" id="" class="form-control" disabled>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Barcode</label>
                                 <input v-model="form.barcode" type="text" name="" id="" class="form-control" disabled>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Product Name</label>
                                 <input v-model="form.name" type="text" name="" id="" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Category</label>
                              <select v-model="form.category_id" name="" id="" class="form-control">
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
                                 <input v-model="form.price" type="number" name="" id="" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Quantity</label>
                                 <div class="input-group-prepend">
                                    <input v-model="form.quantity" type="number" class="form-control rounded-0">
                                    <select v-model="form.unit_id" class="form-control custom-select rounded-0" style="width: 200px;">
                                       <option v-for="(unit, index) in units" :key="index" :value="unit.id">
                                          {{ unit.name }}
                                       </option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Cost</label>
                              <input v-model="form.cost" type="number" name="" id="" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Alert</label>
                                 <input v-model="form.alert" type="number" name="" id="" class="form-control">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="card">
                                 <div class="card-header">
                                    <label for="image">Image</label>
                                    <div class="card-tools">
                                       <button type="button" class="btn btn-tool text-primary" @click="handleBrowse">
                                          <i class="fa fa-paperclip"></i>
                                          Browse
                                       </button>
                                    </div>
                                 </div>
                                 <div class="card-body text-center ">
                                    <input type="file" id="image" class="d-none" @change="onImageChange">
                                    <img class="img-fluid" style="height: 200px;" :src="form.image" alt="photo">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Status</label>
                              <select v-model="form.status" name="" id="" class="form-control">
                                 <option value="1">Active</option>
                                 <option value="0">Inactive</option>
                              </select>
                              </div>
                           </div>

                        </div>
                        <div class="mt-4">
                           <input type="submit" value="Save" class="btn btn-primary" >
                        </div>
                     </div>

                  </form>
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
         units: [],
         form:{
            code: null,
            name: null,
            category_id: null,
            unit_id: null,
            cost: null,
            price: null,
            quantity: null,
            alert: null,
            image:null,
            barcode: null,
            status: 1,
         }
      }
   },
   methods: {
      handleSubmit(){
         console.log('form', this.form)
         axios
            .post('/api/v1/products', this.form)
            .then(res =>{
               
            })
            .catch(err =>{
               console.log('erros: ', err);
            })
      },
      onImageChange(event){
         // this.form.image = event.target.files[0];
         let file = event.target.files;
         let reader = new FileReader();
         reader.onloadend = (file)=>{
            this.form.image = file.target.result;  
         }
         reader.readAsDataURL(file[0]);
      },
      handleBrowse(){
        $('#image').trigger('click');
      },
      getUnits(){
         axios
            .get('/api/v1/units')
            .then(res =>{
               this.units = res.data;
            })
      },
      getCategories(){
         axios
            .get('/api/v1/categories')
            .then(res =>{
               this.categories = res.data;
            })
      }
   },
   mounted() {
      this.getUnits();
      this.getCategories();
   },
}
</script>

<style scoped>
   .form-control{
      border-radius: 0 !important;
   }
   .min--heigh{
      min-height: 10px;
   }
</style>
