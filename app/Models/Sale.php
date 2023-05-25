<?php

namespace App\Models;

use App\Enums\SaleStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'total', 
        'status',   
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'status' => SaleStatus::class,
    ];
    

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }


    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'sale_id', 'id');
    }
}