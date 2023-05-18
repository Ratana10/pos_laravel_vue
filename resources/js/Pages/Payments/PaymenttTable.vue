<template>
   <div class="row">
      <div class="col-sm-12">
         <table class="table table-bordered">
         <thead>
            <tr>
               <th style="width: 10px;">#</th>
               <th>Sale</th>
               <th>Amount</th>
               <th>Payment Method</th>
               <th>Created_By</th>
               <th>Date</th>
            </tr>
         </thead>
         <tbody>
            <tr v-for="(payment, index) in payments" :key="index">
               <td>{{ index+1 }}</td>
               <td>{{ payment.sale_id }}</td>
               <td>{{ payment.amount }}</td>
               <td>{{ payment.payment_method }}</td>
               <td>{{ payment.created_by }}</td>
               <td>{{ payment.date }}</td>
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
      payments:{
         data: Array,
         default: null,
      }
   },
}
</script>
<style lang="">
   
</style>