<?php

namespace App\Enums;

enum PaymentType: int
{
   case CASH = 1;
   case ABA = 2;

   public function color()
   {
      return match($this)
      {
         PaymentType::CASH => 'primary',
         PaymentType::ABA => 'success',
      };
   }
}