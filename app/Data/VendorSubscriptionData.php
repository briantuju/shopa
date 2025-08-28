<?php

namespace App\Data;

use App\Enums\PackageCycle;
use App\Enums\PaymentGateway;
use App\Enums\Permission;
use App\Enums\Resource;
use App\Enums\VendorSubscriptionStatus;
use App\Models\Package;
use App\Models\Vendor;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class VendorSubscriptionData extends Data
{
    public function __construct(
        public int $package_id,
        public int $vendor_id,
        public Carbon $ends_at,
        public Carbon $renewal_at,
        public Carbon $trial_ends_at,
        public PackageCycle $billing_cycle,
        public float $price,
        public VendorSubscriptionStatus $status,
        public PaymentGateway $payment_gateway,
        public ?string $gateway_transaction_id,
        public ?string $notes,
        public array $package_snapshot,
    ) {}

    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'package_id' => ['required', 'exists:'.Package::class],
            'vendor_id' => ['required', 'exists:'.Vendor::class],
        ];
    }

    public static function authorize(): bool
    {
        return auth()->user()?->can(
            Permission::CREATE->value.' '.Resource::VendorSubscription->value
        );
    }
}
