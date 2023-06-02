<template lang="">
      <div class="modal fade" id="modal-view-payment" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
         <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                     <span class="text-lg font-semibold text-gray-400">VIEW PAYMENTS | Sale: {{ sale_code }} </span>
                     <span class=""></span>
                  </h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
               <table class="table text-center table-bordered">
                  <thead>
                     <tr class="bg-blue-400">
                        <th>Date</th>
                        <th>Paid Amount</th>
                        <th>Change</th>
                        <th>Amount</th>
                        <th>Pay By</th>
                        <th>Created By</th>
                     </tr>
                  </thead>
                  <tbody v-if="payments.data && payments.data.length > 0">
                        <tr v-for="(payment, index) in payments.data" :key="index">
                           <td>{{ payment.created_at }}</td>
                           <td>$ {{ payment.paid_amount }}</td>
                           <td>$ {{ payment.change }}</td>
                           <td class="text-lg font-semibold">$ {{ payment.amount }}</td>
                           <td >
                              <span :class="`btn btn-sm btn-${payment.payment_method.color} `">{{ payment.payment_method.name}}</span>
                           </td>
                           <td>{{ payment.created_by.name }}</td>
                        </tr>
                  </tbody>
                  <tbody v-else>
                        <tr>
                           <td colspan="6">No Record</td>
                        </tr>
                  </tbody>
               </table>
               </div>
               <div class="modal-footer">
   
               </div>
            </div>
         </div>
      </div>
</template>
<script setup>
import { defineProps } from 'vue';
const props = defineProps({
   payments:{
      data: Array,
      default: null,
   },
   sale_code:{
      data: String,
      default: null,
   }
})
</script>
<style lang="">
   
</style>