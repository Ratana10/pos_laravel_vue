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
                  ->paginate(request('perPage'), ['*'], 'page', request('page'));

   }

   public function create(array $data): ?Customer
   {
      return Customer::create([
         'name' => $data['name'],
         'gender' =>  $data['gender'],
         'phone' =>  $data['phone'],
         'address' =>  $data['address'],
         'description' =>  $data['description'],
      ]);
      
   }

   public function update(array $data, Object $customer): ?Customer
   {
      $customer->update([
         'name' => $data['name'],
         'gender' =>  $data['gender'],
         'phone' =>  $data['phone'],
         'address' =>  $data['address'],
         'description' =>  $data['description'],
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