<?php
namespace App\Repositories;

use App\Models\Customer;
use App\Interfaces\CrudInterface;
use Illuminate\Contracts\Pagination\Paginator;

class CustomerRepository implements CrudInterface
{
   public function getAll(): Paginator
   {
      return Customer::query()->paginate(10);
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

   public function delete(object $customer): ?Customer
   {
      $customer->delete();
      return $customer;
   }
}