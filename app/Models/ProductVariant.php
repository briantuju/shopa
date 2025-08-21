<?php

namespace App\Models;

use App\Policies\ProductVariantPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[UsePolicy(ProductVariantPolicy::class)]
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
