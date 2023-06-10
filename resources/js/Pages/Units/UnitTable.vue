<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Unit</th>
         <th>Status</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody v-if="units.data && units.data.length > 0">
      <tr v-for="(unit, index) in units.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ unit.name }}</td>
         <td>{{ unit.status == 1 ? 'Active' : 'Inactive' }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', unit)"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm ml-1" @click="$emit('delete',unit)"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
   </tbody>
   <tbody v-else>
      <tr>
         <td colspan="4" class="text-center">No Record</td>
      </tr>
   </tbody>
</table>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
   units: {
      type: Array,
   }
})

</script>
<style lang="">
   
</style>
