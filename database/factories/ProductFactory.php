<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_name = fake()->words(2, true);

        return [
            'name' => $product_name,
            'slug' => str($product_name)->slug(),
            'sku' => fake()->ean13(),
            'description' => fake()->paragraph(),

            'brand_id' => Brand::inRandomOrder()->first()?->id ?? null,
            'category_id' => Category::inRandomOrder()->first()?->id ?? null,
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
        ];
    }
}
