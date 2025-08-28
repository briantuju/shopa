<?php

namespace App\Models;

use App\Enums\PaymentGateway;
use App\Enums\VendorSubscriptionStatus;
use Database\Factories\VendorSubscriptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorSubscription extends Model
{
    /** @use HasFactory<VendorSubscriptionFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'started_at',
        'ends_at',
        'cancelled_at',
        'trial_ends_at',
        'renewal_at',
        'last_payment_at',
        'billing_cycle',
        'price',
        'last_payment_success',
        'failed_payments_count',
        'status',
        'payment_gateway',
        'gateway_transaction_id',
        'gateway_customer_id',
        'package_snapshot',
        'notes',
        'vendor_id',
        'package_id',
    ];

    protected function casts(): array
    {
        return [
            'last_payment_success' => 'bool',
            'status' => VendorSubscriptionStatus::class,
            'payment_gateway' => PaymentGateway::class,
            'package_snapshot' => 'array',
        ];
    }

    /** Get the vendor that this subscription belongs to */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /** Get the package that this subscription is for */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /** Get the vendor entitlements tied to this subscription */
    public function entitlements(): HasMany
    {
        return $this->hasMany(VendorEntitlement::class);
    }

    /** Get the history of changes to this subscription */
    public function history(): HasMany
    {
        return $this->hasMany(VendorSubscriptionHistory::class);
    }
}
