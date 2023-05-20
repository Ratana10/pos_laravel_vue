<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Name</th>
         <th>Status</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody>
      <tr v-for="(category, index) in categories.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ category.name }}</td>
         <td>{{ category.status == 1 ? 'Active' : 'Inactive' }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', category)"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm ml-1" @click="$emit('delete', category.id)"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
   </tbody>
</table>
</template>

<script>
export default {
   props: {
      categories: {
         data: Array,
         default: null,
      }
   },
}
</script>

<style lang="">
   
</style>
