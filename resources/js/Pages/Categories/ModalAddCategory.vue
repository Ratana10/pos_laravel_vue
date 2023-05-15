<template>
<div class="modal fade" id="modal-add-category" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header ">
               <h4 class="modal-title">
                  <span v-if="editing">Edit Category</span>
                  <span v-else>Add New Category</span>
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form @submit.prevent="handleSubmit">
               <div class="modal-body">
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input v-model="form.name" type="text" class="form-control" placeholder="Enter Name" autofocus>
                  </div>
                  <div class="form-group">
                     <label for="Status">Status</label>
                     <select v-model="form.status" name="" class="form-control" id="">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                     </select>
                  </div>
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn" :class=" editing ? 'btn-success' : 'btn-primary' " :value="editing ? 'Update' : 'Save'" />
               </div>
            </form>
         </div>
      </div>
   </div>
</template>
<script>
import { useToastr } from '../../toastr';
export default {
   props:{
      editing: {
         data: Object,
         default: null,
      }
   },
   data() {
      return {
         form:{
            id: null,
            name: null,
            status: 1,
         },
         toastr: useToastr(),
      }
   },
   methods: {
      handleSubmit(){
         if(this.editing){
            this.handleUpdate();
         }else{

            this.handleAdd();
         }
      },
      handleUpdate(){
         axios
            .put(`/api/v1/categories/${this.form.id}`, this.form)
            .then(res =>{
               this.$emit('submit');
               this.toastr.success('Category Updated Successfully')

            })
            .catch(err =>{
               console.log('error:', err);
            })
      },
      handleAdd(){
         axios
            .post('/api/v1/categories', this.form)
            .then(res =>{
               this.$emit('submit');
               this.toastr.success('Category Added Successfully')
            })
            .catch(err =>{
               console.log('error:', err);
            })
      }
   },
   watch:{
      editing: function(value){
         if(value){
            this.form = value;
         }
      }
   }
}
</script>
