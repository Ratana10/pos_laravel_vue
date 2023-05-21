<template>
<table class="table table-bordered">
   <thead>
      <tr>
         <th style="width: 10px;">#</th>
         <th>Dollar</th>
         <th>Khmer</th>
         <th>Created_At</th>
         <th>Status</th>
         <th style="width: 100px;">Actions</th>
      </tr>
   </thead>
   <tbody>
      <tr v-for="(exchange, index) in exchanges" :key="index">
         <td>{{ index+1 }}</td>
         <td>{{ exchange.dollar }}</td>
         <td>{{ exchange.khmer }}</td>
         <td>{{ exchange.created_at }}</td>
         <td>{{ exchange.status == 1 ? 'Active' : 'Inactive' }}</td>
         <td>
            <button class="btn btn-primary btn-sm" @click="$emit('edit', exchange)"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm ml-1" @click="confirm(exchange)"><i class="fa fa-trash"></i></button>
         </td>
      </tr>
   </tbody>
</table>
</template>

<script>
import Swal from 'sweetalert2';
import {
   showToast
} from '../../swalUtils';

export default {
   props: {
      exchanges: {
         data: Array,
         default: null,
      }
   },
   methods: {
      confirm(exchange) {
         Swal.fire({
            title: `Are you sure delete this?`,
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
                  text: `Exchange has been deleted.`,
                  icon: 'success',
                  timer: 1500,
               });

               axios
                  .delete(`/api/v1/exchanges/${exchange.id}`)
                  .then(res => {
                     this.$emit('delete');
                  })
                  .catch(err => {
                     showToast('error', err.message);
                  })
            }
         })
      }
   },
}
</script>

<style lang="">
   
</style>
