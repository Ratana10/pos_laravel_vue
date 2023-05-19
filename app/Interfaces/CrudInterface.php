<?php
namespace App\Interfaces;


use Illuminate\Contracts\Pagination\Paginator;

interface CrudInterface
{
   public function getAll(): Paginator;

   public function create(array $data): Object|null;

   public function update(array $data, object $obj): Object|null;

   public function delete(object $obj): Object|null;


}