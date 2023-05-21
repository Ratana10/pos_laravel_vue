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
            <Form ref="form" @submit="handleSubmit" :validation-schema="schema" v-slot="{ errors }" :initial-values="editing ? editing : form">
               <Field name="id" type="hidden" />
               <div class="modal-body">
                  <div class="form-group">
                     <label for="name">Name</label>
                     <Field name="name" type="text" class="form-control" :class="{'is-invalid': errors.name}" placeholder="Enter Name" autofocus />
                     <span class="invalid-feedback">{{ errors.name }}</span>
                  </div>
                  <div class="form-group">
                     <label for="Status">Status</label>
                     <Field name="status" as="select" class="form-control" :class="{'is-invalid': errors.status}" :value="1">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                     </Field>
                     <span class="invalid-feedback">{{ errors.status }}</span>
                  </div>
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn" :class=" editing ? 'btn-success' : 'btn-primary' " :value="editing ? 'Update' : 'Save'" />
               </div>
            </Form>
         </div>
      </div>
   </div>
</template>
<script>
import {Form, Field} from 'vee-validate'
import { showToast } from '../../swalUtils';
import * as yup from 'yup';

export default {
   components:{
      Form, Field
   },
   props:{
      editing: {
         data: Object,
         default: null,
      }
   },
   computed:{
      schema(){
         return yup.object({
            name: yup.string().required(),
            status: yup.string().required('please select status'),
         })
      }
   },
   data() {
      return {
         form:{
            name: null,
            status: 1,
         },
      }
   },
   methods: {
      handleSubmit(value, action){
         let url = this.editing 
                  ? `/api/v1/categories/${value.id}` 
                  : '/api/v1/categories';

         let method = this.editing ? 'put' : 'post';

         axios
            .request({
               url: url,
               method: method,
               data: value
            })
            .then(res =>{
                  action.resetForm();
                  $('#modal-add-category').modal('hide');
                  showToast(
                     'success', 
                     `${this.editing 
                     ? 'Category updated successfully' 
                     : 'Category created successfully' }`
                  ); 
                  this.$emit('submit'); 
   
            })
            .catch(err =>{
               if(err.response.data.errors){
                  action.sertErrors(err.response.data.errors);
               }
               showToast('error', err.message);  
            })

      },
   },
   
}
</script>
