<template>
<div class="modal fade" id="modal-add-customer" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header ">
               <h4 class="modal-title">ADD NEW CUSTOMER</h4>
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
                     <label for="gender">Gender</label>
                     <select v-model="form.gender" name="" class="form-control" id="">
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="phone">Phone</label>
                     <input v-model="form.phone" type="text" class="form-control" placeholder="Enter Phonenumber">
                  </div>
                  <div class="form-group">
                     <label for="Address">Address</label>
                     <textarea v-model="form.address" name="" id="" rows="3" class="form-control"></textarea>
                  </div>
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</template>
<script>
export default {
   data() {
      return {
         form:{
            name: null,
            gender: 1,
            phone: null,
            address: null,
         }
      }
   },
   methods: {
      handleSubmit(){
         this.handleAdd();
      },
      handleAdd(){
         console.log('test', this.form);
      }
   },
}
</script>
