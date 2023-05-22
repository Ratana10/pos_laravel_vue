<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'payments';
    protected $fillable = [
        'sale_id', 
        'amount', 
        'paid_amount', 
        'change', 
        'payment_method', 
        'created_by'
    ];
}