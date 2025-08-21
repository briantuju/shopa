<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user should have a specific role.
     */
    public function asUser(Role $role): static
    {
        // Sync the role after creating the user
        return $this->state(fn (array $attributes) => $attributes)
            ->afterCreating(function (User $user) use ($role) {
                $user->assignRole($role->value);
            });
    }

    public function configure(): static
    {
        // We want the USER role to be assigned after creating the user
        return $this->afterCreating(function (User $user) {
            $user->assignRole(Role::USER->value);
        });
    }
}
