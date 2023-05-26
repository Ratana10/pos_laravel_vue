<template>
   <table class="table table-bordered">
      <thead>
         <tr>
            <th style="width: 10px;">#</th>
            <th>Date</th>
            <th>Sale Code</th>
            <th>Customer</th>
            <th>Due_amount</th>
            <th>Paid_Amount</th>
            <th>Remain</th>
            <th>Status</th>
            <th>SellBy</th>
            <th>Add Payment</th>
            
         </tr>
      </thead>
      <tbody>
         <tr v-for="(sale, index) in sales.data" :key="index">
            <td>{{ index+1 }}</td>
            <td>{{ sale.created_at }}</td>
            <td>{{ sale.sale_code }}</td>
            <td>{{ sale.customer }}</td>
            <td>$ {{ sale.due_amount }}</td>
            <td>$ {{ sale.paid_amount }}</td>
            <td>$ {{ sale.remain }}</td>   
            <td >
               <span :class="`btn btn-sm btn-${sale.status.color} `">{{ sale.status.name }}</span>
            </td>
            <td>{{ sale.sell_by }}</td>
            <td>
               <button class="btn btn-primary" @click="$emit('show', sale)">Payment</button>
            </td>
         </tr>
      </tbody>
   </table>
   </template>
   
   <script>
   export default {
      props: {
         sales: {
            data: Array,
            default: null,
         }
      },
   }
   </script>
   
   <style lang="">
      
   </style>
   