<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    /**
     * Get the user that owns the SaleDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}