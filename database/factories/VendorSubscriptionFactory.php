<?php

namespace Database\Factories;

use App\Enums\PackageCycle;
use App\Enums\PaymentGateway;
use App\Enums\VendorSubscriptionChange;
use App\Enums\VendorSubscriptionStatus;
use App\Models\Package;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorSubscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VendorSubscription>
 */
class VendorSubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'started_at' => now(),
            'ends_at' => now()->addMonth(),
            'renewal_at' => now()->addMonth(),
            'billing_cycle' => fake()->randomElement(PackageCycle::array()),
            'price' => fake()->randomElement([0, 500, 1000, 1500, 2500]),
            'status' => fake()->randomElement(VendorSubscriptionStatus::array()),
            'payment_gateway' => fake()->randomElement(PaymentGateway::array()),
            'gateway_transaction_id' => 'txn_'.rand(100000, 999999),
            'package_snapshot' => [
                'id' => fake()->uuid(),
                'name' => fake()->word(),
            ],
            'notes' => fake()->text(),
            'vendor_id' => Vendor::factory()->create([
                'user_id' => User::factory()->create()->id,
            ])->id,
            'package_id' => Package::factory()->create()->id,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (VendorSubscription $vendorSubscription) {
            // Create subscription history entry
            $vendorSubscription->history()->create([
                'change_type' => VendorSubscriptionChange::CREATED->value,
                'effective_at' => now(),
                'billing_cycle' => $vendorSubscription->billing_cycle,
                'notes' => 'Created automatically',
                'vendor_id' => $vendorSubscription->vendor_id,
            ]);
        });
    }
}
