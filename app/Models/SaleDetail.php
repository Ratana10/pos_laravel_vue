<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'sale_details';
    protected $fillable = [
        'sale_id',
        'product_id',
        'price',
        'quantity',
        'discount',
        'amount',
    ];
}