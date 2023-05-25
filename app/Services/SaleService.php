<?php

namespace App\Services;

use App\Enums\SaleStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;

class SaleService
{
   public function create($request)
   {
      try {
         return DB::transaction(function () use ($request) {
            $sale = $this->createSale($request);    //create sale
            $this->createSaleDetail($sale, $request); //create saledetail
            if($sale->status->name != SaleStatus::UNPAID){  
               $this->createPayment($sale, $request);  //create payment
            }
         });
      } catch (\Throwable $th) {
         throw $th;
      }
   }
   private function createPayment($sale, $request)
   {
      $payment = new Payment;
      $payment->sale_id = $sale->id;
      $payment->amount = $request->total;
      $payment->paid_amount = $request->paid_amount;
      $payment->change = $request->change;
      $payment->payment_method = $request->payment_method;
      $payment->created_by = $request->created_by;
      $payment->save();
   }
   private function createSaleDetail($sale, $request){
      foreach ($request->saleDetail as $item)
      {
         $saleDetail = new SaleDetail;
         $saleDetail->sale_id = $sale->id;
         $saleDetail->product_id = $item['product_id'];
         $saleDetail->price = $item['price'];
         $saleDetail->quantity = $item['quantity'];
         $saleDetail->discount = $item['discount'];
         $saleDetail->amount = $item['amount'];     
         $saleDetail->save();    
         //decrement product
         Product::where('id', $item['product_id'])->decrement('quantity', $item['quantity']);

      }
   }

   private function createSale($request)
   {
      try{
         $sale = new Sale;
         $sale->customer_id = $request->customer_id;
         $sale->total = $request->total;
         $sale->status = $this->getSaleStatus($request->paid_amount, $request->total);
         $sale->created_by = $request->created_by;
         $sale->save();
         
         return $sale;
      }catch(\Throwable $th){
         throw $th;
      }
   }
   
   private function getSaleStatus($paid_amount, $total)
   {
      if($paid_amount >= $total){
         return SaleStatus::PAID;
      }
      else if($paid_amount != 0 && $paid_amount !=null){
         return SaleStatus::PARTIALLY_PAID;
      }else{
         return SaleStatus::UNPAID;
      }
   }
   
}