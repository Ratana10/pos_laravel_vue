<template>
  <div class="modal fade" id="modal-add-exchange" tabindex="-1">
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
              <span v-if="editing">Edit Exchange</span>
              <span v-else>Add New Exchange</span>
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
              <label for="dollar">Dollar</label>
              <Field
                name="dollar"
                type="number"
                class="form-control"
                :class="{ 'is-invalid': errors.dollar }"
                placeholder="Enter Dollar"
                autofocus
              />
              <span class="invalid-feedback">{{ errors.dollar }}</span>
            </div>
            <div class="form-group">
              <label for="khmer">Khmer</label>
              <Field
                name="khmer"
                type="number"
                class="form-control"
                :class="{ 'is-invalid': errors.khmer }"
                placeholder="Enter Khmer"
              />
              <span class="invalid-feedback">{{ errors.khmer }}</span>
            </div>
            <div class="form-group">
              <label for="Status">Status</label>
              <Field
                name="status"
                as="select"
                class="form-control"
                :class="{ 'is-invalid': errors.status }"
              >
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </Field>
              <span class="invalid-feedback">{{ errors.status }}</span>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button
              type="button"
              class="btn btn-default"
              data-dismiss="modal"
              @click="resetForm"
            >
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
import useExchanges from "../../Composables/exchanges";
import useNotifications from "../../notifications";

const props = defineProps({
  editing: {
    type: Object,
    default: null,
  },
});

const form = reactive({
  dollar: 1,
  khmer: 4000,
  status: 1,
});

const schema = yup.object({
  dollar: yup.number().required(),
  khmer: yup.number().required(),
  status: yup.string().required(),
});

const emit = defineEmits(["submit"]);
const submit = async (value, action) => {
  if (props.editing) {
    editExchange(value, action);
  } else {
    createExchange(value, action);
  }
};

const { storeExchange, updateExchange } = useExchanges();

const createExchange = (value, action) => {
  storeExchange(value)
    .then((res) => {
      const { showToast } = useNotifications();
      showToast("success", "exchange create successfully");
      action.resetForm();
      $("#modal-add-exchange").modal("hide");
      emit("submit");
    })
    .catch((errors) => {
      action.setErrors(errors);
    });
};

const editExchange = (value, action) => {
  console.log("test");
  updateExchange(value)
    .then((res) => {
      const { showToast } = useNotifications();
      showToast("success", "exchange update successfully");
      action.resetForm();
      $("#modal-add-exchange").modal("hide");
      emit("submit");
    })
    .catch((errors) => {
      action.setErrors(errors);
    });
};
</script>
