<?php

namespace App\Enums;

enum PaymentStatus: int
{
   case PAID = 1;
   case UNPAID = 2;
   case PARTIALLY_PAID = 3;

   public function color()
   {
      return match($this)
      {
         PaymentStatus::PAID => 'primary',
         PaymentStatus::UNPAID => 'danger',
         PaymentStatus::PARTIALLY_PAID => 'warning',
      };
   }
}