<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Gadgets and electronic devices.'],
            ['name' => 'Apparel', 'description' => 'Clothing and fashion items.'],
            ['name' => 'Footwear', 'description' => 'Shoes and other types of footwear.'],
            ['name' => 'Books', 'description' => 'Various genres of books.'],
            ['name' => 'Home & Kitchen', 'description' => 'Items for home improvement and kitchen use.'],
            ['name' => 'Sports & Outdoors', 'description' => 'Equipment for sports and outdoor activities.'],
            ['name' => 'Beauty & Personal Care', 'description' => 'Products for beauty, health, and personal hygiene.'],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['name' => $categoryData['name']],
                [
                    'slug' => Str::slug($categoryData['name']),
                    'description' => $categoryData['description'],
                ]
            );
        }

    }
}
