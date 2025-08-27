<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\PackageEntitlement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PackageEntitlement>
 */
class PackageEntitlementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->word(),
            'value' => fake()->word(),
            'package_id' => Package::inRandomOrder()->first()->id,
        ];
    }
}
