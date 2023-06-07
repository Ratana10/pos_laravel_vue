<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Name</th>
         <th style="width: 100px;">Gender</th>
         <th>Phone</th>
         <th>Description</th>
         <th>Status</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody v-if="suppliers.data && suppliers.data.length > 0">
      <tr v-for="(supplier, index) in suppliers.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ supplier.name }}</td>
         <td>{{ supplier.gender == 1 ? 'Male' : 'Female' }}</td>
         <td>{{ supplier.phone }}</td>
         <td>{{ supplier.description }}</td>
         <td>{{ supplier.status }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', supplier)"><i class="fa fa-edit"></i></button>
            <button class="ml-1 btn btn-danger btn-sm" @click="$emit('delete', supplier)"><i class="fa fa-trash"></i></button>
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
   suppliers: {
      type: Array,
   }
})
</script>

<style lang="">
   
</style>
