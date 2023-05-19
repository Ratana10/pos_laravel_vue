<template lang="">
<div>
   <div class="modal fade" id="check-out-modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Total: {{ total }} $</h1>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="">Customer</label>
                  <select name="" id="" class="form-control">
                     <option>Select Customer ...</option>
                     <option v-for="(customer, index) in customers" :key="index" :value="customer.id">
                        {{ customer.name }}
                     </option>
                  </select>
               </div>
               <div class="form-group">
                  <option value="">Select Method</option>
                  <select name="" id="" class="form-control">
                     <option value="aba">ABA</option>
                     <option value="cash">Cash</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="">Received Amount: </label>
                  <input type="text" class="form-control" v-model="received_amount">
               </div>
               <div class="form-group">
                  <label for="">Change: </label>
                  <input type="text" class="form-control" v-model="change" disabled>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn-lg btn-success w-100" @click="handleSubmit">
                  Pay
               </button>

            </div>
         </div>
      </div>
   </div>
</div>
</template>

<script>
export default {
   props: {
      total: Number,
   },
   data() {
      return {
         customers: [],
         change: 0,
         received_amount: null,
      }
   },
   methods: {
      getCustomers() {
         console.log('test ustomer')
         axios
            .get('/api/v1/customers')
            .then(res => {
               this.customers = res.data.data.data;
            })
      },
   },
   mounted() {
      this.getCustomers();
   },
   watch:{
      received_amount(value){
         if(value < this.total){
            this.change = 0;
         }else{
            this.change = value- this.total;
         }

      }
   }

}
</script>

<style lang="">
   
</style>
