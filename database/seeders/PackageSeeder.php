<?php

namespace Database\Seeders;

use App\Enums\PackageCycle;
use App\Models\Package;
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
            ]);

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
            ]);
        PackagePrice::firstOrCreate(
            ['package_id' => $starter->id, 'cycle' => PackageCycle::YEARLY->value],
            [
                'price' => 500 * 12,
                'is_active' => true,
            ]);

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
            ]);
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
            ]);

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
            ]);
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
            ]);
    }
}
