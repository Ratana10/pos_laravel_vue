<template>
<div class="modal fade" id="modal-add-customer" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header ">
            <h4 class="modal-title">
               <span v-if="editing">Edit Customer</span>
               <span v-else>Add New Customer</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <Form ref="form" @submit="handleSubmit" :validation-schema="schema" v-slot="{ errors }" :initial-values="editing ? editing : form">
            <div class="modal-body">
               <Field name="id" type="hidden" />
               <div class="form-group">
                  <label for="name">Name</label>
                  <Field name="name" type="text" class="form-control" :class="{'is-invalid': errors.name}" placeholder="Enter Name" autofocus />
                  <span class="invalid-feedback">{{ errors.name }}</span>
               </div>
               <div class="form-group">
                  <label for="gender">Gender</label>
                  <Field name="gender" as="select" class="form-control" :class="{'is-invalid': errors.gender}" id="">
                     <option disabled>Select gender</option>
                     <option value="1">Male</option>
                     <option value="0">Female</option>
                  </Field>
                  <span class="invalid-feedback">{{ errors.gender }}</span>
               </div>
               <div class="form-group">
                  <label for="phone">Phone</label>
                  <Field name="phone" type="text" class="form-control" :class="{'is-invalid': errors.phone}" placeholder="Enter Phone Number" />
                  <span class="invalid-feedback">{{ errors.phone }}</span>
               </div>
               <div class="form-group">
                  <label for="Address">Address</label>
                  <Field name="address" as="textarea" rows="3" class="form-control" :class="{'is-invalid': errors.address}"></Field>
                  <span class="invalid-feedback">{{ errors.address }}</span>
               </div>
               <div class="form-group">
                  <label for="Description">Description</label>
                  <Field name="description" as="textarea" rows="2" class="form-control" :class="{'is-invalid': errors.description}"></Field>
                  <span class="invalid-feedback">{{ errors.description }}</span>
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
import {
   Form,
   Field
} from 'vee-validate'
import * as yup from 'yup';

export default {
   components: {
      Form,
      Field
   },
   props: {
      editing: {
         data: Object,
         default: null,
      }
   },
   computed: {
      schema() {
         return yup.object({
            name: yup.string().required(),
            gender: yup.string().required('please select gender'),
            phone: yup.number().nullable(),
            address: yup.string().nullable(),
            description: yup.string().nullable(),
         })
      }
   },
   data() {
      return {
         form: {
            gender: 1,
         }
      }
   },
   methods: {
      handleSubmit(value, action) {
         let url = this.editing ?
                     `/api/v1/customers/${value.id}`
                     : '/api/v1/customers';
         let method = this.editing ? 'put' : 'post';

         axios
            .request({
               method: method,
               url: url,
               data: value
            })
            .then(res => {
               action.resetForm();
               this.$emit('submit', 'success', `${this.editing ? 'Customer update successfully' : 'Customer create successfully' }`);
            })
            .catch(err => {
               if (err.response.data.errors) {
                  action.setErrors(err.response.data.errors);
               }
            })
      },

   }

}
</script>
