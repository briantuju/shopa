<?php

namespace App\Models;

use App\Enums\BusinessType;
use App\Enums\VendorStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\VendorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    protected function casts(): array
    {
        return [
            'business_type' => BusinessType::class,
            'status' => VendorStatus::class,
        ];
    }

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

    /** Get the products for this Vendor */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /** Get the subscription tied to this Vendor */
    public function vendorSubscription(): HasOne
    {
        return $this->hasOne(VendorSubscription::class);
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
