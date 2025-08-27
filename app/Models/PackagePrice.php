<?php

namespace App\Models;

use App\Enums\PackageCycle;
use Database\Factories\PackagePriceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackagePrice extends Model
{
    /** @use HasFactory<PackagePriceFactory> */
    use HasFactory;

    protected $fillable = [
        'billing_cycle',
        'price',
        'is_active',
        'on_promotion',
        'promotion_starts_at',
        'promotion_ends_at',
        'package_id',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'bool',
            'on_promotion' => 'bool',
            'billing_cycle' => PackageCycle::class,
        ];
    }

    /** Get the package that this price belongs to. */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
