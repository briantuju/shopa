<?php

namespace Database\Factories;

use App\Enums\BusinessType;
use App\Enums\Role;
use App\Enums\VendorStatus;
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

    /**
     * Indicate that the model's status should be verified.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => VendorStatus::APPROVED->value,
        ]);
    }

    public function configure(): static
    {
        // We want the VENDOR role to be assigned to the user
        return $this->afterCreating(function (Vendor $vendor) {
            $vendor->user->syncRoles(Role::VENDOR->value);
        });
    }
}
