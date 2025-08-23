<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];

    /** Get the parent Category */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /** Get the products for this Category */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /** Get the vendors for this Category */
    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class, 'category_vendor');
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
