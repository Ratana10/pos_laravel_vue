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

                     <div class="card" @click="handleAddToCart"> 
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
                              <td>{{ cart.product }}</td>
                              <td>
                                 <input type='button' value='-' class='qtyminus minus' />
                                 <input type='text' name='quantity' class='qty' disabled />
                                 <input type='button' value='+' class='qtyplus plus' />
                              </td>
                              <td>{{ cart.price }}</td>
                              <td>{{ cart.amount }}</td>
                              <td>
                                 <button type="button" class="btn btn-danger btn-sm" @click="handleRemoveFromCart(index)"><i class="fa fa-trash"></i></button>
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
                        <h3>5.5 $</h3>
                     </div>
                  </div>
                  <div class="row mb-1">
                     <div class="col">
                        <input type="button" value="Cancle" class="btn btn-danger btn-block">
                     </div>
                     <div class="col">
                        <input type="button" value="Check Out" class="btn  btn-success btn-block" @click="handlePay">
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
</template>

<script>
export default {
   data() {
      return {
         carts: [{
               product: 'Apple',
               quantity: 1,
               price: 2,
               amount: 2,
            },
            {
               product: 'Banana',
               quantity: 1,
               price: 2,
               amount: 2,
            },
         ],
         products: [],
         categories: [],
      }
   },
   methods: {
      findExistsCart(product_id) {
      },
      handleAddToCart(product) {


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
