<template>
   <div class="row">
      <div class="col-sm-12">
         <table class="table table-bordered">
         <thead>
            <tr>
               <th style="width: 10px;">#</th>
               <th>Name</th>
               <th style="width: 100px;">Gender</th>
               <th>Phone</th>
               <th>Address</th>
               <th style="width: 100px;">Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr v-for="(customer, index) in customers" :key="index">
               <td>{{ index+1 }}</td>
               <td>{{ customer.name }}</td>
               <td>{{ customer.gender == 1 ? 'Male' : 'Female' }}</td>
               <td>{{ customer.phone }}</td>
               <td>{{ customer.address }}</td>
               <td>
                  <button class="btn btn-primary btn-sm" @click="$emit('edit', customer)" ><i class="fa fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm ml-1" @click="$emit('delete', customer.id)"><i class="fa fa-trash"></i></button>
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
      customers:{
         data: Array,
         default: null,
      }
   },
}
</script>
<style lang="">
   
</style>