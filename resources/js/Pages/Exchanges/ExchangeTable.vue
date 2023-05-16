<template>
   <div class="row">
      <div class="col-sm-12">
         <table class="table table-bordered">
         <thead>
            <tr>
               <th style="width: 10px;">#</th>
               <th>Dollar</th>
               <th>Khmer</th>
               <th>Created_At</th>
               <th>Status</th>
               <th style="width: 100px;">Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr v-for="(exchange, index) in exchanges" :key="index">
               <td>{{ index+1 }}</td>
               <td>{{ exchange.dollar }}</td>
               <td>{{ exchange.khmer }}</td>
               <td>{{ exchange.created_at }}</td>
               <td>{{ exchange.status == 1 ? 'Active' : 'Inactive' }}</td>
               <td>
                  <button class="btn btn-primary btn-sm" @click="$emit('edit', exchange)" ><i class="fa fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm ml-1" @click="$emit('delete', exchange.id)"><i class="fa fa-trash"></i></button>
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
      exchanges:{
         data: Array,
         default: null,
      }
   },
}
</script>
<style lang="">
   
</style>