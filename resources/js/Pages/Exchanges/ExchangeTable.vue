<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Dollar</th>
         <th>Khmer</th>
         <th>Status</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody v-if="exchanges.data && exchanges.data.length > 0">
      <tr v-for="(exchange, index) in exchanges.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ exchange.dollar }}</td>
         <td>{{ exchange.khmer }}</td>
         <td>{{ exchange.status == 1 ? 'Active' : 'Inactive' }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', exchange)"><i class="fa fa-edit"></i></button>
            <button class="ml-1 btn btn-danger btn-sm" @click="$emit('delete', exchange)"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
   </tbody>
   <tbody v-else>
      <tr>
         <td colspan="5" class="text-center">No Record</td>
      </tr>
   </tbody>
</table>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
   exchanges: {
      type: Array,
   }
})
</script>

<style lang="">
   
</style>
