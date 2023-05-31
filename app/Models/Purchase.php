<?php

namespace App\Models;

use App\Enums\PurchaseStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable  = [
        'date',
        'total',
        'status',
        'created_by'
    ];

    protected $casts = [
        'status' => PurchaseStatus::class,
    ];

  
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}