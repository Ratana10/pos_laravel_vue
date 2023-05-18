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
            <Form ref="formReset" @submit="handleSubmit" :validation-schema="schema" v-slot="{ errors }" :initial-values="editing ? editing : form">
               <Field name="id" type="hidden" />
               <div class="modal-body">
                  <div class="form-group">
                     <label for="dollar">Dollar</label>
                     <Field name="dollar" type="text" class="form-control" :class="{'is-invalid': errors.dollar}" placeholder="Enter Dollar" autofocus />
                     <span class="invalid-feedback">{{ errors.dollar }}</span>
                  </div> 
                  <div class="form-group">
                     <label for="khmer">Khmer</label>
                     <Field name="khmer" type="text" class="form-control" :class="{'is-invalid': errors.khmer}" placeholder="Enter Khmer" />
                     <span class="invalid-feedback">{{ errors.khmer }}</span>
                  </div> 
                  <div class="form-group">
                     <label for="Status">Status</label>
                     <Field name="status" as="select"  class="form-control" :class="{'is-invalid': errors.status}" >
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
import { useToastr } from '../../toastr';
import {Form, Field} from 'vee-validate'
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
   data() {
      return {
         form:{
            id: null,
            dollar: 1,
            khmer: null,
            status: 1,
         },
         toastr: useToastr(),
      }
   },
   methods: {
      handleSubmit(value, action){
         let url = this.editing ? `/api/v1/exchanges/${value.id}` : '/api/v1/exchanges';
         let method = this.editing ? 'put' : 'post';

         axios
            .request({
               method: method,
               url: url,
               data: value
            })
            .then(res =>{
               this.$emit('submit');
               action.resetForm();
               this.toastr.success(`Exchange ${this.editing ? 'Update' : 'Add'} Successfully`);
            })
            .catch(err =>{
               if(err.response.data.errors){
                  action.setErrors(err.response.data.errors);
               }
               console.log('error:', err);
            })
      },
   },
   computed:{
      schema(){
         return yup.object({
            dollar: yup.number().required(),
            khmer: yup.number().required(),
            status: yup.string().required('please select status'),

         })
      }
   }
}
</script>
