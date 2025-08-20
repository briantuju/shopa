<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Turn off foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Truncate the products table
        Product::truncate();

        // If user table is empty, seed it
        if (User::count() === 0) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);

        $adidas_id = Brand::where('name', 'Adidas')->first()->id;
        $nike_id = Brand::where('name', 'Nike')->first()->id;
        $apple_id = Brand::where('name', 'Apple')->first()->id;
        $samsung_id = Brand::where('name', 'Samsung')->first()->id;
        $zara_id = Brand::where('name', 'Zara')->first()->id;

        $apparel_id = Category::where('name', 'Apparel')->first()->id;
        $footwear_id = Category::where('name', 'Footwear')->first()->id;
        $electronics_id = Category::where('name', 'Electronics')->first()->id;
        $sporting_goods_id = Category::where('name', 'Sports & Outdoors')->first()->id;

        $user_id = User::first()->id;

        // Use realistic data
        $data = [
            [
                'name' => 'Men\'s Tech T-Shirt',
                'slug' => 'mens-tech-t-shirt',
                'sku' => 'ADID-TSHIRT-001',
                'description' => 'A lightweight, breathable t-shirt perfect for workouts.',
                'brand_id' => $adidas_id,
                'category_id' => $apparel_id,
                'user_id' => $user_id,
            ],
            [
                'name' => 'Air Force 1 Sneakers',
                'slug' => 'air-force-1-sneakers',
                'sku' => 'NIKE-AF1-001',
                'description' => 'Classic sneakers with a timeless design and comfortable fit.',
                'brand_id' => $nike_id,
                'category_id' => $footwear_id,
                'user_id' => $user_id,
            ],
            [
                'name' => 'MacBook Pro',
                'slug' => 'macbook-pro',
                'sku' => 'APPL-MBP-001',
                'description' => 'A powerful laptop for professional creative and development tasks.',
                'brand_id' => $apple_id,
                'category_id' => $electronics_id,
                'user_id' => $user_id,
            ],
            [
                'name' => 'Galaxy S24 Ultra',
                'slug' => 'galaxy-s24-ultra',
                'sku' => 'SAMS-S24U-001',
                'description' => 'The latest smartphone with advanced camera and display technology.',
                'brand_id' => $samsung_id,
                'category_id' => $electronics_id,
                'user_id' => $user_id,
            ],
            [
                'name' => 'Classic Fit Jeans',
                'slug' => 'classic-fit-jeans',
                'sku' => 'ZARA-JEANS-001',
                'description' => 'Everyday jeans with a versatile fit for all occasions.',
                'brand_id' => $zara_id,
                'category_id' => $apparel_id,
                'user_id' => $user_id,
            ],
            [
                'name' => 'Running Shorts',
                'slug' => 'running-shorts',
                'sku' => 'ADID-SHORTS-002',
                'description' => 'Lightweight shorts designed for comfort and mobility during runs.',
                'brand_id' => $adidas_id,
                'category_id' => $sporting_goods_id,
                'user_id' => $user_id,
            ],
            [
                'name' => 'Smart Watch',
                'slug' => 'smart-watch',
                'sku' => 'APPL-WATCH-002',
                'description' => 'A sleek wearable device with health and fitness tracking features.',
                'brand_id' => $apple_id,
                'category_id' => $electronics_id,
                'user_id' => $user_id,
            ],
            [
                'name' => 'Essential Joggers',
                'slug' => 'essential-joggers',
                'sku' => 'NIKE-JOGGERS-002',
                'description' => 'Comfortable joggers for a relaxed, everyday style.',
                'brand_id' => $nike_id,
                'category_id' => $apparel_id,
                'user_id' => $user_id,
            ],
            [
                'name' => 'Lifestyle Sneakers',
                'slug' => 'lifestyle-sneakers',
                'sku' => 'ZARA-SNEAK-002',
                'description' => 'Fashion-forward sneakers for casual wear.',
                'brand_id' => $zara_id,
                'category_id' => $footwear_id,
                'user_id' => $user_id,
            ],
            [
                'name' => '4K Smart TV',
                'slug' => '4k-smart-tv',
                'sku' => 'SAMS-TV-002',
                'description' => 'A high-definition smart TV with stunning picture quality.',
                'brand_id' => $samsung_id,
                'category_id' => $electronics_id,
                'user_id' => $user_id,
            ],
        ];

        // Seed data
        foreach ($data as $product) {
            Product::factory()->create($product);
        }

        // Turn off foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
