<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\VendorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    /** @use HasFactory<VendorFactory> */
    use HasFactory;

    use Sluggable;

    protected $fillable = [
        'business_name',
        'slug',
        'business_type',
        'registration_number',
        'tax_id',
        'address_line',
        'city',
        'state',
        'country',
        'postal_code',
        'store_name',
        'store_description',
        'store_logo',
        'store_banner',
        'user_id',
    ];

    /** Get the user tied to this Vendor */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Get the categories for this Vendor */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_vendor');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'business_name',
            ],
        ];
    }
}
