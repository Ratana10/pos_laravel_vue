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
            <th>Actions</th>

         </tr>
      </thead>
      <tbody v-if="sales.data && sales.data.length > 0">
         <tr v-for="(sale, index) in sales.data" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ sale.created_at }}</td>
            <td>{{ sale.sale_code }}</td>
            <td>{{ sale.customer }}</td>
            <td>$ {{ sale.due_amount }}</td>
            <td>$ {{ sale.paid_amount }}</td>
            <td>$ {{ sale.remain }}</td>
            <td>
               <span :class="`btn btn-sm btn-${sale.status.color} `">{{ sale.status.name }}</span>
            </td>
            <td>{{ sale.sell_by }}</td>
            <td >
               <!-- {{ actionsOptions }} -->
               <select @change="onChangeAction(sale, $event.target.value)">
                  <option >Select Option ...</option>
                  <option 
                   v-for="(item, index) in actionOptions" 
                   :key="index" :value="item.value"
                   class="form-control">
                   {{ item.label }}
                  </option>
               </select>
               <!-- <button class="btn btn-primary" @click="$emit('show', sale)">Payment</button> -->
            </td>
         </tr>
      </tbody>
      <tbody v-else>
         <tr>
            <td colspan="10" class="text-center">No Record</td>
         </tr>
      </tbody>
   </table>
</template>
   
<script setup>
import { defineProps } from 'vue';
const props = defineProps({
   sales:{
      data: Array,
      default: null,
   },
   actionOptions: {
      data: Array,
      default: null,
   }
})

const onChangeAction = (sale, value)=>{
   let selectedOption = props.actionOptions.find(e => e.value === value)
   if(selectedOption && selectedOption.function){
      selectedOption.function(sale);
   }
}
</script>
   
<style lang="">
      
   </style>
   