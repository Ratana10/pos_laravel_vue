<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Name</th>
         <th style="width: 100px;">Gender</th>
         <th>Phone</th>
         <th>Address</th>
         <th>Description</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody v-if="customers.data && customers.data.length > 0">
      <tr v-for="(customer, index) in customers.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ customer.name }}</td>
         <td>{{ customer.gender }}</td>
         <td>{{ customer.phone }}</td>
         <td>{{ customer.address }}</td>
         <td>{{ customer.description }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', customer)"><i class="fa fa-edit"></i></button>
            <button class="ml-1 btn btn-danger btn-sm" @click="$emit('delete', customer)"><i class="fa fa-trash"></i></button>
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
import { defineProps } from 'vue';

const props = defineProps({
   customers: {
      type: Array,
   }
})
</script>

<style lang="">
   
</style>
