<template>
   <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"
      style="">
      <div class="modal-dialog modal-lg no-modal-header">
         <div class="modal-content">
            <div class="modal-body">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  <span aria-hidden="true">&times;</span>
               </button>
               <button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;">
                  <i class="fa fa-print"></i> Print </button>
               <div class="text-center" style="margin-bottom:20px;">
                  Stock Mangerment 
               </div>
               <div class="well well-sm">
                  <div class="row bold">
                     <div class="col-xs-5">
                        <p class="bold">
                           Date: 31/05/2023 07:00<br>
                           Reference: PO2020/08/0011<br>
                           Status: Received<br>
                           Payment Status: Pending<br>
                        </p>
                     </div>
         
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>

               <div class="row" style="margin-bottom:15px;">
                  <!-- <div class="col-xs-6">
                     To:
                     <p style="margin-top:10px;">Fruits Supply Masters</p>
                     51, Section 51A<br>Petaling Jaya <br>
                  </div>
                  <div class="col-xs-6">
                     From:<br>
                     <p style="margin-top:10px;">Stock Manager Advance</p>
                     Warehouse 1
                     <p>Address, City</p>Tel: 012345678<br>Email: whi@tecdiary.com
                  </div> -->
               </div>

               <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Description</th>
                           <th>Quantity</th>
                           <th>Unit Cost</th>
                           <th>Tax</th>
                           <th>Subtotal</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td style="text-align:center; width:40px; vertical-align:middle;">1</td>
                           <td style="vertical-align:middle;">
                              E001 - Eggs
                           </td>
                           <td style="width: 80px; text-align:center; vertical-align:middle;">1.00 box</td>
                           <td style="text-align:right; width:100px;">
                              10.56 </td>
                           <td style="width: 100px; text-align:right; vertical-align:middle;"><small>(VAT10)</small> 0.96
                           </td>
                           <td style="text-align:right; width:120px;">10.56</td>
                        </tr>
                     </tbody>
                     <tfoot>
                        <tr>
                           <td colspan="4" class="text-right">Total (USD) </td>
                           <td class="text-right">0.96</td>
                           <td class="text-right">10.56</td>
                        </tr>
                        <tr>
                           <td colspan="5" style="text-align:right; font-weight:bold;">Total Amount (USD) </td>
                           <td style="text-align:right; font-weight:bold;"> 10.56 </td>
                        </tr>
                        <tr>
                           <td colspan="5" style="text-align:right; font-weight:bold;">Paid (USD) </td>
                           <td style="text-align:right; font-weight:bold;">0.00</td>
                        </tr>
                        <tr>
                           <td colspan="5" style="text-align:right; font-weight:bold;">Balance (USD)
                           </td>
                           <td style="text-align:right; font-weight:bold;">10.56</td>
                        </tr>
                     </tfoot>
                  </table>
               </div>


               <div class="row">
                  <div class="col-xs-4">

                  </div>
                  <div class="col-xs-5 pull-right">
                     <div class="well well-sm">
                        <p>
                           Created by: Owner Owner <br>
                           Date: 31/05/2023 07:00 </p>
                     </div>
                  </div>
               </div>

               <div class="buttons">
                  <div class="btn-group btn-group-justified">
                     <div class="btn-group">
                        <a data-toggle="modal" data-target="#myModal2" class="tip btn btn-primary" title="" data-original-title="Add Payment">
                           <i class="fa fa-dollar"></i>
                           <span class="hidden-sm hidden-xs hidden">Add Payment</span>
                        </a>
                     </div>
                     <div class="btn-group">
                        <a  data-toggle="modal" data-target="#myModal2" class="tip btn btn-primary" title="" data-original-title="Email">
                           <i class="fa fa-envelope-o"></i>
                           <span class="hidden-sm hidden-xs">Email</span>
                        </a>
                     </div>
                     <div class="btn-group">
                        <a  class="tip btn btn-primary" title="" data-original-title="Download as PDF">
                           <i class="fa fa-download"></i>
                           <span class="hidden-sm hidden-xs">PDF</span>
                        </a>
                     </div>
                     <div class="btn-group">
                        <a href="https://sma.tecdiary.net/admin/purchases/edit/9" class="tip btn btn-warning sledit"
                           title="" data-original-title="Edit">
                           <i class="fa fa-edit"></i>
                           <span class="hidden-sm hidden-xs">Edit</span>
                        </a>
                     </div>
                     <div class="btn-group">
                        <a href="#" class="tip btn btn-danger bpo" title="" data-content="<div style='
                              width:150px;'>
                           <p>Are you sure?</p><a class='btn btn-danger'
                              href='https://sma.tecdiary.net/admin/purchases/delete/9'>Yes I'm sure</a> <button
                              class='btn bpo-close'>No</button>
                        </div>" data-html="true" data-placement="top" data-original-title="<b>Delete</b>">
                           <i class="fa fa-trash-o"></i>
                           <span class="hidden-sm hidden-xs">Delete</span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script setup>

import { onMounted } from 'vue';
import PurchaseTable from './PurchaseTable.vue';
import usePurchases from '../../Composables/purchases';

const {purchases, getPurchases} = usePurchases();
onMounted(()=>{
   getPurchases();
   $('#myModal').modal('show'); 
})
</script>
<style scoped>
.well {
    border: 1px solid #ddd;
    background-color: #f6f6f6;
    box-shadow: none;
    border-radius: 0px;
}
.well-sm {
    padding: 9px;
    border-radius: 3px;
}
.pull-right {
    float: right!important;
}
</style>
