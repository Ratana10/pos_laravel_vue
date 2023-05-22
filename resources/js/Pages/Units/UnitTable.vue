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
            <button class="btn btn-danger btn-sm ml-1" @click="confirm(unit)"><i class="fa fa-trash"></i></button>
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

<script>
import Swal from 'sweetalert2';

export default {
   props: {
      units: {
         data: Array,
         default: null,
      }
   },
   methods: {
      confirm(unit) {
         Swal.fire({
            title: `Are you sure delete \n'${unit.name}' ?`,
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
            if (result.isConfirmed) {
               this.handleDelete(unit.id);
               Swal.fire({
                  title: 'Deleted!',
                  text: `${category.name} has been deleted.`,
                  icon: 'success',
                  timer: 1500,
               });
            }
         })
      },
      handleDelete(unit_id) {
         axios
            .delete(`/api/v1/units/${unit_id}`)
            .then(res => {
               if (res.data.status) { // success response
                  this.$emit('delete');
               } else { // fail response
                  Swal.fire({
                     icon: 'error',
                     title: 'Oops Unable to delete ...',
                     text: `Something went wrong: ${res.data.message}!`,
                  })
               }
            })
            .catch(err => {
               showToast('error', err.message);
            })
      }
   },
}
</script>

<style lang="">
   
</style>
