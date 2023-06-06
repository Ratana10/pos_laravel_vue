<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Name</th>
         <th>Email</th>
         <th>Type</th>
         <th>Status</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody v-if="users.data && users.data.length > 0">
      <tr v-for="(user, index) in users.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ user.name }}</td>
         <td>{{ user.email }}</td>
         <td>{{ user.type }}</td>
         <td>{{ user.status }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', user)"><i class="fa fa-edit"></i></button>
            <button class="ml-1 btn btn-danger btn-sm" @click="$emit('delete', user)"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
   </tbody>
   <tbody v-else>
      <tr>
         <td colspan="6" class="text-center">No Record</td>
      </tr>
   </tbody>
</table>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
   users: {
      type: Array,
   }
})
</script>

<style lang="">
   
</style>
