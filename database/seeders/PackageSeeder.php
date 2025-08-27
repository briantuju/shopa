<?php

namespace Database\Seeders;

use App\Enums\PackageCycle;
use App\Enums\VendorSupport;
use App\Models\Package;
use App\Models\PackageEntitlement;
use App\Models\PackagePrice;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $free = Package::firstOrCreate(
            ['name' => 'Shopa Free'],
            [
                'description' => 'Get started for free',
                'is_default' => true,
            ]
        );
        /* Since we need to send invoices (monthly), the free plan also gets a price */
        PackagePrice::firstOrCreate(
            ['package_id' => $free->id, 'cycle' => PackageCycle::MONTHLY->value],
            [
                'price' => 0,
                'is_active' => true,
            ]
        );

        $starter = Package::firstOrCreate(
            ['name' => 'Starter Pack'],
            [
                'description' => 'With this plan, you get access to these features.',
                'trial_period_days' => 30,
                'grace_period_days' => 3,
            ]
        );
        PackagePrice::firstOrCreate(
            ['package_id' => $starter->id, 'cycle' => PackageCycle::MONTHLY->value],
            [
                'price' => 500,
                'is_active' => true,
            ]
        );
        PackagePrice::firstOrCreate(
            ['package_id' => $starter->id, 'cycle' => PackageCycle::YEARLY->value],
            [
                'price' => 500 * 12,
                'is_active' => true,
            ]
        );

        $premium = Package::firstOrCreate(
            ['name' => 'Premium Plan'],
            [
                'description' => 'With this plan, you get access to these features.',
                'trial_period_days' => 30,
                'grace_period_days' => 5,
            ]
        );
        PackagePrice::firstOrCreate(
            ['package_id' => $premium->id, 'cycle' => PackageCycle::MONTHLY->value],
            [
                'price' => 1500,
                'is_active' => true,
            ]
        );
        PackagePrice::firstOrCreate(
            ['package_id' => $premium->id, 'cycle' => PackageCycle::YEARLY->value],
            [
                // monthly plan price * 10 months since we're running a promotion for this package
                'price' => 1500 * 10,
                'is_active' => true,
                // promotion for 2 weeks
                'on_promotion' => true,
                'promotion_starts_at' => now(),
                'promotion_ends_at' => now()->addWeeks(2),
            ]
        );

        $ultimate = Package::firstOrCreate(
            ['name' => 'Ultimate Plan'],
            [
                'description' => 'With this plan, you get access to these features.',
                'trial_period_days' => 30,
                'grace_period_days' => 7,
            ]
        );
        PackagePrice::firstOrCreate(
            ['package_id' => $ultimate->id, 'cycle' => PackageCycle::MONTHLY->value],
            [
                'price' => 2500,
                'is_active' => true,
            ]
        );
        PackagePrice::firstOrCreate(
            ['package_id' => $ultimate->id, 'cycle' => PackageCycle::YEARLY->value],
            [
                // monthly plan price * 10 months since we're running a promotion for this package
                'price' => 2500 * 10,
                'is_active' => true,
                // promotion for 2 weeks
                'on_promotion' => true,
                'promotion_starts_at' => now(),
                'promotion_ends_at' => now()->addWeeks(2),
            ]
        );

        // Define all entitlement keys and sensible defaults
        $allEntitlements = [
            'products.max' => 10,
            'products.featured.max' => 1,
            'categories.max' => 2,
            'images.max_per_product' => 3,
            'analytics.access' => false,
            'support.priority' => [VendorSupport::NONE->value],
            'discounts.enabled' => false,
            'ads.credits' => 0, // consumed based on number of products promoted
        ];

        // Define packages and overrides
        /** @var array<int, array<string, int|bool|string|array|null>> $packages */
        $packages = [
            $free->id => [], // Nothing to override in the free plan
            $starter->id => [ // Starter
                'products.max' => 50,
                'products.featured.max' => 5,
                'categories.max' => 10,
                'analytics.access' => true,
                'discounts.enabled' => true,
                'support.priority' => [VendorSupport::EMAIL->value],
            ],
            $premium->id => [ // Premium
                'products.max' => 200,
                'products.featured.max' => 20,
                'categories.max' => 50,
                'analytics.access' => true,
                'discounts.enabled' => true,
                'ads.credits' => 100,
                'support.priority' => [VendorSupport::EMAIL->value, VendorSupport::CHAT->value],
            ],
            $ultimate->id => [ // Ultimate
                'products.max' => 1000,
                'products.featured.max' => 100,
                'categories.max' => 200,
                'analytics.access' => true,
                'discounts.enabled' => true,
                'ads.credits' => 1000,
                'support.priority' => [VendorSupport::ALL->value],
            ],
        ];

        foreach ($packages as $packageId => $overrides) {
            $entitlements = array_merge($allEntitlements, $overrides);

            foreach ($entitlements as $key => $value) {
                PackageEntitlement::insert([
                    'package_id' => $packageId,
                    'key' => $key,
                    'value' => json_encode($value),
                ]);
            }
        }
    }
}
