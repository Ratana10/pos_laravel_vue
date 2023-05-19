<?php
namespace App\Repositories;

use App\Models\Customer;
use App\Interfaces\CrudInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Response;

class CustomerRepository implements CrudInterface
{
   public function getAll(): Paginator
   {
      return Customer::query()
                  ->latest()
                  ->paginate(10);
   }

   public function create(object $request): ?Customer
   {
      return Customer::create([
         'name' => $request->name,
         'gender' =>  $request->gender,
         'phone' =>  $request->phone,
         'address' =>  $request->address,
         'description' =>  $request->description,
      ]);
      
      // return Customer::create([
      //    'name' => $data['name'],
      //    'gender' =>  $data['gender'],
      //    'phone' =>  $data['phone'],
      //    'address' =>  $data['address'],
      //    'description' =>  $data['description'],
      // ]);
   }

   public function update(object $request, Object $customer): ?Customer
   {
      $customer->update([
         'name' => $request->name,
         'gender' =>  $request->gender,
         'phone' =>  $request->phone,
         'address' =>  $request->address,
         'description' =>  $request->description,
       ]);
      return $customer;
   }

   public function destory(object $customer): ?Customer
   {
      $deleted = $customer->delete();
      if(!$deleted){
         throw new \Exception('Customer could not be deleted', Response::HTTP_INTERNAL_SERVER_ERROR);
      }
      return $customer;
   }
}