<?php
namespace App\Enums;

enum SaleStatus: int
{
   case UNPAID = 1;
   case PARTIAL = 2;
   case PAID = 3;

   public function color(){
      return match($this){
         SaleStatus::UNPAID => 'danger',
         SaleStatus::PARTIAL => 'warning',
         SaleStatus::PAID => 'success',
      };
   }
}