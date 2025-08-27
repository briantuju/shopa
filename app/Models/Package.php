<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\PackageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    /** @use HasFactory<PackageFactory> */
    use HasFactory;

    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'grace_period_days',
        'trial_period_days',
        'is_default',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'is_default' => 'bool',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Package $package) {
            // we enforce only one default package
            if ($package->is_default) {
                static::where('id', '!=', $package->id)
                    ->update(['is_default' => false]);
            }
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /** Get the price options for this package. */
    public function packagePrices(): HasMany
    {
        return $this->hasMany(PackagePrice::class);
    }
}
