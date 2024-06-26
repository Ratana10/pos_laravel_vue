<?php
namespace App\Helpers;

class Helper
{
   public static function IDGenderator($model, $field, $length = 4, $prefix)
   {
      $data = $model::orderBy('id', 'desc')->first();
      if(!$data){
         $or_length = $length-1;
         $last_number = '1';
      }
      else{
         $code = substr($data->$field, strlen($prefix)+1);
         $actial_last_number = ($code/1)*1;
         $increment_last_number =$actial_last_number+1;
         $last_number_length = strlen($increment_last_number);
         $or_length = $length - $last_number_length;
         $last_number = $increment_last_number;
      }
      $zeros = "";
      for($i = 0; $i < $or_length; $i++){
         $zeros.='0';
      }
      return $prefix.'-'.$zeros.$last_number;
   }
}