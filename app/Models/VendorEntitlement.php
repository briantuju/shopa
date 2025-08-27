<?php

namespace App\Models;

use Database\Factories\VendorEntitlementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorEntitlement extends Model
{
    /** @use HasFactory<VendorEntitlementFactory> */
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'source',
        'vendor_subscription_id',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }

    /** Get the subscription this entitlement is tied to */
    public function vendorSubscription(): BelongsTo
    {
        return $this->belongsTo(VendorSubscription::class);
    }
}
