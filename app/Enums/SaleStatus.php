<?php
namespace App\Enums;

enum SaleStatus: int
{
   case PAID = 1;
   case UNPAID = 2;
   case PARTIALLY_PAID = 3;

   public function color(){
      return match($this){
         SaleStatus::UNPAID => 'danger',
         SaleStatus::PARTIALLY_PAID => 'warning',
         SaleStatus::PAID => 'success',
      };
   }
}