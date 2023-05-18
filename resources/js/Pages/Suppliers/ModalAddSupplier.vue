<template>
<div class="modal fade" id="modal-add-supplier" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header ">
               <h4 class="modal-title">
                  <span v-if="editing">Edit Supplier</span>
                  <span v-else>Add New Supplier</span>
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <Form ref="formReset" @submit="handleSubmit" :validation-schema="schema" v-slot="{errors}" :initial-values="editing ? editing : form">
               <div class="modal-body">
                  <Field name="id" type="hidden" />
                  <div class="form-group">
                     <label for="name">Name</label>
                     <Field name="name"  type="text" class="form-control" :class="{'is-invalid': errors.name}" placeholder="Enter Name" autofocus /> 
                     <span class="invalid-feedback">{{ errors.name }}</span>
                  </div>
                  <div class="form-group">
                     <label for="gender">Gender</label>
                     <Field name="gender" as="select" class="form-control" :class="{'is-invalid': errors.gender}">
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                     </Field>
                     <span class="invalid-feedback">{{ errors.gender }}</span>

                  </div>
                  <div class="form-group">
                     <label for="phone">Phone</label>
                     <Field name="phone"  type="text" class="form-control" :class="{'is-invalid': errors.phone}" placeholder="Enter Phone number" /> 
                     <span class="invalid-feedback">{{ errors.phone }}</span>

                  </div>
                  <div class="form-group">
                     <label for="Address">Address</label>
                     <Field name="address" rows="3" class="form-control" :class="{'is-invalid': errors.address}"></Field>
                     <span class="invalid-feedback">{{ errors.address }}</span>
                  </div>
                  <div class="form-group">
                     <label for="Description">Description</label>
                     <Field name="description" as="textarea" rows="2" class="form-control" :class="{'is-invalid': errors.description}"></Field>
                     <span class="invalid-feedback">{{ errors.description }}</span>
                  </div>
                  <div class="form-group">
                     <label for="Status">Status</label>
                     <Field name="status" as="select" class="form-control" :class="{'is-invalid': errors.status}" >
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
import {Form, Field} from 'vee-validate';
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
            name: null,
            gender: 1,
            phone: null,
            address: null,
            description: null,
            status: 1,
         },
         toastr: useToastr(),
      }
   },
   methods: {
      handleSubmit(value, action){
         console.log('testing');
         let url = this.editing ? `/api/v1/suppliers/${value.id}` : '/api/v1/suppliers';
         let method = this.editing ? 'put' : 'post';
         axios
            .request({
               method: method,
               url: url,
               data: value
            })
            .then(res =>{
               console.log('actiov', action)
               action.resetForm();
               this.$emit('submit');
               this.toastr.success(`Supplier ${this.editing ? 'Update' : 'Add'} Successfully`);
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
            name: yup.string().required(),
            gender: yup.string().required('please select gender'),
            phone: yup.number().nullable(),
            address: yup.string().nullable(),
            description: yup.string().nullable(),
            status: yup.string().required('please select status'),
         })
      }
   }
}
</script>
