<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::firstOrCreate(['name' => 'Adidas'], [
            'description' => 'German multinational corporation, designs and manufactures shoes, clothing and accessories.',
            'logo' => 'logos/adidas_logo.png',
            'slug' => 'adidas',
        ]);

        Brand::firstOrCreate(['name' => 'Apple'], [
            'description' => 'American multinational technology company focusing on consumer electronics, software, and online services.',
            'logo' => 'logos/apple_logo.jpg',
            'slug' => 'apple',
        ]);

        Brand::firstOrCreate(['name' => 'Nike'], [
            'description' => 'Global leader in athletic footwear, apparel, equipment, accessories, and services.',
            'logo' => 'logos/nike_logo.png',
            'slug' => 'nike',
        ]);

        Brand::firstOrCreate(['name' => 'Samsung'], [
            'description' => 'South Korean multinational manufacturing conglomerate headquartered in Samsung Digital City, Suwon, South Korea.',
            'logo' => 'logos/samsung_logo.png',
            'slug' => 'samsung',
        ]);

        Brand::firstOrCreate(['name' => 'Zara'], [
            'description' => 'Spanish apparel retailer based in Arteixo, Galicia, Spain.',
            'logo' => 'logos/zara_logo.png',
            'slug' => 'zara',
        ]);
    }
}
