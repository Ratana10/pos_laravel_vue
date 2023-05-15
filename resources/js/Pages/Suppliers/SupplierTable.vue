<template>
   <div class="row">
      <div class="col-sm-12">
         <table class="table table-bordered">
         <thead>
            <tr>
               <th style="width: 10px;">#</th>
               <th>Name</th>
               <th style="width: 100px;">Gender</th>
               <th>Description</th>
               <th>Phone</th>
               <th>Address</th>
               <th style="width: 100px;">Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr v-for="(supplier, index) in suppliers" :key="index">
               <td>{{ index+1 }}</td>
               <td>{{ supplier.name }}</td>
               <td>{{ supplier.gender == 1 ? 'Male' : 'Female' }}</td>
               <td>{{ supplier.description }}</td>
               <td>{{ supplier.phone }}</td>
               <td>{{ supplier.address }}</td>
               <td>
                  <button class="btn btn-primary btn-sm" @click="$emit('edit', supplier)" ><i class="fa fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm ml-1" @click="$emit('delete', supplier.id)"><i class="fa fa-trash"></i></button>
               </td>
            </tr>
         </tbody>
      </table>
      </div>
      <div class="row">
         <!-- <div class="col-sm-12 col-md-5">
            <div>Showing 1 to 10 of 57</div>
         </div>
         <div class="col-sm-12 col-md-7">
            <div>
               pageinate
            </div>
         </div> -->
      </div>
   </div>
     
</template>
<script>
export default {
   props:{
      suppliers:{
         data: Array,
         default: null,
      }
   },
}
</script>
<style lang="">
   
</style>