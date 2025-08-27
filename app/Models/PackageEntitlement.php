<?php

namespace App\Models;

use Database\Factories\PackageEntitlementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageEntitlement extends Model
{
    /** @use HasFactory<PackageEntitlementFactory> */
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'package_id',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'json',
        ];
    }

    /** Get the package that this entitlement belongs to */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
