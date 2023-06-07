<template>
<div class="modal fade" id="modal-add-supplier" tabindex="-1">
   <Form ref="form" @submit="submit" :validation-schema="schema" v-slot="{ errors, resetForm }" :initial-values="editing ? editing : form">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header ">
               <h4 class="modal-title">
                  <span v-if="editing">Edit Supplier</span>
                  <span v-else>Add New Supplier</span>
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="resetForm">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
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
                     <label for="Address">Facebook</label>
                     <Field name="facebook" as="textarea" rows="2" class="form-control" :class="{'is-invalid': errors.facebook}"></Field>
                     <span class="invalid-feedback">{{ errors.facebook }}</span>
                  </div>
                  <div class="form-group">
                     <label for="Address">Address</label>
                     <Field name="address" as="textarea" rows="2" class="form-control" :class="{'is-invalid': errors.address}"></Field>
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
                  <button type="button" class="btn btn-default" data-dismiss="modal" @click="resetForm">Close</button>
                  <input type="submit" class="btn" :class=" editing ? 'btn-success' : 'btn-primary' " :value="editing ? 'Update' : 'Save'" />
               </div>
            </div>
         </div>
      </Form>
   </div>
</template>
<script setup>
import * as yup from 'yup';
import { Form, Field } from 'vee-validate';
import {reactive, defineEmits, defineProps } from 'vue';
import useSupplier from '../../Composables/suppliers';
import useNotifications from '../../notifications';

const props = defineProps({
   editing:{
      type: Object,
      default: null,
   }
})
const { storeSupplier, updateSupplier } = useSupplier();

const form = reactive({
   name: null,
   gender: 1,
   phone: null,
   facebook: null,
   address: null,
   description: null,
   status: 1,
})

const schema = yup.object({
   name: yup.string().required(),
   gender: yup.string().required(),
   phone: yup.number().nullable(),
   facebook: yup.string().nullable(),
   address: yup.string().nullable(),
   description: yup.string().nullable(),
   description: yup.string().nullable(),
   status: yup.string().required(),
});

const emit = defineEmits(['submit']);
const submit = async (value, action) => {
   if(props.editing){
      editSupplier(value, action);
   }else{
      createSupplier(value, action)
   }

}

const createSupplier = (value, action)=>{
   storeSupplier(value)
   .then(res => {
      const {showToast} = useNotifications();
      showToast('success', 'supplier create successfully');
      action.resetForm();
      $('#modal-add-supplier').modal('hide');
      emit('submit')
   })
  .catch(errors => {
      action.setErrors(errors)
   });
}

const editSupplier = (value, action)=>{
   updateSupplier(value)
   .then(res => {
      const {showToast} = useNotifications();
      showToast('success', 'supplier update successfully');
      action.resetForm();
      $('#modal-add-supplier').modal('hide');
      emit('submit')
   })
  .catch(errors => {
      action.setErrors(errors)
   });
}
</script>
