<template>
  <div class="modal fade" id="modal-add-category" tabindex="-1">
   <Form
          @submit="submit"
          :validation-schema="schema"
          v-slot="{ errors, resetForm }"
          :initial-values="editing ? editing : form"
        >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            <span v-if="editing">Edit Category</span>
            <span v-else>Add New Category</span>
          </h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="resetForm"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
          <Field name="id" type="hidden" />
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Name</label>
              <Field
                name="name"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                placeholder="Enter Name"
                autofocus
              />
              <span class="invalid-feedback">{{ errors.name }}</span>
            </div>
            <div class="form-group">
              <label for="Status">Status</label>
              <Field
                name="status"
                as="select"
                class="form-control"
                :class="{ 'is-invalid': errors.status }"
                :value="1"
              >
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </Field>
              <span class="invalid-feedback">{{ errors.status }}</span>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal" @click="resetForm">
              Close
            </button>
            <input
              type="submit"
              class="btn"
              :class="editing ? 'btn-success' : 'btn-primary'"
              :value="editing ? 'Update' : 'Save'"
            />
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
import useCategories from "../../Composables/categories";
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
    editCategory(value, action);
  } else {
    createCategory(value, action);
  }
};

const { storeCategory, updateCategory } = useCategories();

const createCategory = (value, action) => {
   storeCategory(value)
    .then((res) => {
      const { showToast } = useNotifications();
      showToast("success", "category create successfully");
      action.resetForm();
      $("#modal-add-category").modal("hide");
      emit("submit");
    })
    .catch((errors) => {
      action.setErrors(errors);
    });
};

const editCategory = (value, action) => {
  console.log("test");
  updateCategory(value)
    .then((res) => {
      const { showToast } = useNotifications();
      showToast("success", "category update successfully");
      action.resetForm();
      $("#modal-add-category").modal("hide");
      emit("submit");
    })
    .catch((errors) => {
      action.setErrors(errors);
    });
};
</script>
