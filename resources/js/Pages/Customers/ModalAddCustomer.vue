<template>
   <div class="modal fade" id="modal-add-customer" tabindex="-1">
      <Form ref="form" @submit="submit" :validation-schema="schema" v-slot="{ errors,resetForm }"  :initial-values="editing ? editing : form">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header ">
               <h4 class="modal-title">
                  <span v-if="editing">Edit Customer</span>
                  <span v-else>Add New Customer</span>
               </h4>
               <button type="button" class="close" data-dismiss="modal" @click="resetForm">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
               <div class="modal-body">
                  <Field name="id" type="hidden" />
                  <div class="form-group">
                     <label for="name">Name</label>
                     <Field name="name" type="text" class="form-control" :class="{ 'is-invalid': errors.name }"
                        placeholder="Enter Name" autofocus />
                     <span class="invalid-feedback">{{ errors.name }}</span>
                  </div>
                  <div class="form-group">
                     <label for="gender">Gender</label>
                     <Field name="gender" as="select" class="form-control" :class="{ 'is-invalid': errors.gender }" id="">
                        <option disabled>Select gender</option>
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                     </Field>
                     <span class="invalid-feedback">{{ errors.gender }}</span>
                  </div>
                  <div class="form-group">
                     <label for="phone">Phone</label>
                     <Field name="phone" type="text" class="form-control" :class="{ 'is-invalid': errors.phone }"
                        placeholder="Enter Phone Number" />
                     <span class="invalid-feedback">{{ errors.phone }}</span>
                  </div>
                  <div class="form-group">
                     <label for="Address">Address</label>
                     <Field name="address" as="textarea" rows="3" class="form-control"
                        :class="{ 'is-invalid': errors.address }"></Field>
                     <span class="invalid-feedback">{{ errors.address }}</span>
                  </div>
                  <div class="form-group">
                     <label for="Description">Description</label>
                     <Field name="description" as="textarea" rows="2" class="form-control"
                        :class="{ 'is-invalid': errors.description }"></Field>
                     <span class="invalid-feedback">{{ errors.description }}</span>
                  </div>
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal" @click="resetForm">Close</button>
                  <input type="submit" class="btn" :class="editing ? 'btn-success' : 'btn-primary'"
                     :value="editing ? 'Update' : 'Save'" />
               </div>
            </div>
         </div>
      </Form>
   </div>
</template>

<script setup>
import * as yup from 'yup';
import { Form, Field } from 'vee-validate';
import { reactive, defineEmits, defineProps } from 'vue';
import useCustomers from '../../Composables/customers';
import useNotifications from '../../notifications';

const props = defineProps({
   editing: {
      type: Object,
      default: null,
   }
})
const { storeCustomer, updateCustomer } = useCustomers();

const form = reactive({
   name: null,
   gender: 1,
   phone: null,
   address: null,
   description: null,
})

const schema = yup.object({
   name: yup.string().required(),
   gender: yup.string().required(),
   phone: yup.number().nullable(),   
});

const emit = defineEmits(['submit']);
const submit = async (value, action) => {
   if (props.editing) {
      editCustomer(value, action);
   } else {
      createCustomer(value, action)
   }

}

const createCustomer = (value, action) => {
   storeCustomer(value)
      .then(res => {
         const { showToast } = useNotifications();
         showToast('success', 'customer create successfully');
         action.resetForm();
         $('#modal-add-customer').modal('hide');
         emit('submit')
      })
      .catch(errors => {
         action.setErrors(errors)
      });
}

const editCustomer = (value, action) => {
   updateCustomer(value)
      .then(res => {
         const { showToast } = useNotifications();
         showToast('success', 'customer update successfully');
         action.resetForm();
         $('#modal-add-customer').modal('hide');
         emit('submit')
      })
      .catch(errors => {
         action.setErrors(errors)
      });
}





</script>
