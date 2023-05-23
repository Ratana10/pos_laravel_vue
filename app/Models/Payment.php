<?php

namespace App\Models;

use App\Enums\PaymentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $casts = [
        'created_at' => 'datetime',
        'payment_method' => PaymentType::class,
    ];

    // public function paymentMethod(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => PaymentType::from($value)->name,
    //     );
    // }
    
    /**
     * Get the user associated with the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}