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
                       <input type="text" name="" id="" class="form-control">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <label > Date</label>
                     <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
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
                       <select name="" id="" class="form-control">
                         <option value="">Pu Thy</option>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group">
                       <label for="">Search Product</label>
                       <div class="input-group">
                         <input type="search" class="form-control" placeholder="Type your keywords here">
                         <div class="input-group-append">
                           <button type="submit" class="btn btn-default">
                             <i class="fa fa-search"></i>
                           </button>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="row mt-5">
                   <table class="table table-bordered ">
                     <thead class="bg-secondary">
                       <tr>
                         <th>#</th>
                         <th>Supplier</th>
                         <th>Product Name</th>
                         <th>Cost</th>
                         <th>Qty</th>
                         <th>Unit</th>
                         <th>Dis</th>
                         <th>Amount</th>
                       </tr>
                     </thead>
                     <tbody>
                       <tr>
                         <td>1</td>
                         <td>Ming Pov</td>
                         <td>Form Face</td>
                         <td style="width: 150px">
                           <input type="text" name="" id="" class="form-control">
                         </td>
                         <td style="width: 150px">
                           <input type="text" name="" id="" class="form-control">
                         </td>
                         <td  style="width: 200px">
                           <select class="form-control">
                              <option value="">កេស</option>
                           </select>
                         </td>
                         <td style="width: 150px">
                           <input type="text" name="" id="" class="form-control">
                         </td>
                        <td>200</td>
                       </tr>
                     </tbody>
                   </table>
                 </div>
                 <div class="row">
                   <div class="col-md-12 text-right">
                     <div class="form-group">
                       <span>Sub-Total: $123</span>
                     </div>
                     <div class="form-group">
                        <span>Discount: 0 %</span>
                     </div>
                     <div class="form-group">
                        <span>Total: $123</span>
                     </div>
                     <button type="button" class="btn btn-primary">Pay</button>
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
 
 <script>
 export default {
   name: 'CreatePurchases',
   // Add your component's logic here
 }
 </script>
 
 <style scoped>
 /* Add your component's styles here */
 </style>
 