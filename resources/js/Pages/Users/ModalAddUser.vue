<template>
<div class="modal fade" id="modal-add-user" tabindex="-1">
   <Form @submit="submit" :validation-schema="schema" v-slot="{ errors, resetForm }" :initial-values="editing ? editing : form">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">
               <span v-if="editing">Edit User</span>
               <span v-else>Add New User</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" @click="resetForm">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
            <div class="modal-body">
               <Field name="id" type="hidden" />

               <div class="form-group">
                  <label>Name</label>
                  <Field name="name" type="text" class="form-control" :class="{'is-invalid': errors.name}" placeholder="Enter name" />
                  <span class="invalid-feedback">{{ errors.name }}</span>
               </div>
               <div class="form-group">
                  <label>Email</label>
                  <Field name="email" type="text" class="form-control" :class="{'is-invalid': errors.email}" placeholder="Enter email" />
                  <span class="invalid-feedback">{{ errors.email }}</span>
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <Field name="password" type="password" class="form-control" :class="{'is-invalid': errors.password}" placeholder="Enter password" />
                  <span class="invalid-feedback">{{ errors.password }}</span>
               </div>
               <div class="form-group">
                  <label>Type</label>
                  <Field name="type" as="select" class="form-control">
                     <option value="1">Admin</option>
                     <option value="0">User</option>
                  </Field>
               </div>
               <div class="form-group">
                  <label>Status</label>
                  <Field name="status" as="select" class="form-control">
                     <option value="1" selected>Active</option>
                     <option value="0">Inactive</option>
                  </Field>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal" @click="resetForm">Close</button>
               <input type="submit" class="btn btn-primary" :value="editing ? 'Update' : 'Save' " />
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
import useUsers from '../../Composables/users';
import useNotifications from '../../notifications';

const props = defineProps({
   editing:{
      type: Object,
      default: null,
   }
})
const { storeUser, updateUser } = useUsers();

const form = reactive({
   name: null,
   email: null,
   password: null,
   type: 1,
   status: 1,
})

const schema = yup.object({
   name: yup.string().required(),
   email: yup.string().email().required(),
   password: yup.string().required().min(4),
});

const emit = defineEmits(['submit']);
const submit = async (value, action) => {
   if(props.editing){
      editUser(value, action);
   }else{
      createUser(value, action)
   }

}

const createUser = (value, action)=>{
   storeUser(value)
   .then(res => {
      const {showToast} = useNotifications();
      showToast('success', 'user create successfully');
      action.resetForm();
      $('#modal-add-user').modal('hide');
      emit('submit')
   })
  .catch(errors => {
      action.setErrors(errors)
   });
}

const editUser = (value, action)=>{
   updateUser(value)
   .then(res => {
      const {showToast} = useNotifications();
      showToast('success', 'user update successfully');
      action.resetForm();
      $('#modal-add-user').modal('hide');
      emit('submit')
   })
  .catch(errors => {
      action.setErrors(errors)
   });
}

</script>

<style lang=""></style>
