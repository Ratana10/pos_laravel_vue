<?php
namespace App\Enums;

enum PurchaseStatus: int
{
   case PENDING = 1;
   case RECEIVED = 2;
   case RETURNED = 3;

   public function color(){
      return match($this){
         PurchaseStatus::RETURNED => 'danger',
         PurchaseStatus::PENDING=> 'warning',
         PurchaseStatus::RECEIVED => 'success',
      };
   }
}