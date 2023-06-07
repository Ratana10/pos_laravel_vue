<?php

namespace App\Models;

use App\Enums\GenderType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'customers';
    protected $fillable = [
        'name', 
        'gender', 
        'phone', 
        'address', 
        'description'
    ];
    
    protected $casts = [
        'gender' => GenderType::class,
    ];

    // protected $attributes = [
    //     'phone' => null,
    // ];

    public function sale(): HasMany
    {
        return $this->hasMany(Sale::class, 'customer_id', 'id');
    }
}