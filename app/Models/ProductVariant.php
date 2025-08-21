<?php

namespace App\Models;

use App\Policies\ProductVariantPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /** Get the attribute values for this ProductVariant */
    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_variant_attribute_value');
    }
}
