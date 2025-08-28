<?php

namespace Database\Seeders;

use App\Enums\PackageCycle;
use App\Enums\PaymentGateway;
use App\Enums\VendorSubscriptionChange;
use App\Enums\VendorSubscriptionStatus;
use App\Models\Package;
use App\Models\Vendor;
use App\Models\VendorSubscription;
use Illuminate\Database\Seeder;

class VendorSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = Vendor::take(3)->get();
        $packages = Package::take(3)->get();

        foreach ($vendors as $index => $vendor) {
            $package = $packages[$index] ?? $packages->first();

            if (! $packages) {
                return;
            }

            VendorSubscription::insert([
                'started_at' => now()->subDays(rand(0, 20)),
                'ends_at' => now()->addMonth(),
                'renewal_at' => now()->addMonth(),
                'billing_cycle' => array_rand(PackageCycle::array()),
                'price' => array_rand([500, 1000, 1500, 2000, 2500]),
                'status' => array_rand(VendorSubscriptionStatus::array()),
                'payment_gateway' => array_rand(PaymentGateway::array()),
                'gateway_transaction_id' => 'txn_'.rand(100000, 999999),
                'package_snapshot' => json_encode([
                    'id' => fake()->uuid(),
                    'name' => $package->name,
                ]),
                'notes' => 'Seeded subscription for testing',
                'vendor_id' => $vendor->id,
                'package_id' => $package->id,
            ]);
        }

        // Create a `CREATED` subscription history for each subscription
        foreach (VendorSubscription::all() as $subscription) {
            $subscription->history()->create([
                'change_type' => VendorSubscriptionChange::CREATED->value,
                'effective_at' => now(),
                'billing_cycle' => $subscription->billing_cycle,
                'notes' => 'Created automatically',
                'vendor_id' => $subscription->vendor_id,
            ]);
        }
    }
}
