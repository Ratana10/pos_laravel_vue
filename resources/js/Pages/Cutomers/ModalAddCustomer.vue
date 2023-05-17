<template>
<div class="modal fade" id="modal-add-customer" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header ">
               <h4 class="modal-title">
                  <span v-if="editing">Edit Customer</span>
                  <span v-else>Add New Customer</span>
               </h4>
               <button type="button" class="close" data-dismiss="modal" >
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <Form ref="form" @submit="handleSubmit" :validation-schema="schema" v-slot="{ errors }" :initial-values="editing">
               <div class="modal-body">
                  <div class="form-group">
                     <label for="name">Name</label>
                     <Field name="name"  type="text" class="form-control" :class="{'is-invalid': errors.name}" placeholder="Enter Name" autofocus />
                     <span class="invalid-feedback">{{ errors.name }}</span>
                  </div>
                  <div class="form-group">
                     <label for="gender">Gender</label>
                     <Field name="gender" as="select"  class="form-control"  :class="{'is-invalid': errors.gender}" id="">
                        <option value="">Select gender</option>
                        <option value="1" selected>Male</option>
                        <option value="0">Female</option>
                     </Field>
                     <span class="invalid-feedback">{{ errors.gender }}</span>
                  </div>
                  <div class="form-group">
                     <label for="phone">Phone</label>
                     <Field name="phone" type="text" class="form-control"  :class="{'is-invalid': errors.phone}" placeholder="Enter Phone --number" />
                     <span class="invalid-feedback">{{ errors.phone }}</span>
                  </div>
                  <div class="form-group">
                     <label for="Address">Address</label>
                     <Field name="address" rows="3" class="form-control"  :class="{'is-invalid': errors.address}"></Field>
                     <span class="invalid-feedback">{{ errors.address }}</span>
                  </div>
                  <div class="form-group">
                     <label for="Description">Description</label>
                     <Field name="description"  rows="2" class="form-control"  :class="{'is-invalid': errors.description}"></Field>
                     <span class="invalid-feedback">{{ errors.description }}</span>
                  </div>
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn" :class=" editing ? 'btn-success' : 'btn-primary' " :value="editing ? 'Update' : 'Save'"  />
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
         toastr: useToastr(),
         
      }
   },
   methods: {
      handleSubmit(value){
         let url, method;

         if(this.editing){
            method = 'put';
            url = `/api/v1/customers/${this.editing.id}`
         }
         else{
            method = 'post';
            url ='/api/v1/customers';
         }
         axios
            .request({
               method: method,
               url: url,
               data: value
            })
            .then(res =>{
               this.$refs.form.resetForm();
               this.$emit('submit');
               this.toastr.success('Customer Updated Successfully')
            })
            .catch(err =>{
               console.log('error:', err);
            })
      },
      // handleSubmit(){
      //    if(this.editing){
      //       this.handleUpdate();
      //    }else{

      //       this.handleAdd();
      //    }
      // },
      handleUpdate(){
         axios
            .put(`/api/v1/customers/${this.form.id}`, this.form)
            .then(res =>{

            })
            .catch(err =>{
               console.log('error:', err);
            })
      },
      handleAdd(){
         axios
            .post('/api/v1/customers', this.form)
            .then(res =>{
               this.$emit('submit');
               this.toastr.success('Customer Added Successfully')
            })
            .catch(err =>{
               console.log('error:', err);
            })
      }
   },
   // watch:{
   //    editing: function(value){
   //       if(value){
   //          this.form = value;
   //       }
   //    }
   // },
   computed:{
      schema(){
         return yup.object({
            name: yup.string().required(),
            gender: yup.string().required('please select gender'),
            phone: yup.number().nullable(),

         })
      }
   }
}
</script>
