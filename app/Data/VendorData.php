<?php

namespace App\Data;

use App\Enums\BusinessType;
use App\Enums\VendorStatus;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

#[MergeValidationRules]
class VendorData extends Data
{
    public function __construct(
        public string $business_name,

        #[Required, Enum(BusinessType::class)]
        public BusinessType $business_type,
        public ?string $registration_number,
        public ?string $tax_id,

        public ?string $address_line,
        public ?string $city,
        public ?string $state,
        public ?string $country,
        public ?string $postal_code,

        public string $store_name,
        public ?string $store_description,
        public ?string $store_logo,
        public ?string $store_banner,

        #[Required, Enum(VendorStatus::class)]
        public VendorStatus $status,
    ) {}

    public function authorize(): bool
    {
        return true;
    }
}
