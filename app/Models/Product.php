<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'code',
        'name',
        'category_id',
        'unit_id',
        'price',
        'discount',
        'quantity',
        'alert',
        'image',
        'barcode',
        'status',
    ];


    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    
    public function unit(): HasOne
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}