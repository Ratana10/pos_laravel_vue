<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'sales';
    protected $fillable = [
        'code',
        'customer_id',
        'total',
        'due_amount',
        'paid_amount',
        'exchange',
        'created_by',
        'date',
    ];
}