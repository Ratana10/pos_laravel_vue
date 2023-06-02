<template lang="">
<div class="modal fade" id="modal-view-sale-detail" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
               <span v-if="sale" class="text-lg font-semibold text-gray-400">VIEW SALE DETAILS | Sale: {{ sale.sale_code }} </span>
            </h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <table class="table text-center table-bordered">
               <thead>
                  <tr class="bg-blue-400">
                     <th>No</th>
                     <th>Product Name</th>
                     <th>Price</th>
                     <th>Quantity</th>
                     <th>Discount</th>
                     <th>Amount</th>
                  </tr>
               </thead>
               <tbody v-if="sale_details.data && sale_details.data.length > 0">
                  <tr v-for="(sale_detail, index) in sale_details.data" :key="index">
                     <td>{{ index+1 }}</td>
                     <td class="text-left">{{ sale_detail.product.name }}</td>
                     <td>$ {{ sale_detail.price }}</td>
                     <td>{{ sale_detail.quantity }}</td>
                     <td>{{ sale_detail.discount }}</td>
                     <td class="font-semibold ">$ {{ sale_detail.amount }}</td>
                  </tr>
               </tbody>
               <tbody v-else>
                  <tr>
                     <td colspan="6">No Record</td>
                  </tr>
               </tbody>
               <tfoot v-if="sale">
                  <tr>
                     <td class="text-lg text-right" colspan="5">Discount : </td>
                     <td></td>
                  </tr>
                  <tr>
                     <td class="text-lg text-right" colspan="5">Total : </td>
                     <td class="text-lg font-semibold">$ {{ sale.paid_amount }}</td>
                  </tr>
               </tfoot>
            </table>
            <div class="flex flex-row">
               <button v-if="sale" class="mr-3 btn btn-primary" :disabled="sale.status.name === 'PAID' "><i class="fa fa-dollar-sign"></i> Add Payment</button>
               <button class="btn btn-primary">View Payment</button>
            </div>
         </div>

      </div>
   </div>
</div>
</template>

<script setup>
import {
   defineProps
} from 'vue';
const props = defineProps({
   sale_details: {
      type: Array,
      default: null,
   },
   sale: {
      type: Object,
      default: null,
   }
})
</script>

<style lang="">
   
</style>
