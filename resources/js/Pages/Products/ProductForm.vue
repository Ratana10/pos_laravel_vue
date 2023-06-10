<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              <span v-if="product">Edit Product</span>
              <span v-else>Create Product</span>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <router-link to="/admin/dashboard" class="breadcrumb-item">
                <a>Home</a>
              </router-link>
              <router-link to="/admin/products" class="breadcrumb-item">
                <a>Products</a>
              </router-link>
              <li class="breadcrumb-item active">
                <span>Create</span>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <Form
                @submit="submit"
                enctype="multipart/form-data"
                :validation-schema="schema"
                v-slot="{ errors }"
                :initial-values="product ? product : form"
              >
                <div class="card-body">
                  <Field type="hidden" name="id" />
                  <!-- <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="" class="form-label">Code</label>
                        <Field
                          :class="{ 'is-invalid': errors.code }"
                          type="text"
                          name="code"
                          class="form-control"
                          disabled
                          v-model="product_code"
                        />
                        <span class="invalid-feedback">{{ errors.code }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Barcode</label>
                        <Field
                          :class="{ 'is-invalid': errors.barcode }"
                          type="text"
                          name="barcode"
                          class="form-control"
                          disabled
                        />
                        <span class="invalid-feedback">{{ errors.barcode }}</span>
                      </div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Product Name</label>
                        <Field
                          :class="{ 'is-invalid': errors.name }"
                          type="text"
                          name="name"
                          class="form-control"
                        />
                        <span class="invalid-feedback">{{ errors.name }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Category</label>
                        <div class="input-group-prepend">
                          <div class="input-group">
                            <Field
                              :class="{ 'is-invalid': errors.category_id }"
                              as="select"
                              name="category_id"
                              class="form-control custom-select">
                              <option disabled selected> select category ... </option>
                              <option
                                v-for="(category, index) in categories"
                                :key="index"
                                :value="category.id">
                                {{ category.name }}
                              </option>
                            </Field>
                            <button
                              class="btn btn-default"
                              @click.prevent="openModalCategory">
                              +
                            </button>
                            <span class="invalid-feedback">{{ errors.category_id}}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Price</label>
                        <Field
                          :class="{ 'is-invalid': errors.price }"
                          type="number"
                          step="0.01"
                          name="price"
                          class="form-control"
                        />
                        <span class="invalid-feedback">{{ errors.price }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Cost</label>
                        <Field
                          :class="{ 'is-invalid': errors.cost }"
                          type="number"
                          step="0.01"
                          name="cost"
                          class="form-control"
                        />
                        <span class="invalid-feedback">{{ errors.cost }}</span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Quantity</label>
                        <div class="input-group-prepend">
                          <div class="input-group">
                            <Field
                              :class="{ 'is-invalid': errors.quantity }"
                              name="quantity"
                              type="number"
                              step="0.01"
                              class="form-control rounded-0"
                            />
                            <span class="invalid-feedback">{{errors.quantity}}</span>
                          </div>
                          <div class="input-group">
                            <Field
                              :class="{ 'is-invalid': errors.unit_id }"
                              name="unit_id"
                              as="select"
                              class="form-control custom-select rounded-0"
                              style="width: 200px">
                              <option disabled selected>select unit ...</option>
                              <option
                                v-for="(unit, index) in units"
                                :key="index"
                                :value="unit.id">
                                {{ unit.name }}
                              </option>
                            </Field>
                            <span class="invalid-feedback">{{errors.unit_id}}</span>
                          </div>
                          <button
                            class="btn btn-default"
                            @click.prevent="openModalUnit">
                            +
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Discount</label>
                        <Field
                          :class="{ 'is-invalid': errors.discount }"
                          type="number"
                          step="0.01"
                          name="discount"
                          class="form-control"/>
                        <span class="invalid-feedback">{{errors.discount}}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Alert</label>
                        <Field
                          :class="{ 'is-invalid': errors.alert }"
                          type="number"
                          name="alert"
                          class="form-control"/>
                        <span class="invalid-feedback">{{ errors.alert }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card" >
                        <div class="card-header">
                          <label for="image">Image</label>
                          <div class="card-tools">
                            <button
                              type="button"
                              class="btn btn-tool text-primary"
                              @click="$refs.imageBrowse.$el.click()">
                              <i class="fa fa-paperclip"></i>
                              Browse
                            </button>
                          </div>
                        </div>
                        <div class="card-body text-center">
                          <Field
                           name="image"
                            type="file"
                            id="image"
                            ref="imageBrowse"
                            class="d-none"
                            @change="onImageChange" />
                          <img
                            class="img-fluid"
                            style="height: 200px"
                            :src="editing_image && product ? '/uploads/products/' + product.image: form.image"
                            alt="photo"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Status</label>
                        <Field
                          :class="{ 'is-invalid': errors.status }"
                          as="select"
                          name="status"
                          class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </Field>
                        <span class="invalid-feedback">{{errors.status}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="mt-4">
                    <input
                      type="submit"
                      :value="product ? 'Update' : 'Save'"
                      class="btn"
                      :class="product ? 'btn-success' : 'btn-primary'"/>
                  </div>
                </div>
              </Form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <ModalAddCategory @submit="getCategories" />
    <ModalAddUnit @submit="getUnits" />
  </div>
</template>

<script setup>
import { Form, Field } from "vee-validate";
import * as yup from 'yup';
import useNotifications from "../../notifications";
import ModalAddCategory from "../Categories/ModalAddCategory.vue";
import ModalAddUnit from "../Units/ModalAddUnit.vue";
import { onMounted, reactive, ref } from "vue";
import useProducts from "../../Composables/products";
import useCategories from "../../Composables/categories";
import useUnits from "../../Composables/units";
import { useRouter, useRoute } from "vue-router";

const router = useRouter();
const route = useRoute();

const { product_code, product, getProductCode, storeProduct, editProduct } = useProducts();

const { categories, getCategories } = useCategories();

const { units, getUnits } = useUnits();

onMounted(() => {
   if (route.name == 'admin.products.edit') {
        editProduct(route.params.id);
         editing_image.value = true;

      } else {
         getProductCode();
      }

   getCategories(10,1,1);
   getUnits(10,1, 1);
   
});

const form = reactive({
  id: null,
  name: null,
  category_id: null,
  unit_id: null,
  price: 0,
  cost: 0,
  discount: 0,
  quantity: 0,
  alert: 1,
  image: null,
  status: 1,
});

const schema = yup.object({
   name: yup.string().required(),
   category_id: yup.number().required('please select category'),
   unit_id: yup.number().required('please select unit'),
   price: yup.number().required(),
   cost: yup.number().nullable(),
   discount: yup.number().nullable(),
   quantity: yup.number().nullable(),
   alert: yup.number().required(),
   image: yup.string().nullable(),
   status: yup.number().required('please select status'),
});

const submit = (value, action) =>{
   createProduct(value,action);
}

const createProduct = (value, action)=>{
   storeProduct(value)
   .then((res) => {
      const { showToast } = useNotifications();
      action.resetForm();
      router.push({name: 'admin.products.index'});
      showToast("success", "product create successfully");
    })
    .catch((errors) => {
      action.setErrors(errors);
    });
}

const openModalCategory = ()=>{
   $('#modal-add-category').modal('show');
}

const openModalUnit = ()=>{
   $('#modal-add-unit').modal('show');
}

const editing_image = ref(false);

const onImageChange = (event)=> {
   editing_image.value = false;
   let file = event.target.files;
   let reader = new FileReader();
   reader.onloadend = (file) => {
      form.image = file.target.result;
   }
   reader.readAsDataURL(file[0]);
}
const handleBrowse =()=> {
   $('#image').trigger('click');
}



</script>

<!-- <script>
import {
   useRouter,
   useRoute
} from 'vue-router';
import {
   Form,
   Field
} from 'vee-validate'
import * as yup from 'yup';

import ModalAddCategory from '../Categories/ModalAddCategory.vue';
import ModalAddUnit from '../Units/ModalAddUnit.vue';
import { showToast } from '../../swalUtils';

export default {
   components: {
      ModalAddCategory,
      ModalAddUnit,
      Form,
      Field
   },
   mounted() {
      if (this.route.name == 'admin.products.edit') {
         this.getProduct(this.route.params.id);
      } else {
         this.getProductCode();
      }
      this.getUnits();
      this.getCategories();
   },
   computed: {
      schema() {
         return yup.object({
            name: yup.string().required(),
            category_id: yup.number().required('please select category'),
            unit_id: yup.number().required('please select unit'),
            price: yup.number().required(),
            discount: yup.number().required(),
            quantity: yup.number().required(),
            alert: yup.number().required(),
            status: yup.number().required('please select status'),
         })
      }
   },
   data() {
      return {
         form: {
            id: null,
            code: null,
            name: null,
            category_id: null,
            unit_id: null,
            price: 0,
            discount: 0,
            quantity: 0,
            alert: 1,
            image: null,
            barcode: null,
            status: 1,
         },
         categories: [],
         units: [],
         editing_image: false,
         router: useRouter(),
         route: useRoute(),
      }
   },
   methods: {
      handleShowUnitModal() {
         $('#modal-add-unit').modal('show');
      },
      handleShowCategoryModal() {
         $('#modal-add-category').modal('show');
      },
      handleSubmit(value, action) {
         value.image = this.form.image;
         let url = this.form.id ? `/api/v1/products/${this.form.id}` : '/api/v1/products';
         let method = this.form.id ? 'put' : 'post';
         axios
            .request({
               url: url,
               method: method,
               data: value
            })
            .then(res => {
               action.resetForm();
               this.router.push("/admin/products");
            })
            .catch(err => {
               if(err.respone.data.errors){
                  action.setErrors(err.respone.data.errors);
               }
               showToast('error', err);
            })

      },
      onImageChange(event) {
         this.editing_image = false;
         let file = event.target.files;
         let reader = new FileReader();
         reader.onloadend = (file) => {
            this.form.image = file.target.result;
         }
         reader.readAsDataURL(file[0]);
      },
      handleBrowse() {
         $('#image').trigger('click');
      },
      getUnits() {
         axios
            .get('/api/v1/units?status=1')
            .then(res => {
               this.units = res.data.data;
            })
            .catch(err => {
               showToast('error', err.message);
            })
      },
      getCategories() {
         axios
            .get(`/api/v1/categories?status=1`)
            .then(res => {
               if(res.data.status == true){
                  this.categories = res.data.data;
               }
            })
            .catch(err => {
               showToast('error', err.message);
            })
      },
      getProductCode() {
         axios
            .get('/api/v1/products-code')
            .then(res => {
               if(res.data.status == true){
                  this.form.code = res.data.data;
               }
            })
            .catch(err => {
               showToast('error', err);

            })
      },
      getProduct(product_id) {
         axios
            .get(`/api/v1/products/${product_id}/edit`)
            .then(res => {  
               if(res.data.status == true){             
                  this.editing_image = true;
                  this.form = res.data.data;
               }
            })
            .catch(err => {
               showToast('error', err);
            })
      }
   },
   
}
</script> -->

<style scoped>
.form-control {
  border-radius: 0 !important;
}

.min--heigh {
  min-height: 10px;
}
</style>
