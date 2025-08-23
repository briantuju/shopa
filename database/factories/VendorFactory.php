<?php

namespace Database\Factories;

use App\Enums\BusinessType;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $business_name = fake()->company();
        $store_name = fake()->company();

        return [
            'business_name' => $business_name,
            'slug' => str($business_name)->slug(),
            'business_type' => array_rand(BusinessType::array(), 1),
            'store_name' => $store_name,
            'user_id' => User::first()?->id ?? User::factory()->create()->id,
        ];
    }
}
