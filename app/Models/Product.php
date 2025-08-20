<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'main_image',
        'description',
        'category_id',
        'brand_id',
        'user_id',
    ];

    /** Get the category that this Product belongs to */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** Get the brand that this Product belongs to */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /** Get the user that created this Product */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Get the variants for this Product */
    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
