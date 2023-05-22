<template>
<div class="content">
   <div class="container-fluid">
      <div class="mt-3">
         <div class="row">
            <div class="col-md-6 col-lg-8">
               <div class="row">
                  <div class="col">
                     <select name="" id="" class="form-control">
                        <option :value="null">All</option>
                        <option v-for="(category, index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                     </select>
                  </div>
                  <div class="col">
                     <input type="text" name="" id="" placeholder="Search Product" class="form-control">
                  </div>

               </div>
               <div class="row mt-3">
                  <div class="col-md-2 mb-2" v-for="(product, index) in products" :key="index">

                     <div class="card" @click="handleAddToCart(product)">
                        <img class="p-2" :src="'/uploads/products/'+ product.image" alt="" style="width: auto; height: 150px;">
                        <div class="card-body">
                           <h4 class="card-title text-bold text-center">{{ product.name }}</h4>
                           <p class="card-text">Qty: {{ product.quantity }}</p>
                           <p class="card-text">Price: ${{ product.price }}</p>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">

               <div class="item-cart">
                  <div class="card">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Product</th>
                              <th>Qty</th>
                              <th>Price</th>
                              <th>Amount</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(cart, index) in carts" :key="index">
                              <td>{{ index+1 }}</td>
                              <td>{{ cart.name }}</td>
                              <td>
                                 <input type='button' value='-' class='qtyminus minus' @click="decreaseCartQty(index)" />
                                 <input type='text' name='quantity' class='qty' v-model="cart.quantity" disabled />
                                 <input type='button' value='+' class='qtyplus plus' @click="increaseCartQty(index)" />
                              </td>
                              <td>{{ cart.price }}</td>
                              <td>{{ (cart.price * cart.quantity).toFixed(2) }}$</td>
                              <td>
                                 <button type="button" class="btn btn-danger btn-sm" @click="removeProductFromCart(index)"><i class="fa fa-trash"></i></button>
                              </td>
                           </tr>

                        </tbody>
                     </table>
                  </div>
                  <div class="row mb-3">
                     <div class="col">
                        <h3>Total: </h3>
                     </div>
                     <div class="col text-right">
                        <h3>{{ total }} $</h3>
                     </div>
                  </div>
                  <div class="row mb-1">
                     <div class="col">
                        <input type="button" value="Cancle" class="btn btn-danger btn-block" @click="clearCarts">
                     </div>
                     <div class="col">
                        <input type="button" value="Check Out" class="btn  btn-success btn-block" @click="checkOut">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <input type="button" value="Receipt" class="btn  btn-secondary btn-block">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<check-out-modal :total="total" @submit="handleSubmit"  />
</template>

<script>
import CheckOutModal from './CheckOutModal.vue';
import moment from 'moment';
import Swal from 'sweetalert2';
export default {
   components:{
      CheckOutModal,
   },
   data() {
      return {
         carts: [],
         products: [],
         categories: [],
         total: 0.00,
         date: null,
      }
   },
   methods: {
      handleSubmit(customer_id,  received_amount, payment_method){
         let saleDetail = [];
         this.carts.forEach(e =>{
            saleDetail.push({
               product_id: e.product_id,
               price: e.price,
               quantity: e.quantity,
               discount: 0,
            })
         });

         let data ={
            // sale
            customer_id: customer_id,
            total: this.total,
            due_amount: this.total,
            paid_amount: received_amount,
            exchange: null,
            date:  moment(this.date).format('YYYY-MM-DD'),
            created_by: 1,
            // sale Detail
            saleDetail: saleDetail,
            // payment
            amount: this.total,
            payment_method: payment_method,

         }

         axios
            .post('/api/v1/pos', data)
            .then(res =>{
               $('#check-out-modal').modal('hide');
               this.clearCarts();
               Swal.fire({
                  icon: 'success',
                  title: 'Payment Success',
                  text: 'Thank You',
                  showConfirmButton: false,
                  timer: 1500
               })
               console.log('success')
            })
            .catch(err =>{
               console.log('error');
            })
         
      },
      checkOut(){
         
         $('#check-out-modal').modal('show');
      },
      clearCarts(){
         this.carts = [];
      },
      removeProductFromCart(index) {
         this.carts.splice(index, 1);
      },
      findExistsCart(product_id) {
         return this.carts.findIndex(item => item.product_id == product_id);
      },
      increaseCartQty(index) {
         if (this.carts[index].quantity < this.carts[index].stock_qty) {
            this.carts[index].quantity += 1;
         } else {
            //product out of stock

         }
      },
      decreaseCartQty(index) {
         if (this.carts[index].quantity > 1) {
            this.carts[index].quantity -= 1;
         } else if (this.carts[index].quantity == 1) {
            this.removeProductFromCart(index);
         }
      },
      handleAddToCart(product) {
         let index = this.findExistsCart(product.id);

         if (index != -1) {
            // found the product that exists in cart then increase the quantity
            this.increaseCartQty(index);
         } else {
            // 
            this.carts.push({
               product_id: product.id,
               name: product.name,
               quantity: 1,
               price: product.price,
               stock_qty: product.quantity,
            });
         }
      },
      getProducts() {
         axios
            .get('/api/v1/pos')
            .then(res => {
               this.products = res.data.products;
               this.categories = res.data.categories;
            })
            .catch(err => {
               console.log('error: ', err);
            })

      }
   },
   mounted() {
      this.getProducts();
   },
   watch:{
      carts: {
         deep: true, // Watch for changes in nested properties of "carts"
         handler: function(carts){
            let total = 0;
            carts.forEach(cart => {
               total += cart.quantity * cart.price;
            });
            this.total = total.toFixed(2);
         }
      }
   },
   created() {
      setInterval(() => {
         this.date = moment().format('DD MMMM YYYY, h:mm:ss a');
      })
   },
}
</script>

<style scoped>
.item-cart .card {
   height: 750px;
   overflow: hidden;
}

.qty {
   width: 40px;
   height: 30px;
   text-align: center;
}

input.qtyplus {
   width: 25px;
   height: 30px;
}

input.qtyminus {
   width: 25px;
   height: 30px;
}
</style>
