<template>
<div class="modal fade" id="modal-add-unit" tabindex="-1">
   <Form ref="form" @submit="submit" :validation-schema="schema" v-slot="{errors, resetForm}" :initial-values="editing!=null ? editing : form">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header ">
            <h4 class="modal-title">
               <span v-if="editing">Edit Unit</span>
               <span v-else>Add New Unit</span>
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
import * as yup from "yup";
import { Form, Field } from "vee-validate";
import { reactive, defineEmits, defineProps } from "vue";
import useUnits from "../../Composables/units";
import useNotifications from "../../notifications";

const props = defineProps({
  editing: {
    type: Object,
    default: null,
  },
});

const form = reactive({
  name: null,
  status: 1,
});

const schema = yup.object({
  name: yup.string().required(),
  status: yup.string().required(),
});

const emit = defineEmits(["submit"]);
const submit = async (value, action) => {
  if (props.editing) {
    editUnit(value, action);
  } else {
    createUnit(value, action);
  }
};

const { storeUnit, updateUnit } = useUnits();


const createUnit = (value, action) => {
   storeUnit(value)
    .then(() => {
      const { showToast } = useNotifications();
      showToast("success", "unit create successfully");
      action.resetForm();
      $("#modal-add-unit").modal("hide");
      emit("submit");
    })
    .catch((errors) => {
      action.setErrors(errors);
    });
};

const editUnit = (value, action) => {
  console.log("test");
  updateUnit(value)
    .then(() => {
      const { showToast } = useNotifications();
      showToast("success", "unit update successfully");
      action.resetForm();
      $("#modal-add-unit").modal("hide");
      emit("submit");
    })
    .catch((errors) => {
      action.setErrors(errors);
    });
};
</script>
<!-- <script>

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
                  ? `/api/v1/units/${value.id}` 
                  : '/api/v1/units';
         let method = this.editing ? 'put' : 'post';

         axios
            .request({
               url: url,
               method: method,
               data: value
            })
            .then(res =>{
               action.resetForm();
                  $('#modal-add-unit').modal('hide');
                  showToast('success', `${this.editing ? 'Unit updated successfully' : 'Unit created successfully' }`); 
                  this.$emit('submit'); 
            })
            .catch(err =>{
               if(err.response.data.errors){
                  action.sertErrors(err.response.data.errors);
               }
            })
      },
   },
}
</script> -->
