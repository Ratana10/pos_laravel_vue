<?php
namespace App\Enums;

enum SaleStatus: int
{
   case PAID = 1;
   case UNPAID = 2;
   case PARTIAL = 3;

   public function color(){
      return match($this){
         SaleStatus::UNPAID => 'danger',
         SaleStatus::PARTIAL=> 'warning',
         SaleStatus::PAID => 'success',
      };
   }
}