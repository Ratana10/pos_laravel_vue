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
   <tbody>
      <tr v-for="(customer, index) in customers.data" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ customer.name }}</td>
         <td>{{ customer.gender == 1 ? 'Male' : 'Female' }}</td>
         <td>{{ customer.phone }}</td>
         <td>{{ customer.address }}</td>
         <td>{{ customer.description }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', customer)"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm ml-1" @click="confirm(customer.id)"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
   </tbody>
</table>
</template>

<script>
import Swal from 'sweetalert2';

export default {
   props: {
      customers: {
         data: Array,
         default: null,
      }
   },
   methods: {
      confirm(customer_id) {
         Swal.fire({
            title: 'Are you sure?',
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
                  text: 'Customer has been deleted.',
                  icon: 'success',
                  timer: 1000,
            })
               this.$emit('delete',customer_id);
            }
         })
      }
   },
}
</script>

<style lang="">
   
</style>
