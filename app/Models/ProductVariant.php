<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $fillable = [
        'sku',
        'price',
        'stock',
        'image',
        'product_id',
    ];

    /** Get the product that this ProductVariant belongs to */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
