<template>
<div>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Create Purchases</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Purchases</li>
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
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Purchase Code</label>
                              <input disabled type="text" v-model="form.purchase_code" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label> Date</label>
                           <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input v-model="form.date" disabled type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                 <div class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Supplier:</label>
                              <select  class="form-control" v-model="form.supplier">
                                 <option disabled selected>Select supplier ...</option>
                                 <option v-for="(supplier, index) in suppliers" :key="index" :value="supplier">{{ supplier.name }}</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="">Search Product</label>
                              <select class="form-control" v-model="form.product">
                                 <option disabled selected>Select product ...</option>
                                 <option v-for="(product, index) in products" :key="index" :value="product">
                                    {{ product.name }}
                                 </option>
                              </select>
                                 
                           </div>
                           <button class="btn btn-primary" @click="addToCart">Add</button>
                        </div>
                     </div>
                     <div class="row mt-5">
                        <table class="table table-bordered ">
                           <thead class="bg-secondary">
                              <tr>
                                 <th>#</th>
                                 <th>Supplier</th>
                                 <th>Image</th>
                                 <th>Product Name</th>
                                 <th>Cost</th>
                                 <th>Qty</th>
                                 <th>Unit</th>
                                 <th>Dis</th>
                                 <th>Amount</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr v-for="(item, index) in cart" :key="index">
                                 <td>{{ index+1 }}</td>
                                 <td>{{ item.supplier_name }}</td>
                                 <td style="width: 150px;">
                                    <img style="width: 100px; height: 100px;" :src="'/uploads/products/' + item.product_image" alt="photo" >
                                 </td>
                                 <td>{{ item.product_name }}</td>
                                 <td style="width: 150px">
                                    <input v-model="item.cost" type="text"  class="form-control">
                                 </td>
                                 <td style="width: 150px">
                                    <input v-model="item.quantity" type="text"  class="form-control">
                                 </td>
                                 <td style="width: 200px">
                                    <select class="form-control" v-model="item.unit_id">
                                       <option v-for="(unit, index) in units" :key="index" :value="unit.id">
                                          {{ unit.name }}
                                       </option>
                                    </select>
                                 </td>
                                 <td style="width: 150px">
                                    <input v-model="item.discount" type="text"  class="form-control">
                                 </td>
                                 <td>
                                    {{ item.amount }}
                                 </td>
                                 <td>
                                    <button class="btn btn-danger btn-sm ml-1"><i class="fa fa-trash"></i></button>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-right">
                           <div class="form-group">
                              <h4>Sub-Total: $ {{ form.total }}</h4>
                           </div>
                           <div class="form-group">
                              <h4>Discount: 0 %</h4>
                           </div>
                           <div class="form-group">
                              <h4>Total: $ {{ form.total }}</h4>
                           </div>
                           <button type="button" class="btn btn-primary" @click="save">Pay</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</template>

<script setup>
import {
   ref,
   reactive,
   onMounted,
   watch,
} from 'vue';
import moment from 'moment';
import usePurchases from '../../Composables/purchases';
import useSuppliers from '../../Composables/suppliers';
import useProducts from '../../Composables/products';
import useUnits from '../../Composables/units';

const {purchaseCode, getPurchaseCode, store} = usePurchases();
const {suppliers, getSuppliers} = useSuppliers();
const {products, getProducts} = useProducts();
const {units, getUnits} = useUnits();

onMounted(()=>{
  getPurchaseCode();
  getSuppliers(status=1);
  getProducts(status=1);
  getUnits(status=1);
});

const form = reactive({
   date: new Date().toLocaleDateString(),
   purchase_code: purchaseCode,
   supplier: null,
   product: null,
   total: 0,
});

//cart
const cart = ref([]);
const calculateTotal= ()=>{
   let total = 0;
   cart.value.forEach(element => {
      total += element.quantity * element.cost
   });
   form.total = total;
}

const calculateAmount= ()=>{
   cart.value.forEach(element => {
      element.amount = element.quantity * element.cost
   });
}

const watchFunction = ()=>{
   calculateAmount();
   calculateTotal();
}
// watch the cart when it change 
watch(cart, watchFunction, { deep: true });


const addToCart = ()=>{
   cart.value.push({
      supplier_id: form.supplier.id,
      supplier_name: form.supplier.name,
      product_id: form.product.id,
      product_image: form.product.image,
      product_name: form.product.name,
      cost: 0,
      quantity: 1,
      unit_id: null,
      discount: 0,
      amount: 0,
   })
}
const save = ()=>{
   const data = {
      date: moment(form.date).format('YYYY/MM/DD'),
      total: form.total,
      code: purchaseCode.value,
      cart: cart.value.map((item)=>{
         const {supplier_id, product_id, product_name, cost, quantity, unit_id, discount, amount} = item;
         return {supplier_id, product_id, product_name, cost, quantity, unit_id, discount, amount};
      }),
   }

   console.log('save', data)
   store(data);
}



</script>

<style scoped>
/* Add your component's styles here */
</style>
