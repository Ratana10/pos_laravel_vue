<?php
namespace App\Traits;   
use Illuminate\Http\JsonResponse;

trait ResponseTrait 
{
   /**
    * Success  Response
    *
    * @param array|object $data
    * @param string $message
    * @return JsonResponse
    */ 
   public function responseSuccess($data, $message='success'): JsonResponse
   {
      return response()->json([
         'status' => true,
         'message' => $message,
         'data' => $data,
         'errors' => null,
      ]);
   }

   /**
    * Error  Response
    *
    * @param array|object $error
    * @param string $message
    * @return JsonResponse
    */ 
    public function responseError($errors, $message='fail'): JsonResponse
    {
       return response()->json([
          'status' => false,
          'message' => $message,
          'data' => null,
          'errors' => $errors,
       ]);
    }
}