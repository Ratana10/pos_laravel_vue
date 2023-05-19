<?php
namespace App\Interfaces;


use Illuminate\Contracts\Pagination\Paginator;

interface CrudInterface
{
   public function getAll(): Paginator;

   public function create(object $data): Object|null;

   public function update(object $data, object $obj): Object|null;

   public function destory(object $obj): Object|null;


}