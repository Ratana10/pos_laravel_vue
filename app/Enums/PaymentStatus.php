<?php

namespace App\Enums;

enum PaymentType: int
{
   case PAID = 1;
   case UNPAID = 2;
   case PARTIALLY_PAID = 3;

   public function color()
   {
      return match($this)
      {
         PaymentType::PAID => 'primary',
         PaymentType::UNPAID => 'danger',
         PaymentType::PARTIALLY_PAID => 'warning',
      };
   }
}