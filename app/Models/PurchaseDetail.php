<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable  = [
        'purchaes_id',
        'purchase_code',
        'supplier_id',
        'product_id',
        'cost',
        'quantity',
        'unit_id',
        'discount',
        'amount',
    ];
}