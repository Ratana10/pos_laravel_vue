<template lang="">
   <div>
      <div class="modal fade" id="modal-add-payment" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Total: {{ total }} $</h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" class="form-control" v-model="id">

                  <div class="form-group">
                     <label for="">Sale Code</label>
                     <input type="text" class="form-control" v-model="sale_code">

                  </div>
                  <div class="form-group">
                     <option value="">Select Method</option>
                     <select v-model="payment_method" class="form-control">
                        <option value="1">Cash</option>
                        <option value="2">ABA</option>
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
import { showToast } from '../../swalUtils';
import Swal from 'sweetalert2'
   export default {
      props: {
         editing: Object,
      },
      watch:{
         editing(newValue){
            if(this.editing != null){
               this.id = this.editing.id;
               this.sale_code = this.editing.sale_code;
               this.total = this.editing.due_amount;
            }
         },
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
            id: null,
            sale_code: null,
            payment_method: 1,
            total: 0,
            received_amount: 0,
            change: 0,

         }
      },
      methods: {
         handleSubmit(){
            let data = {
               sale_code: this.sale_code,
               sale_id: this.id,
               due_amount: this.total,
               payment_method: this.payment_method,
               paid_amount: this.received_amount,
               change: this.change,
            }
            this.createPayment(data)
         },
         createPayment(data){
            axios.post(`/api/v1/payments`, data)
               .then(res =>{
                     $("#modal-add-payment").modal("hide");
                     this.clearCarts();
                  Swal.fire({
                     icon: 'success',
                     title: 'Payment Success',
                     text: 'Thank You',
                     showConfirmButton: false,
                     timer: 1500
                  })
               })
               .catch(err =>{
                  showToast('error', err);
               })
         }

      },
     
   
   }
   </script>
   
   <style lang="">
      
   </style>
   