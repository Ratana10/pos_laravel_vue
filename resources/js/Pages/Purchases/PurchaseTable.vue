<template>
<table class="table table-bordered">
   <thead class="bg-gray">
      <tr >
         <th style="width: 10px;">#</th>
         <th>Date</th>
         <th>PO Code</th>
         <th>Total</th>
         <th>Payment Status</th>
         <th>Created By</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody v-if="purchases.data && purchases.data.length > 0">
      <tr v-for="(purchase, index) in purchases.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ purchase.date }}</td>
         <td>{{ purchase.code }}</td>
         <td>$ {{ purchase.total }}</td>
         <td>
               <span :class="`btn btn-sm btn-${purchase.status.color} `">{{ purchase.status.name }}</span>
         </td>
         <td>{{ purchase.created_by }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', purchases)"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm ml-1" @click="$emit('delete', purchase)"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
   </tbody>
   <tbody v-else>
      <tr>
         <td colspan="7" class="text-center">No Record</td>
      </tr>
   </tbody>
</table>
</template>

<script setup>
import {defineProps} from 'vue';
const props = defineProps({
   purchases:{
      data: Array,
      default: null,
   }
})
</script>

<style lang="">
   
</style>
