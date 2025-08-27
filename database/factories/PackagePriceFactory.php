<?php

namespace Database\Factories;

use App\Enums\PackageCycle;
use App\Models\Package;
use App\Models\PackagePrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PackagePrice>
 */
class PackagePriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cycle' => fake()->randomElement(PackageCycle::array()),
            'price' => fake()->randomFloat(0, 500, 5000),
            'is_active' => true,
            'on_promotion' => false,
            'promotion_starts_at' => null,
            'promotion_ends_at' => null,
            'package_id' => Package::where('is_default', '!=', true)
                ->inRandomOrder()
                ->first()
                ->id,
        ];
    }
}
