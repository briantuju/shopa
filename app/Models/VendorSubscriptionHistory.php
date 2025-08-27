<?php

namespace App\Models;

use App\Enums\VendorSubscriptionChange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorSubscriptionHistory extends Model
{
    protected $fillable = [
        'change_type',
        'effective_at',
        'previous_ends_at',
        'previous_price',
        'new_price',
        'billing_cycle',
        'previous_billing_cycle',
        'previous_package_snapshot',
        'gateway_transaction_id',
        'new_package_snapshot',
        'notes',
        'vendor_id',
        'vendor_subscription_id',
        'package_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'change_type' => VendorSubscriptionChange::class,
            'previous_package_snapshot' => 'array',
            'new_package_snapshot' => 'array',
        ];
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function vendorSubscription(): BelongsTo
    {
        return $this->belongsTo(VendorSubscription::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
