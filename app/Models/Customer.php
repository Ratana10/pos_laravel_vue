<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'customers';
    protected $fillable = [
        'name', 
        'gender', 
        'phone', 
        'address', 
        'description'
    ];

    // protected $attributes = [
    //     'phone' => null,
    // ];

    public function sale(): HasMany
    {
        return $this->hasMany(Sale::class, 'customer_id', 'id');
    }
}