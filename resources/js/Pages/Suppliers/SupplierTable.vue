<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Name</th>
         <th style="width: 100px;">Gender</th>
         <th>Description</th>
         <th>Phone</th>
         <th>Address</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody v-if="suppliers.data && suppliers.data.length > 0">
      <tr v-for="(supplier, index) in suppliers.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ supplier.name }}</td>
         <td>{{ supplier.gender == 1 ? 'Male' : 'Female' }}</td>
         <td>{{ supplier.description }}</td>
         <td>{{ supplier.phone }}</td>
         <td>{{ supplier.address }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', supplier)"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm ml-1" @click="confirm(supplier.id)"><i class="fa fa-trash"></i></button>
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

<script>
import Swal from 'sweetalert2';

export default {
   props: {
      suppliers: {
         data: Array,
         default: null,
      }
   },
   methods: {
      confirm(supplier_id) {
         Swal.fire({
            title: 'Are you sure delete this?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
            if (result.isConfirmed) {
               Swal.fire({
                  title: 'Deleted!',
                  text: 'Supplier has been deleted.',
                  icon: 'success',
                  timer: 1000,
            })
               this.$emit('delete',supplier_id);
            }
         })
      }
   },
}
</script>

<style lang="">
   
</style>
