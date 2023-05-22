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
                  <select v-model="customer_id" class="form-control">
                     <option>Select Customer ...</option>
                     <option v-for="(customer, index) in customers" :key="index" :value="customer.id">
                        {{ customer.name }}
                     </option>
                  </select>
               </div>
               <div class="form-group">
                  <option value="">Select Method</option>
                  <select v-model="payment_method" class="form-control">
                     <option value="2">ABA</option>
                     <option value="1">Cash</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="">Received Amount: </label>
                  <input type="text" class="form-control" v-model.number="received_amount">
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
   },
   data() {
      return {
         customers: [],
         change: 0,
         received_amount: null,
         customer_id: null,
         payment_method: 'aba',
      }
   },
   methods: {
      handleSubmit(){
         // console.log('test', this.received_amount, this.customer_id, this.payment_method)
         this.$emit('submit', this.customer_id, this.received_amount, this.change, this.payment_method)
      },
      getCustomers() {
         axios
            .get('/api/v1/customers')
            .then(res => {    
               this.customers = res.data.data;
            })
      },
   },
  

}
</script>

<style lang="">
   
</style>
