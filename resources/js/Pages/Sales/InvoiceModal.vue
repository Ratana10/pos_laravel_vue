<template lang="">
<div>
   <!-- Modal -->
   <div class="modal fade" id="invoice-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="container" id="print">
                  <div class="invoice-header">
                     <h1>Invoice</h1>
                     <p class="invoice-number">Sale Number: INV-12345</p>
                  </div>
                  <div>
                     <p class="mb-1">Date: 26.05.2023</p>
                     Customer: Walk-in Customer

                  </div>

                  <table class="table invoice-table">
                     <thead>
                        <tr>
                           <th>Item</th>
                           <th>Qty</th>
                           <th>Dis</th>
                           <th>UnitPrice</th>
                           <th>Amount</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Item 1</td>
                           <td>2</td>
                           <td>$10</td>
                           <td>$10</td>
                           <td>$20</td>
                        </tr>
                        <tr>
                           <td>Item 2</td>
                           <td>3</td>
                           <td>$15</td>
                           <td>$45</td>
                           <td>$45</td>
                        </tr>
                     </tbody>
                  </table>
                  <div class="text-right">
                     <p class="mb-2"><strong>Delivery: $00.00</strong></p>
                     <p><strong>Total: $65.00</strong></p>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" @click="print">Print</button>
            </div>
         </div>
      </div>
   </div>
</div>
</template>

<script>
import printJS from 'print-js'
export default {
   methods: {
      print() {
         printJS({
            printable: "print",
            type: "html",
            targetStyles: ["*"],
         });
      },
   }
}
</script>

<style scoped>
.invoice-header {
   text-align: center;
   margin-bottom: 20px;
}

.invoice-number {
   font-size: 18px;
   color: #888;
}

.from-address,
.to-address {
   font-size: 14px;
   line-height: 1.5;
}
</style>
