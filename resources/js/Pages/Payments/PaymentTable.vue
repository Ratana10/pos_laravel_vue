<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Sale</th>
         <th>Amount</th>
         <th>Payment Method</th>
         <th>Sell By</th>
         <th>Date</th>
         <th>View</th>
      </tr>
   </thead>
   <tbody>
      <tr v-for="(payment, index) in payments.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ payment.sale_id }}</td>
         <td>$ {{ payment.amount }}</td>
         <td >
            <span :class="`badge badge-${payment.payment_method.color}`">{{ payment.payment_method.name }}</span>
         </td>
         <td>{{ payment.created_by.name }}</td>
         <td>{{ payment.created_at }}</td>
         <td></td>
      </tr>
   </tbody>
</table>
</template>

<script>
export default {
   props: {
      payments: {
         data: Array,
         default: null,
      }
   },
}
</script>

<style lang="">
   
</style>
