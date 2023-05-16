<template>
<div class="modal fade" id="modal-add-exchange" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header ">
               <h4 class="modal-title">
                  <span v-if="editing">Edit Exchange</span>
                  <span v-else>Add New Exchange</span>
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form @submit.prevent="handleSubmit">
               <div class="modal-body">
                  <div class="form-group">
                     <label for="dollar">Dollar</label>
                     <input v-model="form.dollar" type="text" class="form-control" placeholder="Enter Dollar" autofocus>
                  </div>
                  <div class="form-group">
                     <label for="khmer">Khmer</label>
                     <input v-model="form.khmer" type="text" class="form-control" placeholder="Enter Khmer">
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
            dollar: null,
            khmer: null,
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
            .put(`/api/v1/exchanges/${this.form.id}`, this.form)
            .then(res =>{
               this.$emit('submit');
               this.toastr.success('Exchange Updated Successfully')

            })
            .catch(err =>{
               console.log('error:', err);
            })
      },
      handleAdd(){
         axios
            .post('/api/v1/exchanges', this.form)
            .then(res =>{
               this.$emit('submit');
               this.toastr.success('Exchange Added Successfully')
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
